<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //All Profile Data
        $usersData = Profile::all();
        $data = json_decode($usersData);
        return response([
            'data' => $data,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $userResume = $request->file('resume')->store('resumes', 'public');
        $image = $request->file('image')->store('profiles', 'public');
        $userData = Profile::create([
            'user_id' => auth()->id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'image' => $image,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'resume' => $userResume,
            'prev_job' => json_encode($request->prev_job),
        ]);
        $response = [
            'message' => 'User profile Added',
            'data' => $userData,
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //get specific profile info
        $profileData = Profile::find($profile)->first();
        $response = [
            'data' => $profileData,
        ];

        return response()->json($response, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, Profile $profile)
    {

        $userResume = $request->file('resume')->store('resumes', 'public');
        $image = $request->file('image')->store('profiles', 'public');

        $profile->update([
            'user_id' => auth()->id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'image' => $image,
            'email' => $request->email,
            'phone' => $request->phone,
            'city' => $request->city,
            'resume' => $userResume,
            'prev_job' => json_encode($request->prev_job),
        ]);
        $response = [
            'message' => 'User profile Added',
            'data' => $profile,
        ];


        return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //destroy profile 
        $profile->delete();
        $response = [
            'message' => "Delete User Profile",
        ];

        return response()->json($response, 200);
    }
}
