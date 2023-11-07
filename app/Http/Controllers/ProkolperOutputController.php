<?php

namespace App\Http\Controllers;

use App\Models\ProkolperOutput;
use App\Http\Requests\StoreProkolperOutputRequest;
use App\Http\Requests\UpdateProkolperOutputRequest;
use Illuminate\Http\Request;
use App\Http\Resources\ProkolperOutputResource;

class ProkolperOutputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = ProkolperOutput::latest();

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

        return view('admin.ProkolperOutput.index', compact('data', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ProkolperOutput.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProkolperOutputRequest $request)
    {
        $prokolper_output = ProkolperOutput::create([



            'prokolper_output_description' => $request->prokolper_output_description,
            'status' => $request->status,
        ]);

        if (!$prokolper_output) {
            return redirect()->back()->with('error', 'দুঃখিত, প্রকল্পের আউটপুট তৈরি করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('prokolper_outputs.index')->with('success', 'সফলভাবে, আপনার প্রকল্পের আউটপুট তৈরি করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProkolperOutput $prokolper_output)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProkolperOutput $prokolper_output)
    {
        $data = $prokolper_output;
        return view('admin.ProkolperOutput.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProkolperOutputRequest $request, ProkolperOutput $prokolper_output)
    {
        $data = $prokolper_output;


        $update = $data->update([


            'prokolper_output_description' => $request->prokolper_output_description,
            'status' => $request->status,
        ]);

        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, প্রকল্পের আউটপুট আপডেট করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('prokolper_outputs.index')->with('success', 'সফলভাবে, আপনার প্রকল্পের আউটপুট আপডেট করা হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProkolperOutput $prokolper_output)
    {
        $prokolper_output->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
