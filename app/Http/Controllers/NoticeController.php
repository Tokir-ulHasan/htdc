<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Notice::orderBy('created_at', 'desc')->get());
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
            'title' => 'required|string',
            'category' => 'nullable|string',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'audience' => 'nullable|string',
            'version' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $targetDir = public_path('notices');
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $image->move($targetDir, $filename);
            $validated['image_path'] = 'notices/' . $filename;
        }

        $notice = Notice::create($validated);

        return response()->json($notice, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notice = Notice::find($id);
        if (!$notice) {
            return response()->json(['message' => 'Notice not found'], 404);
        }
        return response()->json($notice);
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
        $notice = Notice::find($id);
        if (!$notice) {
            return response()->json(['message' => 'Notice not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string',
            'category' => 'nullable|string',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'audience' => 'nullable|string',
            'version' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($notice->image_path && file_exists(public_path($notice->image_path))) {
                unlink(public_path($notice->image_path));
            }
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $targetDir = public_path('notices');
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $image->move($targetDir, $filename);
            $validated['image_path'] = 'notices/' . $filename;
        }

        $notice->update($validated);

        return response()->json($notice);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notice = Notice::find($id);
        if (!$notice) {
            return response()->json(['message' => 'Notice not found'], 404);
        }

        if ($notice->image_path && file_exists(public_path($notice->image_path))) {
            unlink(public_path($notice->image_path));
        }

        $notice->delete();

        return response()->json(['message' => 'Notice deleted']);
    }
}
