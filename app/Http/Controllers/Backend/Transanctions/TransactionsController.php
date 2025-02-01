<?php

namespace App\Http\Controllers\Backend\Transanctions;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Country;
use App\Models\Transaction;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TransactionsController extends Controller
{
    /**
     * show all transactions
     */
    public function index(Request $request)
    {
        $query = Transaction::latest();

        // Apply filters based on request inputs
        if ($request->filled('transaction_id')) {
            $query->where('transaction_id', $request->transaction_id);
        }

        if ($request->filled('transaction_type') && $request->transaction_type !== 'all') {
            if ($request->transaction_type === 'refund') {
                $query->where('status', 'Refunded');
            } else {
                $query->where('transaction_type', $request->transaction_type);
            }
        }

        if ($request->filled('month') && $request->month !== 'all') {
            $query->whereMonth('created_at', $request->month);
        }

        if ($request->filled('year') && $request->year !== 'all') {
            $query->whereYear('created_at', $request->year);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $transactions = $query->get();
        $account = Balance::firstOrCreate();

        // Calculate totals based on the filtered transactions
        $totalIn = $transactions->where('transaction_type', 'IN')->sum('amount');
        $totalOut = $transactions->where('transaction_type', 'OUT')->sum('amount');
        $totalDeposit = $transactions->where('transaction_type', 'DEPOSIT')->sum('amount');
        $totalRefunds = $transactions->sum('refunded_amount');
        $currentBalance = $account->current_balance;

        // Get current month and year if not provided
        $selectedMonth = $request->filled('month') ? $request->month : date('m');
        $selectedYear = $request->filled('year') ? $request->year : date('Y');

        $selectedMonthName = '';
        if ($selectedMonth != 'all') {
            $dateObj = DateTime::createFromFormat('!m', $selectedMonth);
            $selectedMonthName = $dateObj->format('F');
        } elseif ($selectedMonth == 'all') {
            $selectedMonthName = 'all';
        }

        $all_transactions = Transaction::all();
        $monthlyBalances = $this->calculateMonthlyBalances($all_transactions);

        $currentMonthKey = "{$selectedYear}-{$selectedMonth}";
        $openingBalance = $monthlyBalances[$currentMonthKey]['opening_balance'] ?? 0;
        $closingBalance = $monthlyBalances[$currentMonthKey]['closing_balance'] ?? 0;

        $data = [
            'transactions' => $transactions,
            'totalIn' => intval($totalIn),
            'totalOut' => intval($totalOut),
            'totalDeposit' => intval($totalDeposit),
            'totalRefunds' => intval($totalRefunds),
            'currentBalance' => intval($currentBalance),
            'openingBalance' => intval($openingBalance),
            'closingBalance' => intval($closingBalance),
            'selectedMonth' => $selectedMonthName,
            'selectedYear' => $selectedYear,
            'account_username' => json_decode($account['account_protection'], true)['username'] ?? 'admin',
            'account_password' => json_decode($account['account_protection'], true)['password'] ?? base64_encode('admin'),
        ];

        return view('Backend.transactions.index', $data);
    }

    /**
     * calculate and fetch monthly opening - closing balances
     */
    private function calculateMonthlyBalances($transactions)
    {
        $monthlyBalances = [];
        $openingBalance = 0;

        $transactionsByMonth = $transactions->groupBy(function ($transaction) {
            return $transaction->created_at->format('Y-m');
        });

        $transactionsByMonth = array_reverse($transactionsByMonth->toArray());

        foreach ($transactionsByMonth as $month => $monthTransactions) {
            $totalAmount = 0;

            foreach ($monthTransactions as $transaction) {
                if ($transaction['transaction_type'] === 'IN' || $transaction['transaction_type'] === 'DEPOSIT') {
                    $amount = $transaction['amount'] - $transaction['refunded_amount'];
                    $totalAmount += max($amount, 0);
                } elseif ($transaction['transaction_type'] === 'OUT') {
                    $amount = $transaction['amount'] - $transaction['refunded_amount'];
                    $totalAmount -= max($amount, 0);
                }
            }

            $closingBalance = $openingBalance + $totalAmount;

            $monthlyBalances[$month] = [
                'opening_balance' => $openingBalance,
                'closing_balance' => $closingBalance,
            ];

            $openingBalance = $closingBalance;
        }

        return $monthlyBalances;
    }

    /**
     * add in transaction form
     */
    public function in_form()
    {
        $data['transaction_type'] = 'in';
        return view('Backend.transactions.in_form_add', $data);
    }

    /**
     * store in transaction
     */
    public function in_form_update(Request $request)
    {
        try {
            $request->validate([
                'client_name' => 'nullable|string|max:255',
                'client_phone' => 'nullable|string|max:255',
                'category' => 'required|string|max:255',
                'title' => 'nullable|string|max:255',
                'amount' => 'required|numeric|min:0',
                'is_refundable' => 'required|in:yes,no',
                'refunded_amount' => 'nullable|numeric|min:0',
                'status' => 'required|in:Pending,Resolved',
                'description' => 'nullable|string',
            ]);

            $unique_id = explode('-', uuid_create())[0];
            $transaction = new Transaction();
            $transaction->transaction_id = $unique_id;
            $transaction->transaction_type = 'in';
            $transaction->client_name = $request->input('client_name');
            $transaction->client_phone = $request->input('client_phone');
            $transaction->category = $request->input('category');
            if ($transaction->category == 'Other') {
                $transaction->category = $request->input('title');
            }
            $transaction->amount = $request->input('amount');
            $transaction->is_refundable = $request->input('is_refundable');
            $transaction->status = $request->input('status');
            $transaction->description = $request->input('description');

            if ($transaction->is_refundable === 'yes') {
                $refundableAmount = $request->input('refundable_amount');

                if ($refundableAmount > $transaction->amount) {
                    return redirect()->back()->withErrors([
                        'error' => 'Please fix the issue(s) first.',
                        'refundable_amount' => 'Refunded amount cannot be greater than the original amount.'
                    ]);
                }

                $transaction->refundable_amount = $refundableAmount;
            } else {
                $transaction->refundable_amount = 0;
            }

            if ($transaction->status === 'Resolved') {
                $balance = Balance::firstOrCreate([]);
                $balance->current_balance += $transaction->amount;
                $balance->save();
            }

            $transaction->save();
            return redirect()->route('admin.transactions.index')->with('success', 'In Transaction successfully created.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * add out transaction form
     */
    public function out_form()
    {
        $data['transaction_type'] = 'out';
        return view('Backend.transactions.out_form_add', $data);
    }

    /**
     * store out transaction
     */
    public function out_form_update(Request $request)
    {
        try {
            $request->validate([
                'client_name' => 'nullable|string|max:255',
                'client_phone' => 'nullable|string|max:255',
                'category' => 'required|string|max:255',
                'title' => 'nullable|string|max:255',
                'amount' => 'required|numeric|min:0',
                'status' => 'required|in:Pending,Resolved',
                'description' => 'nullable|string',
            ]);

            $unique_id = explode('-', uuid_create())[0];
            $transaction = new Transaction();
            $transaction->transaction_id = $unique_id;
            $transaction->transaction_type = 'out';
            $transaction->client_name = $request->input('client_name');
            $transaction->client_phone = $request->input('client_phone');
            $transaction->category = $request->input('category');
            if ($transaction->category == 'Other') {
                $transaction->category = $request->input('title');
            }
            $transaction->amount = $request->input('amount');
            $transaction->is_refundable = '';
            $transaction->status = $request->input('status');
            $transaction->description = $request->input('description');

            if ($transaction->status === 'Resolved') {
                $balance = Balance::firstOrCreate([]);

                if ($transaction->amount > $balance->current_balance) {
                    return redirect()->back()->with(['error' => 'Insufficient balance.']);
                }

                $balance->current_balance -= $transaction->amount;
                $balance->save();
            }

            $transaction->save();
            return redirect()->route('admin.transactions.index')->with('success', 'Out Transaction successfully created.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * add deposit transaction form
     */
    public function deposit_form()
    {
        $data['transaction_type'] = 'deposit';
        return view('Backend.transactions.deposit_form_add', $data);
    }

    /**
     * store deposit transaction
     */
    public function deposit_form_update(Request $request)
    {
        try {
            $request->validate([
                'client_name' => 'nullable|string|max:255',
                'client_phone' => 'nullable|string|max:255',
                'category' => 'required|string|max:255',
                'title' => 'nullable|string|max:255',
                'amount' => 'required|numeric|min:0',
                'is_refundable' => 'required|in:yes,no',
                'refunded_amount' => 'nullable|numeric|min:0',
                'status' => 'required|in:Pending,Resolved',
                'description' => 'nullable|string',
            ]);

            $unique_id = explode('-', uuid_create())[0];
            $transaction = new Transaction();
            $transaction->transaction_id = $unique_id;
            $transaction->transaction_type = 'deposit';
            $transaction->client_name = $request->input('client_name');
            $transaction->client_phone = $request->input('client_phone');
            $transaction->category = $request->input('category');
            if ($transaction->category == 'Other') {
                $transaction->category = $request->input('title');
            }
            $transaction->amount = $request->input('amount');
            $transaction->is_refundable = $request->input('is_refundable');
            $transaction->status = $request->input('status');
            $transaction->description = $request->input('description');

            if ($transaction->is_refundable === 'yes') {
                $refundableAmount = $request->input('refundable_amount');

                if ($refundableAmount > $transaction->amount) {
                    return redirect()->back()->withErrors([
                        'error' => 'Please fix the issue(s) first.',
                        'refundable_amount' => 'Refunded amount cannot be greater than the original amount.'
                    ]);
                }

                $transaction->refundable_amount = $refundableAmount;
            } else {
                $transaction->refundable_amount = 0;
            }

            if ($transaction->status === 'Resolved') {
                $balance = Balance::firstOrCreate([]);
                $balance->current_balance += $transaction->amount;
                $balance->save();
            }

            $transaction->save();
            return redirect()->route('admin.transactions.index')->with('success', 'In Transaction successfully created.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    /**
     * account protection
     */
    public function account_protection(Request $request)
    {
        $balance = Balance::firstOrCreate();

        $encryptedPassword = base64_encode($request->password);

        $user_data = [
            'username' => $request->username,
            'password' => $encryptedPassword,
        ];

        $balance->account_protection = json_encode($user_data);
        $balance->save();

        return redirect()->back()->with('success', 'Account Protection Credentials Updated!');
    }

    /**
     * transaction details
     */
    public function details(Request $request)
    {
        $transaction = Transaction::where('transaction_id', $request->transaction_id)->first();

        if ($transaction) {
            return view('Backend.transactions.transaction_details', compact('transaction'));
            /* return response([
                'data' => $transaction,
                'status' => 'success'
            ], 200); */
        } else {
            return response([
                'data' => '',
                'status' => 'not found'
            ], 404);
        }
    }

    /**
     * refund transaction
     */
    public function refund_transaction(Request $request, $transaction_id)
    {
        if (!$transaction_id) {
            return redirect()->back()->with('error', 'Transaction Not Found!');
        }

        $transaction = Transaction::where('transaction_id', $transaction_id)->first();
        if (!$transaction) {
            return redirect()->back()->with('error', 'Transaction Not Found!');
        }

        if ($transaction->status == 'Pending') {
            return redirect()->back()->with('error', 'Transaction Must Be Resolved or Refuned!');
        }

        // Validate the refund amount
        $refundAmount = (float) $request->input('refund_amount');
        if ($refundAmount <= 0) {
            return redirect()->back()->with('error', 'Refund amount must be greater than zero.');
        }

        $totalRefunded = (float) $transaction->refunded_amount ?? 0;
        $refundableAmount = (float) $transaction->refundable_amount ?? 0;

        if ($refundAmount > $refundableAmount) {
            return redirect()->back()->with('error', 'Refund amount cannot be greater than the refundable amount.');
        }

        if (($totalRefunded + $refundAmount) > $transaction->amount) {
            return redirect()->back()->with('error', 'Refund amount cannot exceed the original transaction amount.');
        }

        if (strtolower($transaction->transaction_type) == 'in' || strtolower($transaction->transaction_type) == 'deposit') {
            if ($transaction->is_refundable !== 'yes') {
                return redirect()->back()->with('error', 'Transaction is not refundable.');
            }

            // Check if all refundable amount has been refunded
            if (($totalRefunded + $refundAmount) > $refundableAmount) {
                return redirect()->back()->with('error', 'All refundable amount has already been refunded.');
            }

            $transaction->refunded_amount = $totalRefunded + $refundAmount;
            $transaction->status = 'Refunded';
            $transaction->save();

            $balance = Balance::firstOrCreate([]);
            $balance->current_balance -= $refundAmount;
            $balance->save();

            return redirect()->route('admin.transactions.index')->with('success', 'Refund processed successfully.');
        }

        return redirect()->back()->with('error', 'Invalid transaction type for refund.');
    }

    /**
     * change status and perform resolve
     */
    public function toggleStatus(Request $request, $transaction_id)
    {
        try {
            $transaction = Transaction::where('transaction_id', $transaction_id)->first();
            if (!$transaction || $transaction->status !== 'Pending') {
                return redirect()->back()->with('error', 'Invalid transaction or status.');
            }

            $transaction->status = 'Resolved';

            if ($transaction->is_refundable === 'yes') {
                $refundableAmount = $transaction->refundable_amount;
                $transaction->refundable_amount = $refundableAmount;
            }
            $transaction->save();


            $balance = Balance::firstOrCreate([]);
            if (strtolower($transaction->transaction_type) == 'in' || strtolower($transaction->transaction_type) == 'deposit') {
                $balance->current_balance += $transaction->amount;
            } elseif (strtolower($transaction->transaction_type) == 'out') {
                $balance->current_balance -= $transaction->amount;
            }
            $balance->save();

            return redirect()->back()->with('success', 'Transaction status changed to Resolved.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }


    /**
     * delete transaction
     */
    public function delete_transaction(Request $request)
    {
        try {
            $transaction = Transaction::where('transaction_id', $request->transaction_id)->first();
            if ($transaction) {
                $balance = Balance::firstOrCreate();
                $remainingAmount = $transaction->amount - $transaction->refunded_amount;

                if ($transaction->status != 'Pending') {
                    if (strtolower($transaction->transaction_type) == 'in' || strtolower($transaction->transaction_type) == 'deposit') {
                        $balance->current_balance -= $remainingAmount;
                    } elseif (strtolower($transaction->transaction_type) == 'out') {
                        $balance->current_balance += $remainingAmount;
                    }
                }

                $balance->save();
                $transaction->delete();

                return redirect()->back()->with('success', 'Transaction Has Been Deleted!');
            } else {
                return redirect()->back()->with('error', 'Transaction Found!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
}