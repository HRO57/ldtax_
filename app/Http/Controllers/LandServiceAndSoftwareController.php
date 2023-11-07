<?php

namespace App\Http\Controllers;

use App\Models\LandServiceAndSoftware;
use App\Http\Requests\StoreLandServiceAndSoftwareRequest;
use App\Http\Requests\UpdateLandServiceAndSoftwareRequest;
use Illuminate\Http\Request;
use App\Http\Resources\AppsAndSoftwareResource;
use Illuminate\Support\Facades\Storage;



class LandServiceAndSoftwareController extends Controller
{

    // Display a listing of the resource.

    public function index(Request $request)
    {
        $data = new LandServiceAndSoftware();



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
                    'data' => AppsAndSoftwareResource::collection($data),

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


        return view('admin.appsandsoftware.index', compact('data', 'rank'));
    }


    // Show the form for creating a new resource.

    public function create()
    {
        return view('admin.appsandsoftware.create');
    }


    // Store a newly created resource in storage.

    public function store(StoreLandServiceAndSoftwareRequest $request)
    {
        $image_path = '';

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('LandServiceAndSoftwares', 'public');
        }

        $product = LandServiceAndSoftware::create([
            'show_sl'   => $request->show_sl ?? 0,
            'title'     => $request->title,
            'image'     => $image_path,     //Blade name 'app & software' if need to change validation than search 'LandServiceAndSoftwareRequest'
            'link'      => $request->link,
            'type'      => $request->type, // Make sure to include this line
            'status'    => $request->status
        ]);

        if (!$product) {
            return redirect()->back()->with('error', 'দুঃখিত, জমির সেবা এবং সফ্টওয়্যার তৈরি করার সময় একটি সমস্যা হয়েছে৷');
        }
        return redirect()->route('apps-and-softwares.index')->with('success', 'সফলভাবে, আপনার জমির সেবা এবং সফটওয়্যার তৈরি করা হয়েছে।');
    }



    // Display the specified resource.

    public function show(LandServiceAndSoftware $LandServiceAndSoftware)
    {
    }


    // Show the form for editing the specified resource.

    public function edit($landServiceAndSoftware)
    {
        $data = LandServiceAndSoftware::find($landServiceAndSoftware);

        return view('admin.appsandsoftware.edit', compact('data'));
    }


    // Update the specified resource in storage.

    public function update(UpdateLandServiceAndSoftwareRequest $request, $landServiceAndSoftware)
    {
        // dd($request->all());
        $data = LandServiceAndSoftware::find($landServiceAndSoftware);

        $image_path = $data->image; // Store the existing image path

        if ($request->hasFile('image')) {
            // Delete old image
            if ($data->image) {
                Storage::delete($data->image);
            }
            // Store new image
            $image_path = $request->file('image')->store('LandServiceAndSoftwares', 'public');
        }

        $updateData = [
            'show_sl'   => $request->show_sl,
            'title'     => $request->title,
            'image'     => $image_path,
            'status'    => $request->status,
            'link'      => $request->link, // Provide a default link if not provided
            'type'      => $request->type, // Provide a default type value if not provided
        ];

        $update = $data->update($updateData);

        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, জমির সেবা এবং সফ্টওয়্যার আপডেট করার সময় একটি সমস্যা হয়েছে৷');
        }
        return redirect()->route('apps-and-softwares.index')->with('success', 'সফলভাবে, আপনার জমির সেবা এবং সফ্টওয়্যার আপডেট করা হয়েছে.');
        
    }



    // Remove the specified resource from storage.

    public function destroy($landServiceAndSoftware)
    {
        $data = LandServiceAndSoftware::find($landServiceAndSoftware);

        if ($data->image) {
            Storage::delete($data->image);
        }
        $data->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
