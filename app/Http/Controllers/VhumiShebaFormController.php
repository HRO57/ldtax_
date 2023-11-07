<?php

namespace App\Http\Controllers;

use App\Models\VhumiShebaForm;
use App\Http\Requests\StoreVhumiShebaFormRequest;
use App\Http\Requests\UpdateVhumiShebaFormRequest;
use Illuminate\Http\Request;
use App\Http\Resources\VhumiShebaFormResource;
use Illuminate\Support\Facades\Storage;

class VhumiShebaFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = VhumiShebaForm::latest();

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
                    'data' => VhumiShebaFormResource::collection($data),
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

        return view('admin.VhumiShebaForm.index', compact('data', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.VhumiShebaForm.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVhumiShebaFormRequest $request)
    {
        $vhumi_sheba_form_pdf_path = '';

        if ($request->hasFile('vhumi_sheba_form_pdf')) {
            $vhumi_sheba_form_pdf_path = $request->file('vhumi_sheba_form_pdf')->store('vhumi_sheba_formsPDFs', 'public');
        }

        $data = [

            'title' => $request->title,
            'vhumi_sheba_form_pdf' => $vhumi_sheba_form_pdf_path,
            'status' => $request->status,
        ];

        $vhumi_sheba_form = VhumiShebaForm::create($data);

        if (!$vhumi_sheba_form) {
            return redirect()->back()->with('error', 'দুঃখিত, ভূমিসেবা ফর্ম তৈরি করার সময় একটি সমস্যা ছিল৷');
        }

        return redirect()->route('vhumi_sheba_forms.index')->with('success', 'সফলভাবে, আপনার ভূমিসেবা ফর্ম তৈরি করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(VhumiShebaForm $vhumi_sheba_form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VhumiShebaForm $vhumi_sheba_form)
    {
        $data = $vhumi_sheba_form;
        return view('admin.VhumiShebaForm.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVhumiShebaFormRequest $request, VhumiShebaForm $vhumi_sheba_form)
    {
        $data = [

            'title' => $request->title,
            'status' => $request->status,
        ];

        if ($request->hasFile('vhumi_sheba_form_pdf')) {

            $vhumi_sheba_form_pdf_path = $request->file('vhumi_sheba_form_pdf')->store('AyinbidhiPDFs', 'public');

            Storage::disk('public')->delete($vhumi_sheba_form->vhumi_sheba_form_pdf);

            $data['vhumi_sheba_form_pdf'] = $vhumi_sheba_form_pdf_path;
        }

        $vhumi_sheba_form->update($data);

        return redirect()->route('vhumi_sheba_forms.index')->with('success', 'সফলভাবে ভূমিসেবা ফর্ম আপডেট হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VhumiShebaForm $vhumi_sheba_form)
    {
        $vhumi_sheba_form->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
