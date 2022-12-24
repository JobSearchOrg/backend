<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    //create Job
    public function store(JobRequest $request)
    {
        $jobImage = $request->file('avatar')->store('jobAvatar', 'public');

        $userData = Job::create([
            'user_id' => auth()->id(),
            'open' => $request->open,
            'company' => $request->company,
            'avatar' => $jobImage,
            'location' => $request->location,
            'jobTitle' => $request->jobTitle,
            'jobType' => $request->jobType,
            'employmentType' => $request->employmentType,
            'experience' => $request->experience,
            'categories' => json_encode($request->categories),
        ]);
        $response = [
            'message' => 'Job Added Successfully',
            'data' => $userData,
        ];

        return response($response, 201);
    }
}
