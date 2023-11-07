<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Http\Requests\StoreVisitorRequest;
use App\Http\Requests\UpdateVisitorRequest;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVisitorRequest $request)
    {
        $data = [
            'ip'              => $request->ip,
            'visitor_name'    => $request->visitor_name,
            'visitor_intime'  => $request->visitor_intime,
            'visitor_timeout' => $request->visitor_timeout,
        ];

        $visitor = Visitor::create($data);

        return response()->json([
            'status'    => true,
            'message'   => 'সফলভাবে, আপনার পরিদর্শক চার্ট তৈরি করা হয়েছে.',
            'code'      => 200,
            'data'      => $data,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Visitor $visitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVisitorRequest $request, Visitor $visitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visitor $visitor)
    {
        //
    }
}
