<template>
  <div class="space-y-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Application Preview</h2>
    
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h3 class="text-lg font-semibold text-gray-700 mb-4">Personal Information</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <p class="text-sm text-gray-600">Student Name (English):</p>
          <p class="font-medium">{{ formData.sNameEnglish }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Student Name (Bangla):</p>
          <p class="font-medium">{{ formData.sNameBangla }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Gender:</p>
          <p class="font-medium">{{ formData.gender }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Religion:</p>
          <p class="font-medium">{{ formData.religion }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Blood Group:</p>
          <p class="font-medium">{{ formData.bloodGroup }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Date of Birth:</p>
          <p class="font-medium">{{ formData.dob }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Mobile Number:</p>
          <p class="font-medium">{{ formData.sMobileNo }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">BIT ID:</p>
          <p class="font-medium">{{ formData.bitId }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Marital Status:</p>
          <p class="font-medium">{{ formData.maritalStatus }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Picture:</p>
          <div class="flex items-center">
            <img 
              v-if="formData.sPicture" 
              :src="formData.sPicture" 
              alt="Student Photo" 
              class="w-16 h-16 object-cover border rounded mr-3"
            />
            <span class="font-medium">{{ formData.sPicture ? 'Uploaded' : 'Not provided' }}</span>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
      <h3 class="text-lg font-semibold text-gray-700 mb-4">Parent/Guardian Information</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <p class="text-sm text-gray-600">Father's Name:</p>
          <p class="font-medium">{{ formData.fName }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Father's Mobile:</p>
          <p class="font-medium">{{ formData.fMobileNo }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Mother's Name:</p>
          <p class="font-medium">{{ formData.mName }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Guardian's Name:</p>
          <p class="font-medium">{{ formData.gName }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Guardian's Mobile:</p>
          <p class="font-medium">{{ formData.gMobileNo }}</p>
        </div>
      </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
      <h3 class="text-lg font-semibold text-gray-700 mb-4">Addresses</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <h4 class="font-medium text-gray-700 mb-2">Present Address</h4>
          <p class="text-sm text-gray-600">Village:</p>
          <p class="font-medium mb-1">{{ formData.presentAddressVil }}</p>
          <p class="text-sm text-gray-600">Post Office:</p>
          <p class="font-medium mb-1">{{ formData.presentAddressPO }}</p>
          <p class="text-sm text-gray-600">Police Station:</p>
          <p class="font-medium mb-1">{{ formData.presentAddressPS }}</p>
          <p class="text-sm text-gray-600">District:</p>
          <p class="font-medium">{{ formData.presentAddressDist }}</p>
        </div>
        <div>
          <h4 class="font-medium text-gray-700 mb-2">Permanent Address</h4>
          <p class="text-sm text-gray-600">Village:</p>
          <p class="font-medium mb-1">{{ formData.permanentAddressVil }}</p>
          <p class="text-sm text-gray-600">Post Office:</p>
          <p class="font-medium mb-1">{{ formData.permanentAddressPO }}</p>
          <p class="text-sm text-gray-600">Police Station:</p>
          <p class="font-medium mb-1">{{ formData.permanentAddressPS }}</p>
          <p class="text-sm text-gray-600">District:</p>
          <p class="font-medium">{{ formData.permanentAddressDist }}</p>
        </div>
      </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
      <h3 class="text-lg font-semibold text-gray-700 mb-4">Academic Information</h3>
      <div class="mb-4">
        <p class="text-sm text-gray-600">Program:</p>
        <p class="font-medium">{{ formData.program }}</p>
      </div>
      <div class="mb-4" v-if="formData.group">
        <p class="text-sm text-gray-600">Group:</p>
        <p class="font-medium">{{ formData.group }}</p>
      </div>
      <div class="mb-4" v-if="formData.session">
        <p class="text-sm text-gray-600">Session:</p>
        <p class="font-medium">{{ formData.session }}</p>
      </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
      <h3 class="text-lg font-semibold text-gray-700 mb-4">SSC / Equivalent Information</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <p class="text-sm text-gray-600">Board:</p>
          <p class="font-medium">{{ formData.sscBoard }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Passing Year:</p>
          <p class="font-medium">{{ formData.sscYear }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Session:</p>
          <p class="font-medium">{{ formData.sscSession }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Roll No:</p>
          <p class="font-medium">{{ formData.sscRoll }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Registration No:</p>
          <p class="font-medium">{{ formData.sscReg }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">GPA:</p>
          <p class="font-medium">{{ formData.gpa1 }}</p>
        </div>
      </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md" v-if="isHSCStatusOpen">
      <h3 class="text-lg font-semibold text-gray-700 mb-4">HSC / Equivalent Information</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <p class="text-sm text-gray-600">Board:</p>
          <p class="font-medium">{{ formData.hscBoard }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Passing Year:</p>
          <p class="font-medium">{{ formData.hscYear }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Session:</p>
          <p class="font-medium">{{ formData.hscSession }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Roll No:</p>
          <p class="font-medium">{{ formData.hscRoll }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Registration No:</p>
          <p class="font-medium">{{ formData.hscReg }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">GPA:</p>
          <p class="font-medium">{{ formData.gpa2 }}</p>
        </div>
      </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md" v-if="!isHSCStatusOpen">
      <h3 class="text-lg font-semibold text-gray-700 mb-4">Subject Selection</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <p class="text-sm text-gray-600">Compulsory Subject 1:</p>
          <p class="font-medium">{{ formData.compulsory1 }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Compulsory Subject 2:</p>
          <p class="font-medium">{{ formData.compulsory2 }}</p>
        </div>
        <div>
          <p class="text-sm text-gray-600">Compulsory Subject 3:</p>
          <p class="font-medium">{{ formData.compulsory3 }}</p>
        </div>
        <div v-if="formData.elective1">
          <p class="text-sm text-gray-600">Elective Subject 1:</p>
          <p class="font-medium">{{ formData.elective1 }}</p>
        </div>
        <div v-if="formData.elective2">
          <p class="text-sm text-gray-600">Elective Subject 2:</p>
          <p class="font-medium">{{ formData.elective2 }}</p>
        </div>
        <div v-if="formData.elective3">
          <p class="text-sm text-gray-600">Elective Subject 3:</p>
          <p class="font-medium">{{ formData.elective3 }}</p>
        </div>
        <div v-if="formData.optional">
          <p class="text-sm text-gray-600">Optional Subject:</p>
          <p class="font-medium">{{ formData.optional }}</p>
        </div>
      </div>
    </div>
    
    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mt-4">
      <p class="text-sm text-yellow-700">
        <strong>Note:</strong> Please review all information carefully. Once submitted, you will not be able to make changes.
      </p>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  formData: {
    type: Object,
    required: true
  },
  formErrors: {
    type: Object,
    required: true
  },
  onChange: {
    type: Function,
    required: true
  },
  stepNumber: {
    type: Number,
    required: true
  }
});

// Computed property to determine if the selected program requires HSC information
const isHSCStatusOpen = computed(() => {
  // According to API data: HSC has hscStatus=0, Degree/Honours have hscStatus=1
  // When hscStatus is 1, HSC details should be shown
  // When hscStatus is 0, HSC details should be hidden
  return props.formData.program && (props.formData.program.toLowerCase().includes('degree') ||props.formData.program.toLowerCase().includes('honours'));
});
</script>