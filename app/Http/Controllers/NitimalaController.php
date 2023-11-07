<?php

namespace App\Http\Controllers;

use App\Models\Nitimala;
use App\Http\Requests\StoreNitimalaRequest;
use App\Http\Requests\UpdateNitimalaRequest;
use Illuminate\Http\Request;
use App\Http\Resources\NitimalaResource;

class NitimalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Nitimala::latest();

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

        return view('admin.Nitimala.index', compact('data', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Nitimala.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNitimalaRequest $request)
    {

        $nitimala = Nitimala::create([


            'nitimala_description' => $request->nitimala_description,
            'status' => $request->status,
        ]);

        if (!$nitimala) {
            return redirect()->back()->with('error', 'দুঃখিত, নীতিমালা ও শর্তাবলী তৈরি করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('nitimalas.index')->with('success', 'সফলভাবে, আপনার নীতিমালা ও শর্তাবলী তৈরি করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nitimala $nitimala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nitimala $nitimala)
    {
        $data = $nitimala;
        return view('admin.Nitimala.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNitimalaRequest $request, Nitimala $nitimala)
    {

        $data = $nitimala;


        $update = $data->update([

            'nitimala_description' => $request->nitimala_description,
            'status' => $request->status,
        ]);

        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, নীতিমালা ও শর্তাবলী করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('nitimalas.index')->with('success', 'সফলভাবে, আপনার নীতিমালা ও শর্তাবলী আপডেট করা হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nitimala $nitimala)
    {
        $nitimala->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
