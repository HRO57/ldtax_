<?php

namespace App\Http\Controllers;

use App\Models\FestiableImage;
use App\Http\Requests\StoreFestiableImageRequest;
use App\Http\Requests\UpdateFestiableImageRequest;
use Illuminate\Http\Request;
use App\Http\Resources\FestiableImagesResource;
use Illuminate\Support\Facades\Storage;

class FestiableImageController extends Controller
{

    // Display a listing of the resource.

    public function index(Request $request)
    {
        $data = new FestiableImage();
        $totalImages = $data->count();

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
                    'data' => FestiableImagesResource::collection($data),

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


        return view('admin.FestiableImage.index', compact('data', 'totalImages', 'rank'));
    }


    // Show the form for creating a new resource.

    public function create()
    {
        // Check if there are already 5 images

        $imageCount = FestiableImage::count();
        $disableCreateButton = $imageCount >= 5;

        return view('admin.FestiableImage.create', compact('disableCreateButton'));
    }



    // Store a newly created resource in storage.

    public function store(StoreFestiableImageRequest $request)
    {

        // Check if there are already 5 images
        // $imageCount = FestiableImage::count();

        // if ($imageCount >= 5) {
        //     return redirect()->back()->with('error', 'আপনি সর্বোচ্চ 5টি ছবি আপলোড করতে পারবেন.');
        // }

        $image_path = '';

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('FestiableImages', 'public');
        }

        $product = FestiableImage::create([
            'show_sl'   => $request->show_sl ?? 0,
            'title'     => $request->title,
            'image'     => $image_path,
            'status'    => $request->status
        ]);

        if (!$product) {
            return redirect()->back()->with('error', 'দুঃখিত, উৎসব-চিত্রের তৈরি করার সময় একটি সমস্যা হয়েছে৷.');
        }
        return redirect()->route('festivals-images.index')->with('success', 'সফলভাবে, আপনার উৎসব চিত্র তৈরি করা হয়েছে।');
    }


    // Display the specified resource.

    public function show(FestiableImage $festiableImage)
    {
    }


    // Show the form for editing the specified resource.

    public function edit($festiableImage)
    {
        $data = FestiableImage::find($festiableImage);
        return view('admin.FestiableImage.edit', compact('data'));
    }


    // Update the specified resource in storage.

    public function update(UpdateFestiableImageRequest $request, $festiableImage)
    {
        $data = FestiableImage::find($festiableImage);
        $image_path = $data->image;

        if ($request->hasFile('image')) {
        // Delete old image
        if ($data->image) {
            Storage::delete($data->image);
        }
        // Store image
        $image_path = $request->file('image')->store('FestiableImages', 'public');
        // Save to Database
        // $product->image = $image_path;
        }

        $update = $data->update([
            'show_sl'   => $request->show_sl ?? 0,
            'title'     => $request->title,
            'image'     => $image_path,
            'status'    => $request->status
        ]);

        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, উৎসব চিত্র আপডেট করার সময় একটি সমস্যা হয়েছে.');
        }
        return redirect()->route('festivals-images.index')->with('success', 'সফলভাবে, আপনার উৎসব চিত্র আপডেট করা হয়েছে।');
    }


    // Remove the specified resource from storage.

    public function destroy($festiableImage)
    {
        $data = FestiableImage::find($festiableImage);

        if ($data->image) {
            Storage::delete($data->image);
        }
        $data->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
