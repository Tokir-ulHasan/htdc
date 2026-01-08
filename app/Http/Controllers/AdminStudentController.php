<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use Illuminate\Http\Request;

class AdminStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(StudentApplication::orderBy('created_at', 'desc')->get());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = StudentApplication::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        return response()->json($student);
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
        $student = StudentApplication::find($id);
        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $validated = $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $student->update(['status' => $validated['status']]);

        return response()->json($student);
    }

    /**
     * External API to get student details by pin code.
     *
     * @param  string  $pinCode
     * @return \Illuminate\Http\Response
     */
    public function getStudentByPin(Request $request)
    {
        $pinCode = $request->query('pinCode');
        $student = StudentApplication::where('pinCode', $pinCode)->first();

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Student details retrieved successfully',
            'pass_status' => $student->status == 1 ? 'Passed' : 'Pending',
            'data' => $student
        ]);
    }
}
