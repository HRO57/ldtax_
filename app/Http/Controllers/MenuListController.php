<?php

namespace App\Http\Controllers;

use App\Models\MenuList;
use App\Models\Setting;
use App\Http\Requests\StoreMenuListRequest;
use App\Http\Requests\UpdateMenuListRequest;
use App\Http\Resources\MenuListResource;
use Illuminate\Http\Request;

class MenuListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $data = new MenuList();

        $data = $data->orderBy('show_sl', 'asc');

        if ($request->search) {
            $data = $data->where('show_sl', 'LIKE', "%{$request->search}%")
                ->orWhere('link', 'LIKE', "%{$request->search}%");
        }

        if (request()->wantsJson()) {
            $data = $data->status()->get();

            $data = $data->filter(function ($item) {
                if ($item->is_main == 1) {
                    return $item['childs'] = MenuList::status()->where('parent_id', $item->id)->get();
                }
            });

            if ($data) {
                return response([
                    'status' => true,
                    'message' => 'তথ্য সফলভাবে দেখায়।',
                    'code' => 200,
                    'data' => $data->flatten(),
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

        return view('admin.menu-lists.index', compact('data', 'rank'));
        // Fetch all main menu items

        $mainMenus = MenuList::where('is_main', true)->orderBy('show_sl', 'asc')->get();

        // Fetch all child menu items
        $childMenus = MenuList::where('is_main', false)->orderBy('show_sl', 'asc')->get();

        return view('admin.menu-lists.index', compact('mainMenus', 'childMenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentMenus = MenuList::where('is_main', 1)->get();
        $isMain = request('is_main', 1);            // Default to 1 if not provided

        return view('admin.menu-lists.create', compact('parentMenus', 'isMain'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuListRequest $request)
    {
        // $limit = Setting::first()->application_menu_limit ?? 20;
        // if (MenuList::count() >= $limit) {
        //     $message = 'আপনি শুধুমাত্র ' . $limit . ' টি স্লাইডার চিত্র আপলোড করতে পারবেন।';
        //     return redirect()->back()->with('error', $message);
        // }

        $data = [
            'show_sl' => $request->show_sl ?? 0,
            'title' => $request->title,
            'link' => $request->link,
            'status' => $request->status,
            'is_main' => $request->is_main,
        ];

        if ($request->is_main == 0) {
            $data['parent_id'] = $request->parent_id;
        }

        $menulist = MenuList::create($data);

        if (!$menulist) {
            return redirect()->back()->with('error', 'দুঃখিত, মেনু তৈরি করার সময় একটি সমস্যা হয়েছে।');
        }
        return redirect()->route('menu-lists.index')->with('success', 'সফল ভাবে, আপনার মেনু তৈরি করা হয়েছে।');
    }


    public function show(MenuList $menuList)
    {
        return view('admin.menu-lists.show', compact('menuList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuList $menuList)
    {
        $parentMenus = MenuList::where('is_main', 1)->get();
        $isMain = $menuList->is_main; // Use the is_main value from the menu item

        return view('admin.menu-lists.edit', compact('menuList', 'parentMenus', 'isMain'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuListRequest $request, MenuList $menuList)
    {
        $data = [
            'show_sl' => $request->show_sl ?? 0,
            'title' => $request->title,
            'link' => $request->link,
            'is_main' => $request->is_main,
        ];

        if ($request->is_main == 0) {
            $data['parent_id'] = $request->parent_id;
        }

        // Check if 'status' is provided in the request before setting it
        if ($request->has('status')) {
            $data['status'] = $request->status;
        }

        $menuList->update($data);

        return redirect()->route('menu-lists.index')->with('success', 'মেনু আইটেম সফলভাবে আপডেট করা হয়েছে।');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuList $menuList)
    {
        $menuList->delete();

        return redirect()->route('menu-lists.index')->with('success', 'মেনু আইটেম সফলভাবে মুছে ফেলা হয়েছে.');
    }
}
