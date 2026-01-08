<template>
  <div class="max-w-4xl mx-auto p-4">
    <!-- Progress Bar -->
    <div class="mb-8">
      <div class="flex justify-between mb-2">
        <div 
          v-for="(step, i) in steps" 
          :key="i" 
          :class="['text-xs md:text-sm font-medium', i <= currentStep ? 'text-green-700' : 'text-gray-400']"
        >
          {{ step.title }}
        </div>
      </div>
      <div class="w-full bg-gray-200 h-2 rounded-full">
        <div 
          class="bg-green-700 h-2 rounded-full transition-all duration-300"
          :style="{ width: `${((currentStep + 1) / steps.length) * 100}%` }"
        ></div>
      </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-6 mb-6 border-t-4 border-green-700">
      <h2 class="text-xl font-bold mb-6 text-gray-800 border-b pb-2">{{ steps[currentStep].title }}</h2>
      
      <component 
        :is="steps[currentStep].component"
        :formData="formData" 
        :formErrors="formErrors" 
        :onChange="onChange" 
        :stepNumber="currentStep + 1"
      />

      <div v-if="submitError" class="mt-4 p-3 bg-red-100 text-red-700 rounded border border-red-200">
        {{ submitError }}
      </div>

      <div class="mt-8 flex justify-between">
        <button
          @click="handlePrev"
          :disabled="currentStep === 0 || isSubmitting"
          v-if="!applicationSubmitted"
          :class="[
            'px-6 py-2 rounded font-medium',
            currentStep === 0 
              ? 'bg-gray-100 text-gray-400 cursor-not-allowed' 
              : 'bg-gray-200 text-gray-700 hover:bg-gray-300'
          ]"
        >
          Previous
        </button>

        <button
          v-if="currentStep === 7"
          @click="handleSubmit"
          :disabled="isSubmitting"
          class="px-6 py-2 bg-green-700 text-white rounded font-medium hover:bg-green-800 disabled:opacity-50"
         >
          {{ isSubmitting ? 'Submitting...' : 'Submit Application' }}
        </button>
        <button
          v-else-if="currentStep === steps.length - 1 && !applicationSubmitted"
          @click="handleSubmit"
          :disabled="isSubmitting"
          class="px-6 py-2 bg-green-700 text-white rounded font-medium hover:bg-green-800 disabled:opacity-50"
        >
          {{ isSubmitting ? 'Submitting...' : 'Submit Application' }}
        </button>
        <button
          v-else-if="currentStep === steps.length - 1 && applicationSubmitted"
          @click="handleReset"
          class="px-6 py-2 bg-green-700 text-white rounded font-medium hover:bg-green-800"
        >
          Apply Again
        </button>
        <button
          v-else
          @click="handleNext"
          class="px-6 py-2 bg-green-700 text-white rounded font-medium hover:bg-green-800"
        >
          Next Step
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive, ref, computed } from 'vue';
import StudentStep1 from './student-steps/StudentStep1.vue';
import StudentStep2 from './student-steps/StudentStep2.vue';
import StudentStep3 from './student-steps/StudentStep3.vue';
import StudentStep4 from './student-steps/StudentStep4.vue';
import StudentStep5 from './student-steps/StudentStep5.vue';
import StudentStep6 from './student-steps/StudentStep6.vue';
import StudentStep7 from './student-steps/StudentStep7.vue';
import StudentStep8 from './student-steps/StudentStep8.vue';
import StudentStep9 from './student-steps/StudentStep9.vue';

// Define props
const props = defineProps({
  initialPincode: {
    type: String,
    default: ''
  }
});

// Initial form data with only required fields for first step
const initialData = {
  pincode: props.initialPincode || '',
  program: '',
  session: '',
  group: '',
  sNameEnglish: '',
  sNameBangla: '',
  gender: '',
  religion: '',
  bloodGroup: '',
  dob: '',
  sMobileNo: '',
  nid: '',
  imageFileSelected: false,
  sPicture: 'https://placehold.co/150x150',
  sPictureFile: null,
  imageMime: '',
  nationality: '',
  maritalStatus: '',
  hobby: '',
  extracurriculam: '',
  bitId: '',
  fName: '',
  fNid: '',
  fOccupation: '',
  fQualification: '',
  fMonthlyIncome: '',
  fMobileNo: '',
  mName: '',
  mNid: '',
  mOccupation: '',
  mQualification: '',
  mMonthlyIncome: '',
  mMobileNo: '',
  permanentAddressVil: '',
  permanentAddressPO: '',
  permanentAddressPS: '',
  permanentAddressDist: '',
  presentAddressVil: '',
  presentAddressPO: '',
  presentAddressPS: '',
  presentAddressDist: '',
  gRelation: '',
  gName: '',
  gNid: '',
  gMobileNo: '',
  gEmail: '',
  gAddress: '',
  refName: '',
  refNid: '',
  refRelation: '',
  refMobileNo: '',
  refEmail: '',
  refAddress: '',
  sscBoard: '',
  sscSession: '',
  sscRoll: '',
  sscReg: '',
  sscYear: '',
  gpa1: '',
  hscBoard: '',
  hscSession: '',
  hscRoll: '',
  hscReg: '',
  hscYear: '',
  gpa2: '',
  compulsory1: 'BENGALI [101-102]',
  compulsory2: 'ENGLISH [107-108]',
  compulsory3: 'ICT [275]',
  elective1: '',
  elective2: '',
  elective3: '',
  optional: '',
  agreed: false
};

// State
const formData = reactive({ ...initialData });
const currentStep = ref(0);
const formErrors = ref({});
const isSubmitting = ref(false);
const submitError = ref('');
const applicationSubmitted = ref(false);

// Steps configuration - 10 steps
const steps = [
  { title: 'Program, Group & Session', component: StudentStep1 },
  { title: 'Terms & Conditions', component: StudentStep2 },
  { title: 'Student Information', component: StudentStep3 },
  { title: 'Parent Information', component: StudentStep4 },
  { title: 'Address Information', component: StudentStep5 },
  { title: 'Guardian & Reference', component: StudentStep6 },
  { title: 'Academic Information', component: StudentStep7 },
  { title: 'Application Preview', component: StudentStep8 },
  { title: 'Final Review & Submission', component: StudentStep9 },
];

// Methods
const onChange = (key, value) => {
  if (key === 'resetForm' && value === true) {
    // Reset form data to initial state
    Object.assign(formData, { ...initialData });
    currentStep.value = 0; // Go back to first step
    applicationSubmitted.value = false; // Reset submission status
    return;
  }
  formData[key] = value;
};

const validate = () => {
  const errors = {};
  
  // Validation for first step (program, group, session)
  if (currentStep.value === 0) {
    if (!formData.program) errors.program = 'Required';
    if (!formData.group) errors.group = 'Required';
    if (!formData.session) errors.session = 'Required';
  }
  
  // Validation for second step (terms agreement)
  if (currentStep.value === 1) {
    if (!formData.agreed) errors.agreed = 'You must agree to the terms and conditions';
  }
  
  // Validation for third step (student information)
  if (currentStep.value === 2) {
    if (!formData.sNameEnglish) errors.sNameEnglish = 'Required';
    if (!formData.sNameBangla) errors.sNameBangla = 'Required';
    if (!formData.gender) errors.gender = 'Required';
    if (!formData.religion) errors.religion = 'Required';
    if (!formData.bloodGroup) errors.bloodGroup = 'Required';
    if (!formData.dob) errors.dob = 'Required';
    if (!formData.sMobileNo) errors.sMobileNo = 'Required';
    if (!formData.bitId) errors.bitId = 'Required';
    if (!formData.maritalStatus) errors.maritalStatus = 'Required';
    if (!formData.sPicture || formData.sPicture === 'https://placehold.co/150x150') errors.sPicture = 'Photo is required';
    
    // Validate mobile number format (11 digits)
    if (formData.sMobileNo && !/^[0-9]{11}$/.test(formData.sMobileNo)) {
      errors.sMobileNo = 'Mobile number must be 11 digits';
    }
  }
  
  // Validation for fourth step (parent information)
  if (currentStep.value === 3) {
    if (!formData.fName) errors.fName = 'Father name is required';
    if (!formData.mName) errors.mName = 'Mother name is required';
    if (!formData.fMobileNo) errors.fMobileNo = 'Father mobile is required';
    
    // Validate father's mobile number format (11 digits)
    if (formData.fMobileNo && !/^[0-9]{11}$/.test(formData.fMobileNo)) {
      errors.fMobileNo = 'Father mobile number must be 11 digits';
    }
    
    // Validate mother's mobile number format (11 digits) if provided
    if (formData.mMobileNo && !/^[0-9]{11}$/.test(formData.mMobileNo)) {
      errors.mMobileNo = 'Mother mobile number must be 11 digits';
    }
  }
  
  // Validation for fifth step (address information)
  if (currentStep.value === 4) {
    if (!formData.presentAddressVil) errors.presentAddressVil = 'Present address village is required';
    if (!formData.presentAddressPO) errors.presentAddressPO = 'Present address post office is required';
    if (!formData.presentAddressPS) errors.presentAddressPS = 'Present address police station is required';
    if (!formData.presentAddressDist) errors.presentAddressDist = 'Present address district is required';
    
    if (!formData.permanentAddressVil) errors.permanentAddressVil = 'Permanent address village is required';
    if (!formData.permanentAddressPO) errors.permanentAddressPO = 'Permanent address post office is required';
    if (!formData.permanentAddressPS) errors.permanentAddressPS = 'Permanent address police station is required';
    if (!formData.permanentAddressDist) errors.permanentAddressDist = 'Permanent address district is required';
  }
  
  // Validation for sixth step (guardian and reference information)
  if (currentStep.value === 5) {
    if (!formData.gName) errors.gName = 'Guardian name is required';
    if (!formData.gMobileNo) errors.gMobileNo = 'Guardian mobile is required';
    
    // Validate guardian mobile number format (11 digits)
    if (formData.gMobileNo && !/^[0-9]{11}$/.test(formData.gMobileNo)) {
      errors.gMobileNo = 'Guardian mobile number must be 11 digits';
    }
    
    // Validate reference mobile number format (11 digits) if provided
    if (formData.refMobileNo && !/^[0-9]{11}$/.test(formData.refMobileNo)) {
      errors.refMobileNo = 'Reference mobile number must be 11 digits';
    }
  }
  
  // Validation for seventh step (academic information)
  if (currentStep.value === 6) {
    if (!formData.sscBoard) errors.sscBoard = 'SSC board is required';
    if (!formData.sscYear) errors.sscYear = 'SSC passing year is required';
    
    // When hscStatus is 1 (for degree/honours), HSC details are required
    const isHSCStatusOpen = formData.program && (formData.program.toLowerCase().includes('degree') ||
                                    formData.program.toLowerCase().includes('honours'));
    
    if (isHSCStatusOpen) {
      if (!formData.hscBoard) errors.hscBoard = 'HSC board is required';
      if (!formData.hscYear) errors.hscYear = 'HSC passing year is required';
    }
    
    // Validate compulsory and elective subjects only if HSC details are not shown (i.e., for HSC programs)
    // Use the same isHSCStatusOpen variable defined earlier
    if (!isHSCStatusOpen) {
      if (!formData.compulsory1) errors.compulsory1 = 'Compulsory subject 1 is required';
      if (!formData.compulsory2) errors.compulsory2 = 'Compulsory subject 2 is required';
      if (!formData.compulsory3) errors.compulsory3 = 'Compulsory subject 3 is required';
      if (!formData.elective1) errors.elective1 = 'Elective subject 1 is required';
      
      // Validate other subjects based on the selected group
      if (formData.group) {
        if (formData.group === 'Science') {
          if (!formData.elective2) errors.elective2 = 'Elective subject 2 is required';
          if (!formData.elective3) errors.elective3 = 'Elective subject 3 is required';
          if (!formData.optional) errors.optional = 'Optional subject is required';
        } else if (formData.group === 'Business Studies') {
          if (!formData.elective2) errors.elective2 = 'Elective subject 2 is required';
          if (!formData.elective3) errors.elective3 = 'Elective subject 3 is required';
          if (!formData.optional) errors.optional = 'Optional subject is required';
        } else if (formData.group === 'Humanities') {
          if (!formData.elective2) errors.elective2 = 'Elective subject 2 is required';
          if (!formData.elective3) errors.elective3 = 'Elective subject 3 is required';
          if (!formData.optional) errors.optional = 'Optional subject is required';
        }
      }
    }
  }
  
  // Validation for eighth step (application preview) - no specific validation needed
  // Step 9 doesn't need validation as it just displays results
  
  formErrors.value = errors;
  return Object.keys(errors).length === 0;
};

const handleNext = () => {
  if (validate()) {
    // For Step 8 (index 7), the submit button should handle form submission
    // So we only increment step for other steps
    if (currentStep.value === 7) {
      // This should not happen as Step 8 has a submit button, not a next button
      // But if somehow user clicks next, we can go to Step 9
      if (currentStep.value < steps.length - 1) {
        currentStep.value++;
      }
    } else if (currentStep.value < steps.length - 1) {
      currentStep.value++;
    }
  }
};

const handlePrev = () => {
  if (currentStep.value > 0) {
    currentStep.value--;
  }
};

const handleReset = () => {
  // Reset formData to initial state
  Object.assign(formData, initialData);
  
  // Explicitly reset specific fields if Object.assign isn't enough (e.g. for deep objects if any, but initialData is mostly flat)
  formData.sPicture = 'https://placehold.co/150x150';
  formData.sPictureFile = null;
  formData.imageFileSelected = false;
  
  // Reset state
  currentStep.value = 0;
  isSubmitting.value = false;
  submitError.value = '';
  applicationSubmitted.value = false;
  formErrors.value = {};
  
  // Scroll to top
  window.scrollTo({ top: 0, behavior: 'smooth' });
};

const handleSubmit = async () => {
  isSubmitting.value = true;
  submitError.value = '';
  
  try {
    // Create form data object for submission
    const submitData = new FormData();
    
    // Add all form data to FormData object
    Object.keys(formData).forEach(key => {
      // Skip image file handling for now
      if (key !== 'imageFileSelected' && key !== 'imageMime' && key !== 'sPictureFile') {
        submitData.append(`formData[${key}]`, formData[key]);
      }
    });
    
    // If we have an image file to upload, add it to the FormData
    if (formData.sPictureFile) {
      submitData.append('sPicture', formData.sPictureFile);
    }
    
    const parts = window.location.pathname.split('/');
    const base = parts[1] ? `/${parts[1]}` : '';
    const apiBase = `${base}/api`;
    const response = await fetch(`${apiBase}/student-apply`, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
      },
      body: submitData
    });
    
    console.log('Response status:', response.status);
    
    let result;
    try {
        result = await response.json();
    } catch (e) {
        console.error('Failed to parse JSON response:', e);
        throw new Error(`Server returned status ${response.status}`);
    }
    
    if (response.ok && result?.id) {
      // Update form data with pincode and move to Step 9
      onChange('pincode', result.pincode);
      onChange('id', result.id); // Store ID for PDF download
      applicationSubmitted.value = true; // Mark application as submitted
      currentStep.value = 8; // Move to Step 9 (index 8)
    } else {
      const msg = result?.message || 'Submission failed';
      const detail = result?.error ? ` (${JSON.stringify(result.error)})` : '';
      submitError.value = `${msg}${detail}`;
    }
  } catch (error) {
    submitError.value = 'An error occurred during submission';
    console.error('Submission error:', error);
  } finally {
    isSubmitting.value = false;
  }
};
</script>
