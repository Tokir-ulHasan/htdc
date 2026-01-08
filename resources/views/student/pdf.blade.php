<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Student Application Form</title>
    <style>
        body {
            font-family: 'Bangla', sans-serif;
            font-size: 14px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h2 {
            margin: 0;
            padding: 0;
        }
        .photo-box {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 120px;
            height: 140px;
            border: 1px solid #000;
        }
        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            width: 30%;
        }
        .section-title {
            background-color: #333;
            color: #fff;
            padding: 5px 10px;
            margin-top: 20px;
            margin-bottom: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Student Application Form</h2>
        <p>Session: {{ $application->session }} | Program: {{ $application->program }}</p>
        <p><strong>Pincode: {{ $application->pinCode }}</strong></p>
    </div>

    @if($application->sPicture)
    <div class="photo-box">
        <img src="{{ public_path($application->sPicture) }}" alt="Student Photo">
    </div>
    @endif

    <div class="section-title">Personal Information</div>
    <table>
        <tr>
            <th>Student Name (English)</th>
            <td>{{ $application->sNameEnglish }}</td>
        </tr>
        <tr>
            <th>Student Name (Bangla)</th>
            <td>{{ $application->sNameBangla }}</td>
        </tr>
        <tr>
            <th>Gender</th>
            <td>{{ $application->gender }}</td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td>{{ \Carbon\Carbon::parse($application->dob)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Blood Group</th>
            <td>{{ $application->bloodGroup }}</td>
        </tr>
        <tr>
            <th>Religionsdffdf</th>
            <td>{{ $application->religion }}</td>
        </tr>
        <tr>
            <th>Mobile No</th>
            <td>{{ $application->sMobileNo }}</td>
        </tr>
        <tr>
            <th>NID / Birth Cert</th>
            <td>{{ $application->bitId }}</td>
        </tr>
    </table>

    <div class="section-title">Parent Information</div>
    <table>
        <tr>
            <th>Father's Name</th>
            <td>{{ $application->fName }}</td>
        </tr>
        <tr>
            <th>Father's Mobile</th>
            <td>{{ $application->fMobileNo }}</td>
        </tr>
        <tr>
            <th>Mother's Name</th>
            <td>{{ $application->mName }}</td>
        </tr>
        <tr>
            <th>Mother's Mobile</th>
            <td>{{ $application->mMobileNo }}</td>
        </tr>
    </table>

    <div class="section-title">Academic Information (SSC)</div>
    <table>
        <tr>
            <th>Board</th>
            <td>{{ $application->Board1 }}</td>
        </tr>
        <tr>
            <th>Passing Year</th>
            <td>{{ $application->passingYear1 }}</td>
        </tr>
        <tr>
            <th>Roll No</th>
            <td>{{ $application->rollNo1 }}</td>
        </tr>
        <tr>
            <th>Registration No</th>
            <td>{{ $application->regNo1 }}</td>
        </tr>
        <tr>
            <th>GPA</th>
            <td>{{ $application->gpa1 }}</td>
        </tr>
    </table>

    <div class="section-title">Address</div>
    <table>
        <tr>
            <th>Present Address</th>
            <td>
                {{ $application->presentAddressVil }}, {{ $application->presentAddressPO }}, 
                {{ $application->presentAddressPS }}, {{ $application->presentAddressDist }}
            </td>
        </tr>
        <tr>
            <th>Permanent Address</th>
            <td>
                {{ $application->permanentAddressVil }}, {{ $application->permanentAddressPO }}, 
                {{ $application->permanentAddressPS }}, {{ $application->permanentAddressDist }}
            </td>
        </tr>
    </table>
</body>
</html>
