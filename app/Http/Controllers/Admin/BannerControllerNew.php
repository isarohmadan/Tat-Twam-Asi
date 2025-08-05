<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerControllerNew extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order')->get();
        $nextOrder = (Banner::max('order') ?? 0) + 1;

        return view('admin.banner.banner', compact('banners', 'nextOrder'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
        ]);

        $imagePath = $request->file('banner_image')->store('banners', 'public');

        Banner::create([
            'image_path' => $imagePath,
            'order' => $request->order ?? 1,
        ]);

        return back()->with('success', 'Banner uploaded successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $banner = Banner::findOrFail($id);

        if ($request->hasFile('banner_image')) {
            Storage::delete('public/' . $banner->image_path);
            $imagePath = $request->file('banner_image')->store('banners', 'public');
            $banner->image_path = $imagePath;
        }

        $banner->save();
        return back()->with('success', 'Banner updated successfully!');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        Storage::delete('public/' . $banner->image_path);
        $banner->delete();

        return back()->with('success', 'Banner deleted successfully!');
    }
}
