<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_applications', function (Blueprint $table) {
            $table->id();
            $table->string('program')->nullable();
            $table->string('group')->nullable();
            $table->string('session')->nullable();
            $table->string('sNameBangla')->nullable();
            $table->string('sNameEnglish')->nullable();
            $table->string('bloodGroup')->nullable();
            $table->string('religion')->nullable();
            $table->string('gender')->nullable();
            $table->dateTime('dob')->nullable();
            $table->bigInteger('bitId')->nullable();
            $table->bigInteger('nid');
            $table->string('nationality')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->bigInteger('sMobileNo');
            $table->string('sPicture')->nullable();
            $table->string('fName')->nullable();
            $table->bigInteger('fNid')->nullable();
            $table->string('fQualification')->nullable();
            $table->string('fOccupation')->nullable();
            $table->bigInteger('fMonthlyIncome')->nullable();
            $table->bigInteger('fMobileNo')->nullable();
            $table->string('mName')->nullable();
            $table->bigInteger('mNid')->nullable();
            $table->string('mQualification')->nullable();
            $table->string('mOccupation')->nullable();
            $table->bigInteger('mMonthlyIncome')->nullable();
            $table->bigInteger('mMobileNo')->nullable();
            $table->string('permanentAddressVil')->nullable();
            $table->string('permanentAddressPO')->nullable();
            $table->string('permanentAddressPS')->nullable();
            $table->string('permanentAddressDist')->nullable();
            $table->string('presentAddressVil')->nullable();
            $table->string('presentAddressPO')->nullable();
            $table->string('presentAddressPS')->nullable();
            $table->string('presentAddressDist')->nullable();
            $table->string('gName')->nullable();
            $table->bigInteger('gNid')->nullable();
            $table->string('gRelation')->nullable();
            $table->bigInteger('gMobileNo')->nullable();
            $table->string('gEmail')->nullable();
            $table->string('gAddress')->nullable();
            $table->string('refName')->nullable();
            $table->bigInteger('refNid')->nullable();
            $table->string('refRelation')->nullable();
            $table->bigInteger('refMobileNo')->nullable();
            $table->string('refEmail')->nullable();
            $table->string('refAddress')->nullable();
            $table->string('examName1')->nullable();
            $table->string('rollNo1')->nullable();
            $table->string('regNo1')->nullable();
            $table->string('sessionExam1')->nullable();
            $table->float('gpa1')->nullable();
            $table->string('passingYear1')->nullable();
            $table->string('Board1')->nullable();
            $table->string('examName2')->nullable();
            $table->string('rollNo2')->nullable();
            $table->string('regNo2')->nullable();
            $table->string('sessionExam2')->nullable();
            $table->float('gpa2')->nullable();
            $table->string('passingYear2')->nullable();
            $table->string('Board2')->nullable();
            $table->string('compulsory1')->nullable();
            $table->string('compulsory2')->nullable();
            $table->string('compulsory3')->nullable();
            $table->string('elective1')->nullable();
            $table->string('elective2')->nullable();
            $table->string('elective3')->nullable();
            $table->string('optional')->nullable();
            $table->integer('status')->default(0);
            $table->string('hobby')->nullable();
            $table->string('extracurriculam')->nullable();
            $table->dateTime('created_date')->default(now());
            $table->string('pinCode')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_applications');
    }
};
