<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Gallery::orderBy('created_at', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sliderStatus' => 'boolean',
            'sliderTitle' => 'nullable|string',
            'sliderDescription' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();

            $targetDir = public_path('images/gellary');
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $image->move($targetDir, $filename);
            $validated['path'] = 'images/gellary/' . $filename;
        }

        $gallery = Gallery::create($validated);

        return response()->json($gallery, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['message' => 'Gallery item not found'], 404);
        }
        return response()->json($gallery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['message' => 'Gallery item not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sliderStatus' => 'boolean',
            'sliderTitle' => 'nullable|string',
            'sliderDescription' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            if ($gallery->path && file_exists(public_path($gallery->path))) {
                unlink(public_path($gallery->path));
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();

            $targetDir = public_path('images/gellary');
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $image->move($targetDir, $filename);
            $validated['path'] = 'images/gellary/' . $filename;
        }

        $gallery->update($validated);

        return response()->json($gallery);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['message' => 'Gallery item not found'], 404);
        }

        if ($gallery->path && file_exists(public_path($gallery->path))) {
            unlink(public_path($gallery->path));
        }

        $gallery->delete();

        return response()->json(['message' => 'Gallery item deleted']);
    }
}
