<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use Illuminate\Http\Request;
use App\Http\Resources\FaqResource;

class FaqController extends Controller
{

    // Display a listing of the resource.

    public function index(Request $request)
    {
        $data = new Faq();

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
                    'data' => FaqResource::collection($data),

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


        return view('admin.faq.index', compact('data', 'rank'));
    }


    //Show the form for creating a new resource.

    public function create()
    {
        return view('admin.faq.create');
    }


    // Store a newly created resource in storage.

    public function store(StoreFaqRequest $request)
    {
        $data = [
            'show_sl'   => $request->show_sl ?? 0,
            'question'  => $request->question,
            'answer'    => $request->answer,
            'status'    => $request->status
        ];

        $faq = Faq::create($data);

        if (!$faq) {
            return redirect()->back()->with('error', 'দুঃখিত, জিজ্ঞাসিত প্রশ্ন তৈরি করার সময় একটি সমস্যা ছিল৷');
        }

        return redirect()->route('faqs.index')->with('success', 'সফলভাবে, আপনার জিজ্ঞাসিত প্রশ্ন তৈরি করা হয়েছে.');
    }


    // Display the specified resource.

    public function show(Faq $faq)
    {
    }


    // Show the form for editing the specified resource.

    public function edit(Faq $faq)
    {
        $data = $faq;
        return view('admin.faq.edit', compact('data'));
    }


    // Update the specified resource in storage.

    public function update(UpdateFaqRequest $request, Faq $faq)
    {
        $data = $faq;

        $update = $data->update([
            'show_sl'   => $request->show_sl ?? 0,
            'question'  => $request->question,
            'answer'    => $request->answer,
            'status'    => $request->status
        ]);

        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, প্রায়শই জিজ্ঞাসিত প্রশ্নগুলি আপডেট করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('faqs.index')->with('success', 'সফলভাবে, আপনার প্রায়শই জিজ্ঞাসিত প্রশ্ন আপডেট করা হয়েছে।');
    }



    // Remove the specified resource from storage.

    public function destroy(Faq $faq)
    {
        $faq->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
