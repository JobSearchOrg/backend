<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //All Profile Data
        $jobsData = Job::orderBy('created_at', 'desc')->get();

        return response([
            'data' => $jobsData,
        ], 200);
    }
// get single jobs 
public function show($slug)
{
        $jobsData =Job::where('slug', $slug)->first();
        return response([
            'data' => $jobsData,
        ], 200);
    }

    //create Job
    public function store(JobRequest $request)
    {
        

        $userData = Job::create([
            'user_id' => auth()->id(),
            'open' => true,
            'company' => $request->company,
            'avatar' => $request->avatar,
            'location' => $request->location,
            'jobTitle' => $request->jobTitle,
            'slag' => $request->slag,
            'jobType' => $request->jobType,
            'employmentType' => $request->employmentType,
            'experience' => $request->experience,
            'category' => $request->category,
        ]);
        $response = [
            'message' => 'Job Added Successfully',
            'data' => $userData,
        ];

        return response($response, 201);
    }

    // search jobs 
    public function search($jobTitle,$location)
    {
        $jobs = Job::where('jobTitle', 'LIKE', '%' . $jobTitle . '%');
    
        if ($location != 'ALL') {
            $jobs->where('location', $location);
        }
        $jobData = $jobs->get();
        return response([
            'data' => $jobData,
        ], 200);
    }
}
