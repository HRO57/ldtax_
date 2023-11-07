<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import the DB facade for transactions

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        if (request()->wantsJson()) {
            if ($setting) {
                return response([
                    'status' => true,
                    'message' => 'তথ্য সফলভাবে দেখায়।',
                    'code' => 200,
                    'data' => SettingResource::collection($setting),

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

        return view('settings.edit', compact('setting'));
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'app_name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation for image upload
            // Add validation rules for other fields if needed
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            foreach ($validatedData as $key => $value) {
                $setting = Setting::firstOrCreate(['key' => $key]);
                $setting->value = $value;
                $setting->save();
            }

            // Update the application name in the config
            config(['app.name' => $validatedData['app_name']]);

            // Commit the transaction if all settings are saved successfully
            DB::commit();

            return redirect()->route('settings.edit')->with('success', 'সেটিংস সফলভাবে আপডেট হয়েছে৷');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();

            return redirect()->route('settings.edit')->with('error', 'সেটিংস আপডেট করতে ব্যর্থ হয়েছে৷ অনুগ্রহপূর্বক আবার চেষ্টা করুন।');
        }
    }

    public function update(Request $request)
    {

        $setting = Setting::first();
        $image_path = $setting->application_logo;

        if ($request->hasFile('application_logo')) {
            $image_path = $request->file('application_logo')->store('logo', 'public');
        }

        $setting->update([
            'application_name' => $request->application_name,
            'application_logo' => $image_path,
            'application_title' => $request->application_title,
            'application_slider_limit' => $request->application_slider_limit,
            'application_main_menu_limit' => $request->application_main_menu_limit,
        ]);


        return redirect()->back()->with('success', 'সেটিং সফলভাবে আপডেট করা হয়েছে।');
    }
}
