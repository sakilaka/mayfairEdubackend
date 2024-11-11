<?php

namespace App\Jobs;

use App\Mail\SendExpoEmailAll;
use App\Models\ExpoModule;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmailsJob
{
    use Dispatchable, SerializesModels;

    protected $subject;
    protected $body;

    public function __construct($subject, $body)
    {
        $this->subject = $subject;
        $this->body = $body;
    }

    public function handle()
    {
        $emailList = ExpoModule::select('email')->get();
        foreach ($emailList as $email) {
            try {
                $data = [
                    'subject' => $this->subject,
                    'feedback' => $this->body,
                ];
                Mail::to($email->email)->queue(new SendExpoEmailAll($data));
            } catch (\Exception $e) {
            }
        }
    }
}
