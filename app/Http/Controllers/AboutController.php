<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    // 1. READ (Public Page)
    public function index()
    {
        $sections = AboutSection::orderBy('order')->get();
        return view('about.index', compact('sections'));
    }

    // 2. READ (Admin/Manage Page)
    public function manage()
    {
        $sections = AboutSection::orderBy('order')->get();
        return view('about.manage', compact('sections'));
    }

    // 3. CREATE
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/about/'; // Save to specific folder
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $profileImage);
            $input['image'] = "/$destinationPath$profileImage";
        }

        AboutSection::create($input);

        return redirect()->back()->with('success', 'Section added successfully!');
    }

    // 4. UPDATE
    public function update(Request $request, $id)
    {
        $section = AboutSection::findOrFail($id);
        
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/about/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $profileImage);
            $input['image'] = "/$destinationPath$profileImage";
        } else {
            unset($input['image']);
        }

        $section->update($input);

        return redirect()->back()->with('success', 'Section updated successfully!');
    }

    // 5. DELETE
    public function destroy($id)
    {
        AboutSection::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Section deleted successfully!');
    }
}