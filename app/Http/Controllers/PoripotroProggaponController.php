<?php

namespace App\Http\Controllers;

use App\Models\PoripotroProggapon;
use App\Http\Requests\StorePoripotroProggaponRequest;
use App\Http\Requests\UpdatePoripotroProggaponRequest;
use Illuminate\Http\Request;
use App\Http\Resources\PoripotroProggaponResource;
use Illuminate\Support\Facades\Storage;

class PoripotroProggaponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = PoripotroProggapon::latest();

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

        return view('admin.PoripotroProggapon.index', compact('data', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.PoripotroProggapon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePoripotroProggaponRequest $request)
    {
        $poripotro_proggapon_pdf_path = '';
        $poripotro_proggapon_doc_path = '';

        if ($request->hasFile('poripotro_proggapon_pdf')) {

            $poripotro_proggapon_pdf_path = $request->file('poripotro_proggapon_pdf')->store('PoripotroProggaponPDFDOCs', 'public');
        }

        if ($request->hasFile('poripotro_proggapon_doc')) {

            $poripotro_proggapon_doc_path = $request->file('poripotro_proggapon_doc')->store('PoripotroProggaponPDFDOCs', 'public');
        }

        $data = [

            'title' => $request->title,
            'poripotro_proggapon_pdf' => $poripotro_proggapon_pdf_path,
            'poripotro_proggapon_doc' => $poripotro_proggapon_doc_path,
            'status' => $request->status,
        ];

        $poripotro_proggapon = PoripotroProggapon::create($data);

        if (!$poripotro_proggapon) {
            return redirect()->back()->with('error', 'দুঃখিত, ভূমি সংক্রান্ত পরিপত্র/প্রজ্ঞাপন তৈরি করার সমস্যা ছিল৷');
        }

        return redirect()->route('poripotro_proggapons.index')->with('success', 'সফলভাবে, আপনার ভূমি সংক্রান্ত পরিপত্র/প্রজ্ঞাপন
                    তৈরি করা হয়েছে।');
    }

    /**
     * Display the specified resource.
     */
    public function show(PoripotroProggapon $poripotro_proggapon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PoripotroProggapon $poripotro_proggapon)
    {
        $data = $poripotro_proggapon;
        return view('admin.PoripotroProggapon.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePoripotroProggaponRequest $request, PoripotroProggapon $poripotro_proggapon)
    {
        $data = [

            'title' => $request->title,
            'status' => $request->status,
        ];

        if ($request->hasFile('poripotro_proggapon_pdf')) {

            $poripotro_proggapon_pdf_path = $request->file('poripotro_proggapon_pdf')->store('PoripotroProggaponPDFDOCs', 'public');

            Storage::disk('public')->delete($poripotro_proggapon->poripotro_proggapon_pdf);

            $data['poripotro_proggapon_pdf'] = $poripotro_proggapon_pdf_path;
        }

        if ($request->hasFile('poripotro_proggapon_doc')) {

            $poripotro_proggapon_doc_path = $request->file('poripotro_proggapon_doc')->store('PoripotroProggaponPDFDOCs', 'public');

            Storage::disk('public')->delete($poripotro_proggapon->poripotro_proggapon_doc);

            $data['poripotro_proggapon_doc'] = $poripotro_proggapon_doc_path;
        }

        $poripotro_proggapon->update($data);

        return redirect()->route('poripotro_proggapons.index')->with('success', 'ভূমি সংক্রান্ত পরিপত্র/প্রজ্ঞাপন সফলভাবে আপডেট হয়েছে।');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PoripotroProggapon $poripotro_proggapon)
    {
        $poripotro_proggapon->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
