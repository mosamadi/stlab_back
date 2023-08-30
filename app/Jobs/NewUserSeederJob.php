<?php

namespace App\Jobs;

use App\Models\Donation;
use App\Models\Follower;
use App\Models\User;
use App\Models\UserSusbcriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NewUserSeederJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        //
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Donation::factory()->count(rand(300,500))->for($this->user)->create();
        Follower::factory()->count(rand(300,500))->for($this->user)->create();
        UserSusbcriber::factory()->count(rand(300,500))->for($this->user)->create();
    }
}
