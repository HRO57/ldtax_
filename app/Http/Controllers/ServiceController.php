<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Resources\ServiceResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = new Service();

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
                    'data' => ServiceResource::collection($data),

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


        return view('admin.service.index', compact('data',  'rank'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreServiceRequest $request)
    {
        // dd($request->all());
        $image_path = '';

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('services', 'public');
        }

        $service = Service::create([

            'show_sl'                           => $request->input('show_sl', 0),
            'image'                             => $image_path,
            'title'                             => $request->input('title'),
            'short_description'                 => $request->input('short_description'),
            'link'                              => $request->input('link'),
            'app_link'                          => $request->input('app_link'),
            'long_description'                  => $request->input('long_description'),
            'sheba_praptir_somoy'               => $request->input('sheba_praptir_somoy'),
            'proyojoniyo_fee'                   => $request->input('proyojoniyo_fee'),
            'proyojoniyo_isthan'                => $request->input('proyojoniyo_isthan'),
            'dayetto_praptto_kormokortta'       => $request->input('dayetto_praptto_kormokortta'),
            'proyojoniyo_kagojpotro'            => $request->input('proyojoniyo_kagojpotro'),
            'songlistho_aino_bodhi'             => $request->input('songlistho_aino_bodhi'),
            'sheba_prodane_bertho'              => $request->input('sheba_prodane_bertho'),
            'sheba_prodane_proyojoniyo_link'    => $request->input('sheba_prodane_proyojoniyo_link'),
            'status'                            => $request->input('status'),
        ]);

        if (!$service) {
            return redirect()->back()->with('error', 'দুঃখিত, সেবা তৈরি করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('services.index')->with('success', 'সফলভাবে, আপনার সেবা তৈরি করা হয়েছে।');
    }




    public function show($id)
    {
        $service = new Service();
        $service = $service->where('id', $id)->first();

        if (request()->wantsJson()) {

            if ($service) {
                return response([
                    'status' => true,
                    'message' => 'Data Show Successfully',
                    'code' => 200,
                    'data' => $service,

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

        return view('admin.service.show', compact('service'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $data = $service;
        return view('admin.service.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)

    {
        $data = $service;
        $image_path = $data->image;

        if ($request->hasFile('image')) {
            if ($data->image) {
                Storage::delete('public/' . $data->image);   // Delete old image
            }
            $image_path = $request->file('image')->store('services', 'public'); // Store new image
        }

        $update = $data->update([
            'show_sl'                           => $request->show_sl ?? 0,
            'image'                             => $image_path,
            'title'                             => $request->title,
            'short_description'                 => $request->short_description,
            'link'                              => $request->link,
            'app_link'                          => $request->app_link,
            'long_description'                  => $request->long_description,
            'sheba_praptir_somoy'               => $request->sheba_praptir_somoy,
            'proyojoniyo_fee'                   => $request->proyojoniyo_fee,
            'proyojoniyo_isthan'                => $request->proyojoniyo_isthan,
            'dayetto_praptto_kormokortta'       => $request->dayetto_praptto_kormokortta,
            'proyojoniyo_kagojpotro'            => $request->proyojoniyo_kagojpotro,
            'songlistho_aino_bodhi'             => $request->songlistho_aino_bodhi,
            'sheba_prodane_bertho'              => $request->sheba_prodane_bertho,
            'sheba_prodane_proyojoniyo_link'    => $request->sheba_prodane_proyojoniyo_link,
            'status'                            => $request->status
        ]);

        if (!$update) {
            return redirect()->back()->with('error', 'দুঃখিত, সেবা আপডেট করার সময় একটি সমস্যা হয়েছে৷');
        }

        return redirect()->route('services.index')->with('success', 'সফলভাবে, আপনার সেবা আপডেট করা হয়েছে।');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $deleted = $service->delete();

        if ($deleted) {
            return redirect()->route('services.index')->with('success', 'সেবা মুছে ফেলা হয়েছে.');
        } else {
            return redirect()->back()->with('error', 'দুঃখিত, সেবাটি মুছে ফেলার সময় একটি সমস্যা হয়েছে৷');
        }
    }
}
