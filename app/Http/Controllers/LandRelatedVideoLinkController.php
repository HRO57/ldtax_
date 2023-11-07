<?php

namespace App\Http\Controllers;

use App\Models\LandRelatedVideoLink;
use App\Http\Requests\StoreLandRelatedVideoLinkRequest;
use App\Http\Requests\UpdateLandRelatedVideoLinkRequest;
use Illuminate\Http\Request;
use App\Http\Resources\LandRelatedVideoLinkResource;

class LandRelatedVideoLinkController extends Controller
{

    // Display a listing of the resource.

    public function index(Request $request)
    {
        $data = new LandRelatedVideoLink();

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
                    'data' => LandRelatedVideoLinkResource::collection($data),

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



        return view('admin.LandRelatedVideoLink.index', compact('data',  'rank'));
    }


    // Show the form for creating a new resource.

    public function create()
    {
        return view('admin.LandRelatedVideoLink.create');
    }


    // Store a newly created resource in storage.

    public function store(StoreLandRelatedVideoLinkRequest $request)
    {
        $data = [
            'show_sl' => $request->show_sl ?? 0,
            'title' => $request->title,
            'link' => $request->link,
            'status' => $request->status
        ];

        $landRelatedVideoLink = LandRelatedVideoLink::create($data);

        if (!$landRelatedVideoLink) {
            return redirect()->back()->with('error', 'দুঃখিত, জমি সম্পর্কিত ভিডিও লিঙ্ক তৈরি করার সময় একটি সমস্যা হয়েছে৷.');
        }

        return redirect()->route('land-related-video-links.index')->with('success', 'সফলভাবে, আপনার জমি সম্পর্কিত ভিডিও লিঙ্ক তৈরি করা হয়েছে.');
    }



    // Display the specified resource.

    public function show(LandRelatedVideoLink $landRelatedVideoLink)
    {
    }


    // Show the form for editing the specified resource.

    public function edit(LandRelatedVideoLink $landRelatedVideoLink)
    {
        $data = $landRelatedVideoLink;
        return view('admin.LandRelatedVideoLink.edit', compact('data'));
    }


    // Update the specified resource in storage.

    public function update(UpdateLandRelatedVideoLinkRequest $request, LandRelatedVideoLink $landRelatedVideoLink)
    {
        $data = $landRelatedVideoLink;

        $update = $data->update([
            'show_sl' => $request->show_sl ?? 0,
            'title' => $request->title,
            'link' => $request->link,
            'status' => $request->status
        ]);

        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, জমি সংক্রান্ত ভিডিও লিঙ্ক আপডেট করার সময় একটি সমস্যা হয়েছে.');
        }
        return redirect()->route('land-related-video-links.index')->with('success', 'সফলভাবে, আপনার জমি সম্পর্কিত ভিডিও লিঙ্ক আপডেট করা হয়েছে.');
    }



    public function destroy(LandRelatedVideoLink $landRelatedVideoLink)
    {
        $data = $landRelatedVideoLink;

        $data->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
