<?php

namespace App\Http\Controllers;

use App\Models\Ayinbidhi;
use App\Http\Requests\StoreAyinbidhiRequest;
use App\Http\Requests\UpdateAyinbidhiRequest;
use Illuminate\Http\Request;
use App\Http\Resources\AyinbidhiResource;
use Illuminate\Support\Facades\Storage;

class AyinbidhiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Ayinbidhi::latest();

        if ($request->search) {
            $data = $data->where('title', 'LIKE', "%{$request->search}%");
        }

        if (request()->wantsJson()) {
            $data = $data->where('status', 1)->get();

            if ($data->count() > 0) {
                return response()->json([
                    'status' => true,
                    'message' => 'তথ্য সফলভাবে দেখায়।',
                    'code' => 200,
                    'data' => AyinbidhiResource::collection($data),
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

        $data = $data->paginate(10);
        $rank = $data->firstItem();

        return view('admin.Ayinbidhi.index', compact('data', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Ayinbidhi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAyinbidhiRequest $request)
    {
        $ayinbidhi_pdf_path = '';

        if ($request->hasFile('ayinbidhi_pdf')) {
            $ayinbidhi_pdf_path = $request->file('ayinbidhi_pdf')->store('AyinbidhiPDFs', 'public');
        }

        $data = [
            'title'         => $request->title,
            'ayinbidhi_pdf' => $ayinbidhi_pdf_path,
            'status'        => $request->status,
        ];

        $ayinbidhi = Ayinbidhi::create($data);

        if (!$ayinbidhi) {
            return redirect()->back()->with('error', 'দুঃখিত, আইন-ও-বিধি তৈরি করার সময় একটি সমস্যা ছিল৷');
        }

        return redirect()->route('ayinbidhis.index')->with('success', 'সফলভাবে, আপনার আইন-ও-বিধি তালিকা তৈরি করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ayinbidhi $ayinbidhi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ayinbidhi $ayinbidhi)
    {
        $data = $ayinbidhi;
        return view('admin.Ayinbidhi.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAyinbidhiRequest $request, Ayinbidhi $ayinbidhi)
    {
        $data = [
            'title'     => $request->title,
            'status'    => $request->status,
        ];

        if ($request->hasFile('ayinbidhi_pdf')) {

            $ayinbidhi_pdf_path = $request->file('ayinbidhi_pdf')->store('AyinbidhiPDFs', 'public');    // Upload and store the new PDF file
            
            if (Storage::exists($ayinbidhi->ayinbidhi_pdf)) {
                Storage::disk('public')->delete($ayinbidhi->ayinbidhi_pdf);     // Delete the old PDF file
            }

            $data['ayinbidhi_pdf'] = $ayinbidhi_pdf_path;   // Update the PDF path in the data array
        }

        $ayinbidhi->update($data);

        return redirect()->route('ayinbidhis.index')->with('success', 'আপনার আইন-ও-বিধি আপডেট করা হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ayinbidhi $ayinbidhi)
    {
        if (Storage::exists($ayinbidhi->ayinbidhi_pdf)) {
            Storage::disk('public')->delete($ayinbidhi->ayinbidhi_pdf);     // Delete the old PDF file
        }
        $ayinbidhi->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
