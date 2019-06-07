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
            $jobs = JobStatus::orderBy('created_at', 'desc')->get();
        }
        else {
            $all = JobStatus::orderBy('created_at', 'desc')->get();
            $jobs = [];
            foreach($all as $job)
            {
                if($job->input[1] === Auth::user()->id)
                    array_push($jobs, $job);
            }
        }
        return response()->view('job', compact('jobs'))->header('Refresh', '10');
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
