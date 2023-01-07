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
        $jobsData = Job::where('slug', $slug)->first();
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
            'description' => $request->description,
            'slug' => $request->slug,
            'jobType' => $request->jobType,
            'employmentType' => $request->employmentType,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'jobLevel' => $request->jobLevel,
            'category' => $request->category,
        ]);
        $response = [
            'message' => 'Job Added Successfully',
            'data' => $userData,
        ];

        return response($response, 201);
    }

    // search jobs 
    public function search(Request $request)
    {
        // $jobTitle, $location, $jobtype, $category, $joblevel, $range
        $jobTitle = $request->input('title');
        $location = $request->input('location');
        $employmentType = $request->input('employmentType');
        $categories = $request->input('categories');
        $category = $request->input('category');
        $joblevel = $request->input('jobLevel');
        $salary = $request->input('salary');
        $jobtype = $request->input('jobtype');


        $jobs = Job::where('jobTitle', 'LIKE', '%' . $jobTitle . '%');

        if ($location) {
            $jobs->where('location', $location);
        }
        if ($employmentType) {
            $jobs->where('employmentType', "=", $employmentType);
        }
        if ($category) {
            $jobs->where('category', "=", $category);
        }
        if ($categories) {
            $jobs->where('category', "=", $categories);
        }
        if ($jobtype) {
            $jobs->where('jobType', "=", $jobtype);
        }
        if ($joblevel) {
            $jobs->where('jobLevel', '=', $joblevel);
        }
        if ($salary) {
            $money =
                str_replace('$', '', $salary);
                $strSplit = explode("-", $money);
            $minRange = $strSplit[0];
            $maxRange = $strSplit[1];
            $jobs->whereBetween('salary', [$minRange, $maxRange]);
        }

        $jobData = $jobs->get();
        return response([
            'data' => $jobData,
        ], 200);
    }
}
