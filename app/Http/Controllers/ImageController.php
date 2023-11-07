<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);


        $image = $request->file('image'); // Get the uploaded file


        $imageName = time() . '.' . $image->getClientOriginalExtension(); // Generate a unique name for the image


        $image->move(public_path('uploads'), $imageName); // Move the image to the public/uploads directory


        return '/uploads/' . $imageName; // Return the path to the uploaded image
    }

    public function showLoginForm()
    {
        $backgroundImage = '/uploads/land3.jpg'; // Replace with the actual path to your background image

        return view('auth.login', compact('backgroundImage'));
    }
}
