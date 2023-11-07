<?php

namespace App\Http\Controllers;

use App\Models\ProkolpoPoricalok;
use App\Http\Requests\StoreProkolpoPoricalokRequest;
use App\Http\Requests\UpdateProkolpoPoricalokRequest;
use App\Http\Resources\ProkolpoPoricalokResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProkolpoPoricalokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = new ProkolpoPoricalok();

        // $data = $data->orderBy('show_sl', 'asc');

        if ($request->search) {
            $data = $data->where('title', 'LIKE', "%{$request->search}%");
        }

        if (request()->wantsJson()) {
            $data = $data->where('status', 1)->get();

            if ($data) {
                return response([
                    'status' => true,
                    'message' => 'তথ্য সফলভাবে দেখায়।',
                    'code' => 200,
                    'data' => ProkolpoPoricalokResource::collection($data),

                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'তথ্য পাওয়া যায়নি',
                    'code' => 404,
                    'data' => null,

                ], 404);
            }
        }

        $data = $data->latest()->paginate(10);
        $rank = $data->firstItem();


        return view('admin.ProkolpoPoricalok.index', compact('data',  'rank'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ProkolpoPoricalok.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProkolpoPoricalokRequest $request)
    {
        // dd($request->all());
        $image_path = '';

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('ProkolpoPoricalok', 'public');
        }

        $service = ProkolpoPoricalok::create([

            
            'image'                             => $image_path,
            'title'                             => $request->input('title'),
            'short_description'                 => $request->input('short_description'),
            'long_description'                  => $request->input('long_description'),
            'status'                            => $request->input('status'),
        ]);

        if (!$service) {
            return redirect()->back()->with('error', 'দুঃখিত, সেবা তৈরি করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('prokolpo_poricaloks.index')->with('success', 'সফলভাবে, আপনার সেবা তৈরি করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProkolpoPoricalok $prokolpoPoricalok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProkolpoPoricalok $prokolpoPoricalok)
    {
        $data = $prokolpoPoricalok;
        return view('admin.ProkolpoPoricalok.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProkolpoPoricalokRequest $request, ProkolpoPoricalok $prokolpoPoricalok)
    {
        $data = $prokolpoPoricalok;
        $image_path = $data->image;

        if ($request->hasFile('image')) {
            if ($data->image) {
                Storage::delete('public/' . $data->image);   // Delete old image
            }
            $image_path = $request->file('image')->store('ProkolpoPoricalok', 'public'); // Store new image
        }

        $update = $data->update([
            
            'image'                             => $image_path,
            'title'                             => $request->title,
            'short_description'                 => $request->short_description,
            'long_description'                  => $request->long_description,
            'status'                            => $request->status
        ]);

        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, সেবা আপডেট করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('prokolpo_poricaloks.index')->with('success', 'সফলভাবে, আপনার সেবা আপডেট করা হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProkolpoPoricalok $prokolpoPoricalok)
    {
        $deleted = $prokolpoPoricalok->delete();

        if ($deleted) {
            return redirect()->route('services.index')->with('success', 'সেবা মুছে ফেলা হয়েছে.');
        } else {
            return redirect()->back()->with('error', 'দুঃখিত, সেবাটি মুছে ফেলার সময় একটি সমস্যা হয়েছে৷');
        }
    }
}
