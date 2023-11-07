<?php

namespace App\Http\Controllers;

use App\Models\ProkolpoSarsongkhep;
use App\Http\Requests\StoreProkolpoSarsongkhepRequest;
use App\Http\Requests\UpdateProkolpoSarsongkhepRequest;
use Illuminate\Http\Request;
use App\Http\Resources\ProkolpoSarsongkhepResource;

class ProkolpoSarsongkhepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = ProkolpoSarsongkhep::latest();

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

        return view('admin.ProkolpoSarsongkhep.index', compact('data', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ProkolpoSarsongkhep.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProkolpoSarsongkhepRequest $request)
    {
        $prokolpo_sarsongkhep = ProkolpoSarsongkhep::create([



            'prokolpo_sarsongkhep_description' => $request->prokolpo_sarsongkhep_description,
            'status' => $request->status,
        ]);

        if (!$prokolpo_sarsongkhep) {
            return redirect()->back()->with('error', 'দুঃখিত, প্রকল্প সারসংক্ষেপ তৈরি করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('prokolpo_sarsongkheps.index')->with('success', 'সফলভাবে, আপনার প্রকল্প সারসংক্ষেপ তৈরি করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProkolpoSarsongkhep $prokolpo_sarsongkhep)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProkolpoSarsongkhep $prokolpo_sarsongkhep)
    {
        $data = $prokolpo_sarsongkhep;
        return view('admin.ProkolpoSarsongkhep.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProkolpoSarsongkhepRequest $request, ProkolpoSarsongkhep $prokolpo_sarsongkhep)
    {
        $data = $prokolpo_sarsongkhep;

        $update = $data->update([


            'prokolpo_sarsongkhep_description' => $request->prokolpo_sarsongkhep_description,
            'status' => $request->status,
        ]);

        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, প্রকল্প সারসংক্ষেপ আপডেট করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('prokolpo_sarsongkheps.index')->with('success', 'সফলভাবে, আপনার প্রকল্প সারসংক্ষেপ আপডেট করা হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProkolpoSarsongkhep $prokolpo_sarsongkhep)
    {
        $prokolpo_sarsongkhep->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
