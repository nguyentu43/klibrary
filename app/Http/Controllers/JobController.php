<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Imtigger\LaravelJobStatus\JobStatus;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(){
        if(Auth::user()->isAdmin)
        {
            $jobs = JobStatus::all();
        }
        else {
            $all = JobStatus::all();
            $jobs = [];
            foreach($all as $job)
            {
                if($job->input[1] === Auth::user()->id)
                    array_push($jobs, $job);
            }
        }

        return view('job', compact('jobs'));
    }
}
