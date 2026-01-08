<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\NoticeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AdminStudentController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Admin Routes
Route::apiResource('notices', NoticeController::class);
Route::apiResource('galleries', GalleryController::class);
Route::apiResource('admin/students', AdminStudentController::class);
Route::get('external/student-status', [AdminStudentController::class, 'getStudentByPin']);

// Admin settings (stub)
Route::get('/admin/settings', function () {
    return response()->json([
        'settings' => [
            // Example placeholders; these can be populated from DB later
            'footer_link_1_label' => null,
            'footer_link_1_url' => null,
            'footer_link_2_label' => null,
            'footer_link_2_url' => null,
            'footer_link_3_label' => null,
            'footer_link_3_url' => null,
            'footer_link_4_label' => null,
            'footer_link_4_url' => null,
            'footer_link_5_label' => null,
            'footer_link_5_url' => null,
        ]
    ]);
});

// API routes for student application form
Route::get('/programs', function () {
    // Return sample program data for now
    return response()->json([
        ['id' => 1, 'name' => 'HSC','hscStatus'=>0,'admissionStatus'=>1, 'termsImage' => 'https://placehold.co/600x800?text=HSC+Terms+Conditions'],
        ['id' => 2, 'name' => 'Degree','hscStatus'=>1,'admissionStatus'=>0, 'termsImage' => 'https://placehold.co/600x800?text=Degree+Terms+Conditions'],
        ['id' => 3, 'name' => 'Honours','hscStatus'=>1,'admissionStatus'=>1, 'termsImage' => 'https://placehold.co/600x800?text=Honours+Terms+Conditions'],
    ]);
});

Route::get('/sessions', function () {
    // Return sample session data for now
    return response()->json([
        ['session' => '2024-2025','admissionStatus'=>1],
        ['session' => '2023-2024', 'admissionStatus'=>0],
        ['session' => '2022-2023','admissionStatus'=>0], // Inactive session
    ]);
});

Route::get('/groups', function () {
    // Return sample group data for now
    return response()->json([
        ['id' => 1, 'name' => 'Science', 'programId' => 1,'admissionStatus'=>1],
        ['id' => 2, 'name' => 'Business Studies', 'programId' => 1,'admissionStatus'=>1],
        ['id' => 3, 'name' => 'Humanities', 'programId' => 1,'admissionStatus'=>1],
        ['id' => 4, 'name' => 'BA', 'programId' => 2,'admissionStatus'=>1],
        ['id' => 5, 'name' => 'BSS', 'programId' => 2,'admissionStatus'=>1], 
        ['id' => 6, 'name' => 'BBS', 'programId' => 2,'admissionStatus'=>1], 
        ['id' => 7, 'name' => 'Accounting', 'programId' => 3,'admissionStatus'=>1], 
        ['id' => 8, 'name' => 'Management', 'programId' => 3,'admissionStatus'=>1], 
        ['id' => 9, 'name' => 'Economics', 'programId' => 3,'admissionStatus'=>0], 
    ]);
});

Route::get('/subjects', function () {
    // Return sample group data for now
    // status 0 is for selecte table groupId 0 for all group
    return response()->json([
        ['id' => 1, 'name' => 'BENGALI [101-102]', 'status' => 1,'groupId' => 0,    'programId' => 1],
        ['id' => 2, 'name' => 'ENGLISH [107-108]', 'status' => 2,'groupId' => 0,'programId' => 1],
        ['id' => 3, 'name' => 'ICT [275]', 'status' => 3,'groupId' => 0,'programId' => 1],
        ['id' => 4, 'name' => 'PHYSICS [174-175]', 'status' => 4,'groupId' => 1,    'programId' => 1],
        ['id' => 5, 'name' => 'CHEMISTRY [176-177]', 'status' => 5,'groupId' => 1,    'programId' => 1],
        ['id' => 6, 'name' => 'HIGHER MATHEMATICS [265-266]', 'status' => 0,'groupId' => 1, 'programId' => 1],
        ['id' => 8, 'name' => 'BIOLOGY [178-179]', 'status' => 0,'groupId' => 1,    'programId' => 1],
        ['id' => 9, 'name' => 'BUSINESS ORGANIZATION & MANAGEMENT [277-278]', 'status' => 4,'groupId' => 2,    'programId' => 1],
        ['id' => 10, 'name' => 'ACCOUNTING [253-254]', 'status' => 5,'groupId' => 2,    'programId' => 1],
        ['id' => 11, 'name' => 'PRODUCTION MANAGEMENT & MARKETING [286-287]', 'status' => 6,'groupId' => 2,    'programId' => 1],
        ['id' => 12, 'name' => 'ECONOMICS [109-110]', 'status' => 7,'groupId' => 2,'programId'=> 1],
        ['id' => 13, 'name' => 'ECONOMICS [109-110]', 'status' => 0,'groupId' => 3,    'programId' => 1],
        ['id' => 14, 'name' => 'LOGIC [121-122]', 'status' => 0,'groupId' => 3,    'programId' => 1],
        ['id' => 15, 'name' => 'CIVICS & GOOD GOVERNANCE [269-270]', 'status' => 0,'groupId' => 3,    'programId' => 1],
        ['id' => 16, 'name' => 'SOCIOLOGY [117-118]', 'status' => 0,'groupId' => 3,    'programId' => 1],
        ['id' => 17, 'name' => 'ISLAMIC HISTORY & CULTURE [267-268]', 'status' => 0,'groupId' => 3,'programId'=> 1]
       
    ]);
});



// Student application submission route
Route::post('/student-apply', function (Request $request) {
    // Extract formData from the request
    $formData = $request->input('formData', []);

    // Fallback for cases where formData is not parsed as array
    if (empty($formData) || !is_array($formData)) {
        $formData = [];
        $allInput = $request->all();
        
        foreach ($allInput as $key => $value) {
            if (preg_match('/^formData\[(.+)\]$/', $key, $matches)) {
                $field = $matches[1];
                $formData[$field] = $value;
            }
        }
    }
    
    // Handle image upload if present
    $imagePath = null;
    if ($request->hasFile('sPicture')) {
        $image = $request->file('sPicture');
        $extension = $image->getClientOriginalExtension();
        // Use sscReg or similar as filename, if available in formData
        $sscReg = $formData['sscReg'] ?? 'unknown_reg';
        // Sanitize filename to be safe
        $safeFilename = preg_replace('/[^a-zA-Z0-9_-]/', '', $sscReg);
        if (empty($safeFilename)) {
            $safeFilename = 'student_' . time();
        }
        $filename = $safeFilename . '.' . $extension;
        
        // Store in public/images/studentapp with the custom filename
        $targetDir = public_path('images/studentapp');
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $image->move($targetDir, $filename);
        $imagePath = 'images/studentapp/' . $filename; // Update the form data with the relative path for storage access if needed, or just the path relative to public
        $formData['sPicture'] = $imagePath; // Update the form data with the image path
    } elseif (isset($formData['sPicture'])) {
        // If image path is provided in form data
        $imagePath = $formData['sPicture'];
    }
    
    // Generate pincode from session
    $session = $formData['session'] ?? '';
    $sessionCode = '';
    
    // Extract the last two digits from the session string (e.g., '25' from '2024-2025')
    if (preg_match('/^(\d{4})-(\d{4})/', $session, $matches)) {
        // Extract last two digits of the second year (matches[2])
        $sessionCode = substr($matches[2], -2);
    } else {
        $sessionCode = '00';
    }
    
    // Generate 4 random digits for pincode
    $randomDigits = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
    $pincode = $sessionCode . $randomDigits;
    
    // Ensure pincode is unique
    while (\App\Models\StudentApplication::where('pinCode', $pincode)->exists()) {
        $randomDigits = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $pincode = $sessionCode . $randomDigits;
    }
    
    // Prepare data for database insertion
    $applicationData = $formData;
    // Remove 'pincode' (lowercase) if it exists to avoid ambiguity
    if (isset($applicationData['pincode'])) {
        unset($applicationData['pincode']);
    }
    
    $applicationData['sPicture'] = $imagePath;
    $applicationData['pinCode'] = $pincode;
    $applicationData['nid'] = $applicationData['nid'] ?? 0; // Default nid to 0 if not provided
    
    // Map academic info to database columns
    $applicationData['examName1'] = 'SSC';
    $applicationData['Board1'] = $applicationData['sscBoard'] ?? null;
    $applicationData['passingYear1'] = $applicationData['sscYear'] ?? null;
    $applicationData['rollNo1'] = $applicationData['sscRoll'] ?? null;
    $applicationData['regNo1'] = $applicationData['sscReg'] ?? null;
    $applicationData['sessionExam1'] = $applicationData['sscSession'] ?? null;
    $applicationData['gpa1'] = $applicationData['sscGpa'] ?? null;
    
    if (isset($applicationData['hscBoard']) || isset($applicationData['hscYear'])) {
        $applicationData['examName2'] = 'HSC';
        $applicationData['Board2'] = $applicationData['hscBoard'] ?? null;
        $applicationData['passingYear2'] = $applicationData['hscYear'] ?? null;
        $applicationData['rollNo2'] = $applicationData['hscRoll'] ?? null;
        $applicationData['regNo2'] = $applicationData['hscReg'] ?? null;
        $applicationData['sessionExam2'] = $applicationData['hscSession'] ?? null;
        $applicationData['gpa2'] = $applicationData['hscGpa'] ?? null;
    }
    
    // Validate required fields
    $validator = \Validator::make($applicationData, [
        'program' => 'required',
        'group' => 'required',
        'session' => 'required',
        'sNameEnglish' => 'required',
        'sNameBangla' => 'required',
        'gender' => 'required',
        'religion' => 'required',
        'bloodGroup' => 'required',
        'dob' => 'required|date',
        'sMobileNo' => 'required|digits:11',
        'bitId' => 'required',
        'maritalStatus' => 'required',
        'sPicture' => 'required',
        'fName' => 'required',
        'mName' => 'required',
        'fMobileNo' => 'required|digits:11',
        'presentAddressVil' => 'required',
        'presentAddressPO' => 'required',
        'presentAddressPS' => 'required',
        'presentAddressDist' => 'required',
        'permanentAddressVil' => 'required',
        'permanentAddressPO' => 'required',
        'permanentAddressPS' => 'required',
        'permanentAddressDist' => 'required',
        'gName' => 'required',
        'gMobileNo' => 'required|digits:11',
        'sscBoard' => 'required',
        'sscYear' => 'required',
        'hscBoard' => 'required_if:program,Degree,Honours',
        'hscYear' => 'required_if:program,Degree,Honours',
        'compulsory1' => 'required_if:program,HSC,HSC Program,Higher Secondary',
        'compulsory2' => 'required_if:program,HSC,HSC Program,Higher Secondary',
        'compulsory3' => 'required_if:program,HSC,HSC Program,Higher Secondary',
        'elective1' => 'required_if:program,HSC,HSC Program,Higher Secondary',
        'agreed' => 'required|in:1,true,1.0,yes,on',
    ]);
    
    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 422);
    }
    
    // Save to database
    $application = \App\Models\StudentApplication::create($applicationData);
    
    return response()->json(['id' => $application->id, 'pincode' => $pincode, 'message' => 'Application submitted successfully']);
});

// Route to get student application by pincode
Route::get('/student-application/by-pincode/{pincode}', function ($pincode) {
    $application = \App\Models\StudentApplication::where('pinCode', $pincode)->first();
    
    if (!$application) {
        return response()->json(['error' => 'Application not found'], 404);
    }
    
    return response()->json($application);
});

// Route to get student application by ID (fallback)
Route::get('/student-application/{id}', function ($id) {
    $application = \App\Models\StudentApplication::find($id);
    
    if (!$application) {
        return response()->json(['error' => 'Application not found'], 404);
    }
    
    return response()->json($application);
});

// Route to generate PDF
Route::get('/student-application/{id}/download-pdf', function ($id) {
    $application = \App\Models\StudentApplication::find($id);
    
    if (!$application) {
        return response()->json(['error' => 'Application not found'], 404);
    }
    
    // Load PDF view
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('student.pdf', compact('application'));
    
    // Use SSC Registration Number as filename if available, otherwise default
    $filename = ($application->regNo1 ?? 'application') . '.pdf';
    
    return $pdf->download($filename);
});
