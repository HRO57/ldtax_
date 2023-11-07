<?php

namespace App\Http\Controllers;

use App\Models\RecentUpdate;
use App\Http\Requests\StoreRecentUpdateRequest;
use App\Http\Requests\UpdateRecentUpdateRequest;
use App\Http\Resources\RecentUpdateResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecentUpdateController extends Controller
{

    // Display a listing of the resource.

    public function index(Request $request)
    {
        $data = new RecentUpdate();

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
                    'data' => RecentUpdateResource::collection($data),

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

        return view('admin.RecentUpdate.index', compact('data', 'rank'));
    }


    // Show the form for creating a new resource.

    public function create()
    {
        return view('admin.RecentUpdate.create');
    }


    // Store a newly created resource in storage.

    public function store(StoreRecentUpdateRequest $request)
    {
        $image_path = '';

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('RecentUpdate', 'public');
        }
        $data = [
            'show_sl'   => $request->show_sl ?? 0,
            'title'     => $request->title,
            'image'     => $image_path,
            'details'   => $request->details,
            // 'link' => $request->link,
        ];

        $recentUpdate = RecentUpdate::create($data);

        if (!$recentUpdate) {
            return redirect()->back()->with('error', 'দুঃখিত, সাম্প্রতিক আপডেট তৈরি করার সময় একটি সমস্যা হয়েছে৷.');
        }

        return redirect()->route('recent-updates.index')->with('success', 'সফলভাবে, আপনার সাম্প্রতিক আপডেট তৈরি করা হয়েছে।');
    }



    // Display the specified resource.

    public function show(RecentUpdate $recentUpdate)
    {
        if (request()->wantsJson()) {

            if ($recentUpdate) {
                return response([
                    'status' => true,
                    'message' => 'তথ্য সফলভাবে দেখায়।',
                    'code' => 200,
                    'data' => ['data' => $recentUpdate, 'related_more' => RecentUpdate::latest()->limit(10)->get()],

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
    }


    // Show the form for editing the specified resource.

    public function edit(RecentUpdate $recentUpdate)
    {
        $data = $recentUpdate;
        return view('admin.RecentUpdate.edit', compact('data'));
    }


    // Update the specified resource in storage.

    public function update(UpdateRecentUpdateRequest $request, RecentUpdate $recentUpdate)
    {
        $data = $recentUpdate;
        $image_path = $recentUpdate->image;

        if ($request->hasFile('image')) {

            if ($data->image) {
                // Storage::delete($data->image);   // Delete old image
                Storage::delete('public/' . $data->image);
            }

            $image_path = $request->file('image')->store('RecentUpdate', 'public');
        } else {

            $image_path = $data->image;
        }

        $update = $data->update([
            // 'show_sl' => $request->show_sl ?? 0,
            'title'     => $request->title,
            'image'     => $image_path,
            'details'   => $request->details,
            // 'link' => $request->link,
        ]);

        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, সাম্প্রতিক আপডেট আপডেট করার সময় একটি সমস্যা হয়েছে৷.');
        }
        return redirect()->route('recent-updates.index')->with('success', 'সফলভাবে, আপনার সাম্প্রতিক আপডেট আপডেট করা হয়েছে।');
    }



    public function destroy(RecentUpdate $recentUpdate)
    {
        $data = $recentUpdate;
        if ($data->image) {
            Storage::delete($data->image);

            $data->delete();

            return response()->json([
                'success' => true
            ]);
        }
    }
}
