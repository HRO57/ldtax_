<?php

namespace App\Http\Controllers;

use App\Models\UserAskQuestion;
use App\Http\Requests\StoreUserAskQuestionRequest;
use App\Http\Requests\UpdateUserAskQuestionRequest;
use Illuminate\Http\Request;

class UserAskQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserAskQuestionRequest $request)
    {
        $data = [
            'name'      => $request->name,
            'number'    => $request->number,
            'question'  => $request->question,
        ];

        $userAskQuestion = UserAskQuestion::create($data);

        return response()->json([
            'status'    => true,
            'message'   => 'সফলভাবে, আপনার জিজ্ঞাসিত প্রশ্ন তৈরি করা হয়েছে.',
            'code'      => 200,
            'data'      => $data,
        ], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(UserAskQuestion $userAskQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAskQuestion $userAskQuestion)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserAskQuestionRequest $request, UserAskQuestion $userAskQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAskQuestion $userAskQuestion)
    {
        //
    }
}
