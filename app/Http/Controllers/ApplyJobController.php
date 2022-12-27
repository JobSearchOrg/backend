<?php

namespace App\Http\Controllers;

use App\Models\ApplyJob;
use App\Models\Profile;
use Illuminate\Http\Request;

class ApplyJobController extends Controller
{
    public function applyJob(Request $request, Profile $profile)
    {
        $request->validate([
            'job_id' => 'required|string',
        ]);
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->city = $request->city;
        $profile->languages = $request->languages;
        $profile->questions = $request->questions;
        $profile->prev_job = $request->prev_job;
        $profile->save();

        ApplyJob::create([
            'user_id' => auth()->id(),
            'jub_id' => $request->job_id,
        ]);
        $response = [
            'message' => 'Job Applied Successfully',
        ];
        return response($response, 200);
    }
}
