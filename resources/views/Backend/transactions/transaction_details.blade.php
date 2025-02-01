<div class="row">
    @if ($transaction)
        <div class="col-12">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th>Transaction ID</th>
                        <td>:</td>
                        <td style="font-size:1rem;">{{ strtoupper($transaction->transaction_id) }}</td>
                    </tr>
                    <tr>
                        <th>Client Name</th>
                        <td>:</td>
                        <td style="font-size:1rem;">{{ $transaction->client_name }}</td>
                    </tr>
                    <tr>
                        <th>Client Phone</th>
                        <td>:</td>
                        <td style="font-size:1rem;">{{ $transaction->client_phone }}</td>
                    </tr>
                    <tr>
                        <th>Transaction Type</th>
                        <td>:</td>
                        <td style="font-size:1rem;">{{ $transaction->transaction_type }}</td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>:</td>
                        <td style="font-size:1rem;">{{ $transaction->category }}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>:</td>
                        <td style="font-size:1rem;">{{ $transaction->amount }}</td>
                    </tr>
                    <tr>
                        <th>Is Refundable</th>
                        <td>:</td>
                        <td style="font-size:1rem;">{{ ucfirst($transaction->is_refundable) }}</td>
                    </tr>
                    <tr>
                        <th>Refundable Amount</th>
                        <td>:</td>
                        <td style="font-size:1rem;">{{ $transaction->refundable_amount }}</td>
                    </tr>
                    <tr>
                        <th>Refunded Amount</th>
                        <td>:</td>
                        <td style="font-size:1rem;">{{ $transaction->refunded_amount }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>:</td>
                        <td style="font-size:1rem;">{{ $transaction->status }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>:</td>
                        <td style="font-size:1rem;">{{ date('d M, Y', strtotime($transaction->created_at)) }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>:</td>
                        <td style="font-size:1rem;">{{ $transaction->description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @else
        <div class="col-12">
            <p class="text-center text-danger">
                Trasaction Not Found!
            </p>
        </div>
    @endif
</div>
