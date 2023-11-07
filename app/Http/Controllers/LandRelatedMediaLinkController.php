<?php

namespace App\Http\Controllers;

use App\Models\LandRelatedMediaLink;
use App\Http\Requests\StoreLandRelatedMediaLinkRequest;
use App\Http\Requests\UpdateLandRelatedMediaLinkRequest;
use Illuminate\Http\Request;
use App\Http\Resources\LandRelatedMediaLinkResource;

class LandRelatedMediaLinkController extends Controller
{

    // Display a listing of the resource.

    public function index(Request $request)
    {
        $data = new LandRelatedMediaLink();

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
                    'data' => LandRelatedMediaLinkResource::collection($data),

                ], 200);
            } else {
                return response([
                    'status' => false,
                    'message' => 'Data not found',
                    'code' => 404,
                    'data' => null,

                ], 404);
            }
        }

        $data = $data->latest()->paginate(10);
        $rank = $data->firstItem();


        return view('admin.LandRelatedMediaLink.index', compact('data', 'rank'));
    }


    // Show the form for creating a new resource.

    public function create()
    {
        return view('admin.LandRelatedMediaLink.create');
    }


    // Store a newly created resource in storage.

    public function store(StoreLandRelatedMediaLinkRequest $request)
    {
        $data = [
            'show_sl' => $request->show_sl ?? 0,
            'title' => $request->title,
            'link' => $request->link,
            'type' => $request->type,
            'status' => $request->status
        ];

        $landRelatedMediaLink = LandRelatedMediaLink::create($data);

        if (!$landRelatedMediaLink) {
            return redirect()->back()->with('error', 'দুঃখিত, জমি সম্পর্কিত মিডিয়া লিঙ্ক তৈরি করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('land-related-media-links.index')->with('success', 'সফলভাবে, আপনার জমি সংক্রান্ত মিডিয়া লিঙ্ক তৈরি করা হয়েছে।');
    }



    // Display the specified resource.

    public function show(LandRelatedMediaLink $landRelatedMediaLink)
    {
    }


    // Show the form for editing the specified resource.

    public function edit(LandRelatedMediaLink $landRelatedMediaLink)
    {
        $data = $landRelatedMediaLink;
        return view('admin.LandRelatedMediaLink.edit', compact('data'));
    }


    // Update the specified resource in storage.

    public function update(UpdateLandRelatedMediaLinkRequest $request, LandRelatedMediaLink $landRelatedMediaLink)
    {
        // dd($request->all());
        $data = $landRelatedMediaLink;

        $update = $data->update([
            'show_sl' => $request->show_sl ?? 0,
            'title' => $request->title,
            'link' => $request->link,
            'type' => $request->type,
            'status' => $request->status
        ]);


        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, জমি সম্পর্কিত মিডিয়া লিঙ্ক আপডেট করার সময় একটি সমস্যা হয়েছে৷');
        }
        return redirect()->route('land-related-media-links.index')->with('success', 'সফলভাবে, আপনার জমি সম্পর্কিত মিডিয়া লিঙ্ক আপডেট করা হয়েছে.');
    }



    public function destroy(LandRelatedMediaLink $landRelatedMediaLink)
    {
        $data = $landRelatedMediaLink;

        $data->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
