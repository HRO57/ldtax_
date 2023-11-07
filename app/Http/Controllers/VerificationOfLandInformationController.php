<?php

namespace App\Http\Controllers;

use App\Models\VerificationOfLandInformation;
use App\Http\Requests\StoreVerificationOfLandInformationRequest;
use App\Http\Requests\UpdateVerificationOfLandInformationRequest;
use App\Http\Resources\VerificationOfLandInformationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VerificationOfLandInformationController extends Controller
{

    // Display a listing of the resource.

    public function index(Request $request)
    {
        $data = new VerificationOfLandInformation();

        $data = $data->orderBy('show_sl', 'asc');

        if ($request->search) {
            $data = $data->where('show_sl', 'LIKE', "%{$request->search}%")
                ->orWhere('link', 'LIKE', "%{$request->search}%");
        }

        if (request()->wantsJson()) {
            $data = $data->status()->get();

            if ($data) {
                return response([
                    'status' => true,
                    'message' => 'তথ্য সফলভাবে দেখায়।',
                    'code' => 200,
                    'data' => VerificationOfLandInformationResource::collection($data),

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



        return view('admin.VerificationOfLandInformation.index', compact('data'));
    }


    // Show the form for creating a new resource.

    public function create()
    {
        return view('admin.VerificationOfLandInformation.create');
    }


    // Store a newly created resource in storage.

    public function store(StoreVerificationOfLandInformationRequest $request)
    {
        $image_path = '';

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('sliders', 'public');
        }
        $data = [
            'show_sl' => $request->show_sl ?? 0,
            'image' => $image_path,
            'title' => $request->title,
            'link' => $request->link,
            'status' => $request->status
        ];

        $verificationOfLandInformation = VerificationOfLandInformation::create($data);

        if (!$verificationOfLandInformation) {
            return redirect()->back()->with('error', 'দুঃখিত, জমির তথ্য যাচাইকরণ তৈরি করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('verification-infoes.index')->with('success', 'সফলভাবে, আপনার জমির তথ্য যাচাইকরণ তৈরি করা হয়েছে.');
    }



    // Display the specified resource.

    public function show(VerificationOfLandInformation $verificationOfLandInformation)
    {
    }


    // Show the form for editing the specified resource.

    public function edit($verificationOfLandInformation)
    {
        $data = VerificationOfLandInformation::find($verificationOfLandInformation);
        return view('admin.VerificationOfLandInformation.edit', compact('data'));
    }


    // Update the specified resource in storage.

    public function update(UpdateVerificationOfLandInformationRequest $request, $verificationOfLandInformation)
    {
        //  dd($request->all());
        // $data = $verificationOfLandInformation;
        $data = VerificationOfLandInformation::find($verificationOfLandInformation);

        if (!$data) {
            return redirect()->back()->with('error', 'রেকর্ড পাওয়া যায়নি।');
        }

        $image_path = $data->image;

        if ($request->hasFile('image')) {

            if ($data->image) {
                Storage::delete($data->image);      // Delete old image
            }

            $image_path = $request->file('image')->store('VerificationOfLandInformation', 'public');        // Store image

            // Save to Database
            // $product->image = $image_path;
        }

        $update = $data->update([
            'show_sl' => $request->show_sl ?? 0,
            'image' => $image_path,
            'title' => $request->title,
            'link' => $request->link,
            'status' => $request->status
        ]);

        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, জমির তথ্য যাচাইকরণ আপডেট করার সময় একটি সমস্যা হয়েছে।');
        }
        return redirect()->route('verification-infoes.index')->with('success', 'সফলভাবে, আপনার জমির তথ্য যাচাইকরণ আপডেট করা হয়েছে।');
    }



    public function destroy($verificationOfLandInformation)
    {
        $data = VerificationOfLandInformation::find($verificationOfLandInformation);

        if ($data->image) {
            Storage::delete($data->image);

            $data->delete();

            return response()->json([
                'success' => true
            ]);
        }
    }
}
