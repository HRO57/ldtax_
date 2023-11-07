<?php

namespace App\Http\Controllers;

use App\Models\Manual;
use App\Http\Requests\StoreManualRequest;
use App\Http\Requests\UpdateManualRequest;
use Illuminate\Http\Request;
use App\Http\Resources\PoripotroProggaponResource;
use Illuminate\Support\Facades\Storage;

class ManualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Manual::latest();

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
                    'data' => PoripotroProggaponResource::collection($data),
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

        return view('admin.Manual.index', compact('data', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Manual.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreManualRequest $request)
    {
        $manual_pdf_path = '';
        $manual_doc_path = '';

        if ($request->hasFile('manual_pdf')) {
            $manual_pdf_path = $request->file('manual_pdf')->store('ManualPDFDOCs', 'public');
        }

        if ($request->hasFile('manual_doc')) {
            $manual_doc_path = $request->file('manual_doc')->store('ManualPDFDOCs', 'public');
        }

        $data = [
            'title' => $request->title,
            'manual_pdf' => $manual_pdf_path,
            'manual_doc' => $manual_doc_path,
            'status' => $request->status,
        ];

        $manual = Manual::create($data);

        if (!$manual) {
            return redirect()->back()->with('error', 'দুঃখিত, ভূমি মন্ত্রণালয়ের ম্যানুয়াল তৈরি করার সমস্যা ছিল৷');
        }

        return redirect()->route('manuals.index')->with('success', 'সফলভাবে, আপনার ভূমি মন্ত্রণালয়ের ম্যানুয়াল তৈরি করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(Manual $manual)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manual $manual)
    {
        $data = $manual;
        return view('admin.Manual.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManualRequest $request, Manual $manual)
    {
        $data = [
            'title' => $request->title,
            'status' => $request->status,
        ];


        if ($request->hasFile('manual_pdf')) {
            $manual_pdf_path = $request->file('manual_pdf')->store('ManualPDFDOCs', 'public');


            if (Storage::exists($manual->manual_pdf)) {
                Storage::disk('public')->delete($manual->manual_pdf);     // Delete the old PDF file
            }

            $data['manual_pdf'] = $manual_pdf_path;
        }

        if ($request->hasFile('manual_doc')) {
            $manual_doc_path = $request->file('manual_doc')->store('ManualPDFDOCs', 'public');

            if (Storage::exists($manual->manual_doc)) {
                Storage::disk('public')->delete($manual->manual_doc);     // Delete the old PDF file
            }
            $data['manual_doc'] = $manual_doc_path;
        }

        $manual->update($data);

        return redirect()->route('manuals.index')->with('success', 'আপনার ভূমি মন্ত্রণালয়ের ম্যানুয়াল সফলভাবে আপডেট হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manual $manual)
    {
        if (Storage::exists($manual->manual_pdf)) {
            Storage::disk('public')->delete($manual->manual_pdf);     // Delete the old PDF file
        }

        if (Storage::exists($manual->manual_doc)) {
            Storage::disk('public')->delete($manual->manual_doc);     // Delete the old PDF file
        }
        $manual->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
