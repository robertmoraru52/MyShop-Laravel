<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class WelcomeEmailProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
        Mail::send('emails.welcome', ['user' => $this->user], function ($message){
            $message->from('hi@yourdomain.com', 'John Doe');
            $message->subject('Welcome aboard ' . $this->user->email . '!');
            $message->to($this->user->email);
        });
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }
}
}
