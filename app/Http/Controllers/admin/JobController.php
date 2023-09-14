<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\CreateFakeUsersJob;
use Illuminate\Http\Request;

class JobController extends Controller
{

    public function createFakeUsers(){

        $job=new CreateFakeUsersJob(20);
        $job->onQueue('create')->delay(now()->addSeconds(2));
        $this->dispatch($job);

    }

}
