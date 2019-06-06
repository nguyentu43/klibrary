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

    public function destroy(JobStatus $job)
    {
        $user = Auth::user();
        if(!$user->isAdmin &&$job->input[1] === $user->id)
            return abort(401);
        if($job->delete())
            return redirect()->route('jobs.index')->with('message', __('app.job.messages.delete', ['job' => $job->input[0]]));
    }
}
