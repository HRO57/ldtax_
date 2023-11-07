<?php

namespace App\Http\Controllers;

use App\Models\UddesshoLokkho;
use App\Http\Requests\StoreUddesshoLokkhoRequest;
use App\Http\Requests\UpdateUddesshoLokkhoRequest;
use Illuminate\Http\Request;
use App\Http\Resources\UddesshoLokkhoResource;

class UddesshoLokkhoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = UddesshoLokkho::latest();

        if ($request->search) {
            $data = $data->where('title', 'LIKE', "%{$request->search}%");
        }

        if (request()->wantsJson()) {
            $data = $data->where('status', 1)->first();

            if ($data->count() > 0) {
                return response()->json([
                    'status' => true,
                    'message' => 'তথ্য সফলভাবে দেখায়।',
                    'code' => 200,
                    'data' => $data,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'তথ্য পাওয়া যায়নি',
                    'code' => 404,
                    'data' => null,
                ], 404);
            }
        }

        $data = $data->latest()->paginate(10);
        $rank = $data->firstItem();

        return view('admin.UddesshoLokkho.index', compact('data', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.UddesshoLokkho.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUddesshoLokkhoRequest $request)
    {
        $uddessho_lokkho = UddesshoLokkho::create([


            'uddessho_lokkho_description' => $request->uddessho_lokkho_description,
            'status' => $request->status,
        ]);

        if (!$uddessho_lokkho) {
            return redirect()->back()->with('error', 'দুঃখিত, উদ্দেশ্যে ও লক্ষ্য তৈরি করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('uddessho_lokkhos.index')->with('success', 'সফলভাবে, আপনার উদ্দেশ্যে ও লক্ষ্য তৈরি করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(UddesshoLokkho $uddessho_lokkho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UddesshoLokkho $uddessho_lokkho)
    {
        $data = $uddessho_lokkho;
        return view('admin.UddesshoLokkho.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUddesshoLokkhoRequest $request, UddesshoLokkho $uddessho_lokkho)
    {
        $data = $uddessho_lokkho;

        $update = $data->update([

            'uddessho_lokkho_description' => $request->uddessho_lokkho_description,
            'status' => $request->status,
        ]);

        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, উদ্দেশ্যে ও লক্ষ্য আপডেট করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('uddessho_lokkhos.index')->with('success', 'সফলভাবে, আপনার উদ্দেশ্যে ও লক্ষ্য আপডেট করা হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UddesshoLokkho $uddessho_lokkho)
    {
        $uddessho_lokkho->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
