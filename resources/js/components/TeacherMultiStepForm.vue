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
          v-if="currentStep === steps.length - 1"
          @click="handleSubmit"
          :disabled="isSubmitting"
          class="px-6 py-2 bg-green-700 text-white rounded font-medium hover:bg-green-800 disabled:opacity-50"
        >
          {{ isSubmitting ? 'Submitting...' : 'Submit Application' }}
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
import { reactive, ref } from 'vue';
import TeacherStep1 from './teacher-steps/TeacherStep1.vue';
import TeacherStep2 from './teacher-steps/TeacherStep2.vue';
import TeacherStep3 from './teacher-steps/TeacherStep3.vue';
import TeacherStep4 from './teacher-steps/TeacherStep4.vue';
import TeacherStep5 from './teacher-steps/TeacherStep5.vue';
import TeacherStep6 from './teacher-steps/TeacherStep6.vue';

// Initial data
const initialData = reactive({
  teacherName: '',
  teacherNameBangla: '',
  ein: '',
  designation: '',
  indexNo: '',
  mobile: '',
  email: '',
  fatherName: '',
  motherName: '',
  religion: '',
  bloodGroup: '',
  dob: '',
  nid: '',
  bankName: '',
  bankAccountNo: '',
  presentAddress: '',
  upazilaThana: '',
  zillaPostOffice: '',
  photo: null,
  photoPreview: 'https://placehold.co/150x150',
  nidScan: null,
  sscExamType: '', sscResult: '', sscYear: '', sscMarksheetScan: null, sscBoard: '', sscRegistrationNo: '',
  hscExamType: '', hscResult: '', hscYear: '', hscMarksheetScan: null, hsceBoard: '', hscRegistrationNo: '',
  graduationExamType: '', graduationSubject: '', graduationResult: '', graduationYear: '', graduationMarksheetScan: null,
  mastersExamType: '', mastersResult: '', mastersYear: '', mastersCertificateScan: null,
  bedResult: '', bedYear: '', bedCertificateScan: null,
  medResult: '', medYear: '', medCertificateScan: null,
  othersExam: '', othersExamResult: '', othersExamYear: '', othersExamDocument: null,
  institutionType: '',
  sscSubjectTeacher: '', sscJoiningDate: '',
  hscSubjectTeacher: '', hscJoiningDate: '',
  sscWantToBe: '', hscWantToBe: '',
  program: '', department: '', subject: '',
  previousInstitution: '', previousDesignation: '', previousJoinDate: '', previousRelieveDate: '',
  experienceCertificateScan: null,
  appointmentType: ''
});

// State
const formData = reactive({ ...initialData });
const currentStep = ref(0);
const formErrors = ref({});
const isSubmitting = ref(false);
const submitError = ref('');

// Steps configuration
const steps = [
  { title: 'Basic Info', component: TeacherStep1 },
  { title: 'Personal Details', component: TeacherStep2 },
  { title: 'Address & Photo', component: TeacherStep3 },
  { title: 'Education (SSC/HSC)', component: TeacherStep4 },
  { title: 'Higher Education', component: TeacherStep5 },
  { title: 'Experience', component: TeacherStep6 },
];

// Methods
const onChange = (key, value) => {
  formData[key] = value;
};

const validate = () => {
  const errors = {};
  // Basic validation logic - can be expanded
  if (currentStep.value === 0) {
    if (!formData.teacherName) errors.teacherName = 'Required';
    if (!formData.mobile) errors.mobile = 'Required';
  }
  formErrors.value = errors;
  return Object.keys(errors).length === 0;
};

const handleNext = () => {
  if (validate()) {
    currentStep.value = Math.min(currentStep.value + 1, steps.length - 1);
    window.scrollTo(0, 0);
  }
};

const handlePrev = () => {
  currentStep.value = Math.max(currentStep.value - 1, 0);
  window.scrollTo(0, 0);
};

const handleSubmit = async () => {
  if (!validate()) return;
  isSubmitting.value = true;
  submitError.value = '';
  try {
    // Convert files to base64 if they are File objects (handled in steps, assumed stored as dataURL or handled here)
    // Ideally steps should convert file to base64 string before storing in state for consistency with student form
    
    const response = await fetch('api/teacher-apply', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ formData })
    });
    const data = await response.json();
    if (!response.ok) throw new Error(data.message || 'Submission failed');
    
    // Redirect to preview (in a real app, this would be handled by Vue Router)
    // router.push(`/teacher/preview/${data.id}`);
    alert('Application submitted successfully!');
  } catch (err) {
    submitError.value = err.message;
  } finally {
    isSubmitting.value = false;
  }
};
</script>
