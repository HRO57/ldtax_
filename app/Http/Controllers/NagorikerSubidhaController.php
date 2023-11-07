<?php

namespace App\Http\Controllers;

use App\Models\NagorikerSubidha;
use App\Http\Requests\StoreNagorikerSubidhaRequest;
use App\Http\Requests\UpdateNagorikerSubidhaRequest;
use Illuminate\Http\Request;
use App\Http\Resources\NagorikerSubidhaResource;

class NagorikerSubidhaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = NagorikerSubidha::latest();

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

        return view('admin.NagorikerSubidha.index', compact('data', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.NagorikerSubidha.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNagorikerSubidhaRequest $request)
    {
        $nagoriker_subidha = NagorikerSubidha::create([



            'nagoriker_subidha_description' => $request->nagoriker_subidha_description,
            'status' => $request->status,
        ]);

        if (!$nagoriker_subidha) {
            return redirect()->back()->with('error', 'দুঃখিত, নাগরিকের সুবিধা তৈরি করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('nagoriker_subidhas.index')->with('success', 'সফলভাবে, আপনার নাগরিকের সুবিধা তৈরি করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(NagorikerSubidha $nagoriker_subidha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NagorikerSubidha $nagoriker_subidha)
    {
        $data = $nagoriker_subidha;
        return view('admin.NagorikerSubidha.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNagorikerSubidhaRequest $request, NagorikerSubidha $nagoriker_subidha)
    {
        $data = $nagoriker_subidha;

        $update = $data->update([


            'nagoriker_subidha_description' => $request->nagoriker_subidha_description,
            'status' => $request->status,
        ]);

        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, নাগরিকের সুবিধা আপডেট করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('nagoriker_subidhas.index')->with('success', 'সফলভাবে, আপনার নাগরিকের সুবিধা আপডেট করা হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NagorikerSubidha $nagoriker_subidha)
    {
        $nagoriker_subidha->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
