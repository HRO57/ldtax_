<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Setting;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Http\Resources\SliderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SliderController extends Controller
{

    // Display a listing of the resource.

    public function index(Request $request)
    {
        $data = new Slider();

        $data = $data->orderBy('show_sl', 'asc');

        if ($request->search) {
            $data = $data->where('show_sl', 'LIKE', "%{$request->search}%");
        }

        if (request()->wantsJson()) {
            $data = $data->status()->get();

            if ($data) {
                return response([
                    'status' => true,
                    'message' => 'Data Show Successfully',
                    'code' => 200,
                    'data' => SliderResource::collection($data),

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


        return view('admin.slider.index', compact('data', 'rank'));
    }


    // Show the form for creating a new resource.

    public function create()
    {
        return view('admin.slider.create');
    }


    // Store a newly created resource in storage.

    public function store(StoreSliderRequest $request)
    {
        $image_path = '';

        $limit = Setting::first()->application_slider_limit ?? 10;
        if (Slider::count() >= $limit) {
            return redirect()->back()->with('error', 'আপনি শুধুমাত্র ' . $limit . ' টি স্লাইডার চিত্র আপলোড করতে পারবেন।');
        }

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('sliders', 'public');
        }

        $product = Slider::create([
            'show_sl' => $request->show_sl ?? 0,
            'title' => $request->title,
            'image' => $image_path,
            'status' => $request->status
        ]);

        if (!$product) {
            return redirect()->back()->with('error', 'দুঃখিত, স্লাইডার তৈরির একটি সমস্যা ছিল।');
        }

        return redirect()->route('sliders.index')->with('success', 'স্লাইডারটি সফলভাবে তৈরি করা হয়েছে।');
    }

    public function show(Slider $slider)
    {
    }


    // Show the form for editing the specified resource.

    public function edit(Slider $slider)
    {
        $data = $slider;
        return view('admin.slider.edit', compact('data'));
    }


    // Update the specified resource in storage.

    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $data = $slider;
        $image_path = $slider->image;

        // Check if the total number of slider images is less than 10
        if (Slider::count() >= 10) {
            return redirect()->back()->with('error', 'আপনি শুধুমাত্র ১০ টি স্লাইডার চিত্র আপলোড করতে পারবেন।');
        }

        if ($request->hasFile('image')) {
            // Handle image upload here
            $image_path = $request->file('image')->store('sliders', 'public');
        }

        $update = $data->update([
            'show_sl' => $request->show_sl,
            'title' => $request->title,
            'image' => $image_path,
            'status' => $request->status,
        ]);

        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, স্লাইডার আপডেট করার একটি সমস্যা ছিল।');
        }

        return redirect()->route('sliders.index')->with('success', 'স্লাইডারটি সফলভাবে আপডেট করা হয়েছে।');
    }


    // Remove the specified resource from storage.

    public function destroy(Slider $slider)
    {
        $data = $slider;
        if ($data->image) {
            Storage::delete($data->image);
        }
        $data->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
