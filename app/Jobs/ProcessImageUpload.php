<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ProcessImageUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $imageName;
    private $id_user;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($imageName,$id_user)
    {
       $this->imageName = $imageName;
       $this->id_user = $id_user;
    }
    /**
     * The number of seconds after which the job's unique lock will be released.
     *
     * @var int
     */
    public $uniqueFor = 3600;
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            $user = User::find($this->id_user);
            $user->image = $this->imageName;
            $user->save();
        }
        catch(\Exception $e){
            Log::info($e->getMessage());
        }    
    }
}
