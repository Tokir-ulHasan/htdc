<template>
  <div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Student Name (English) <span class="text-red-500">*</span></label>
        <input 
          type="text" 
          class="w-full border rounded px-3 py-2"
          :class="formErrors.sNameEnglish ? 'border-red-500' : 'border-gray-300'"
          :value="formData.sNameEnglish"
          @input="e => onChange('sNameEnglish', e.target.value)"
        />
        <p v-if="formErrors.sNameEnglish" class="text-xs text-red-500 mt-1">{{ formErrors.sNameEnglish }}</p>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Student Name (Bangla) <span class="text-red-500">*</span></label>
        <input 
          type="text" 
          class="w-full border rounded px-3 py-2 font-bangla"
          :class="formErrors.sNameBangla ? 'border-red-500' : 'border-gray-300'"
          :value="formData.sNameBangla"
          @input="handleBanglaInput"
          @keypress="validateBanglaInput"
          placeholder="বাংলায় নাম লিখুন"
        />
        <p v-if="formErrors.sNameBangla" class="text-xs text-red-500 mt-1">{{ formErrors.sNameBangla }}</p>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Gender <span class="text-red-500">*</span></label>
        <select 
          class="w-full border rounded px-3 py-2"
          :class="formErrors.gender ? 'border-red-500' : 'border-gray-300'"
          :value="formData.gender"
          @change="e => onChange('gender', e.target.value)"
        >
          <option value="">Select Gender</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        <p v-if="formErrors.gender" class="text-xs text-red-500 mt-1">{{ formErrors.gender }}</p>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Religion <span class="text-red-500">*</span></label>
        <select 
          class="w-full border rounded px-3 py-2"
          :class="formErrors.religion ? 'border-red-500' : 'border-gray-300'"
          :value="formData.religion"
          @change="e => onChange('religion', e.target.value)"
        >
          <option value="">Select Religion</option>
          <option value="Islam">Islam</option>
          <option value="Hinduism">Hinduism</option>
          <option value="Christianity">Christianity</option>
          <option value="Buddhism">Buddhism</option>
        </select>
        <p v-if="formErrors.religion" class="text-xs text-red-500 mt-1">{{ formErrors.religion }}</p>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Blood Group <span class="text-red-500">*</span></label>
        <select 
          class="w-full border rounded px-3 py-2"
          :class="formErrors.bloodGroup ? 'border-red-500' : 'border-gray-300'"
          :value="formData.bloodGroup"
          @change="e => onChange('bloodGroup', e.target.value)"
        >
          <option value="">Select Blood Group</option>
          <option value="A+">A+</option>
          <option value="A-">A-</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="AB+">AB+</option>
          <option value="AB-">AB-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>
        </select>
        <p v-if="formErrors.bloodGroup" class="text-xs text-red-500 mt-1">{{ formErrors.bloodGroup }}</p>
      </div>

         <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nationality</label>
        <select 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.nationality || 'Bangladeshi'"
          @change="e => onChange('nationality', e.target.value)"
        >
          <option value="Bangladeshi">Bangladeshi</option>
        </select>
      </div>
      
         <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Marital Status <span class="text-red-500">*</span></label>
        <select 
          class="w-full border rounded px-3 py-2"
          :class="formErrors.maritalStatus ? 'border-red-500' : 'border-gray-300'"
          :value="formData.maritalStatus"
          @change="e => onChange('maritalStatus', e.target.value)"
        >
          <option value="">Select Marital Status</option>
          <option value="Single">Single</option>
          <option value="Married">Married</option>
          <option value="Divorced">Divorced</option>
          <option value="Widowed">Widowed</option>
        </select>
        <p v-if="formErrors.maritalStatus" class="text-xs text-red-500 mt-1">{{ formErrors.maritalStatus }}</p>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth <span class="text-red-500">*</span></label>
        <input 
          type="date" 
          class="w-full border rounded px-3 py-2"
          :class="formErrors.dob ? 'border-red-500' : 'border-gray-300'"
          :value="formData.dob"
          @change="e => onChange('dob', e.target.value)"
        />
        <p v-if="formErrors.dob" class="text-xs text-red-500 mt-1">{{ formErrors.dob }}</p>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Mobile Number <span class="text-red-500">*</span></label>
        <input 
          type="tel" 
          class="w-full border rounded px-3 py-2"
          :class="formErrors.sMobileNo ? 'border-red-500' : 'border-gray-300'"
          :value="formData.sMobileNo"
          @input="handleMobileInput"
          placeholder="01XXXXXXXXX"
          maxlength="11"
        />
        <p v-if="formErrors.sMobileNo" class="text-xs text-red-500 mt-1">{{ formErrors.sMobileNo }}</p>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Birth ID <span class="text-red-500">*</span></label>
        <input 
          type="text" 
          class="w-full border rounded px-3 py-2"
          :class="formErrors.bitId ? 'border-red-500' : 'border-gray-300'"
          :value="formData.bitId"
          @input="handleNumericOnly('bitId', $event)"
          placeholder="Enter numeric Birth ID"
        />
        <p v-if="formErrors.bitId" class="text-xs text-red-500 mt-1">{{ formErrors.bitId }}</p>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">NID</label>
        <input 
          type="text" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.nid"
          @input="handleNumericOnly('nid', $event)"
          placeholder="Enter numeric NID"
        />
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Hobby</label>
        <input 
          type="text" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.hobby"
          @input="e => onChange('hobby', e.target.value)"
        />
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Extracurricular Activities</label>
        <input 
          type="text" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.extracurriculam"
          @input="e => onChange('extracurriculam', e.target.value)"
        />
      </div>
    </div>
    
    <!-- Student Photo Upload -->
    <div class="border p-4 rounded relative mt-4">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">Student Photo <span class="text-red-500">*</span></div>
      <div class="mt-2">
        <div class="flex items-center space-x-4">
          <div class="flex-shrink-0">
            <img 
              :src="formData.sPicture || '/images/terms/default-avatar.png'" 
              alt="Student Photo Preview" 
              class="w-24 h-24 object-cover border rounded"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Upload Student Photo</label>
            <input 
              type="file" 
              accept="image/*"
              @change="handleImageUpload"
              class="block w-full text-sm text-slate-500 file:mr-2 file:py-1.5 file:px-2.5 file:rounded file:border-0 file:text-xs file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
            />
            <p class="text-xs text-gray-500 mt-1">Upload a recent passport-size photo (JPG/PNG)</p>
          </div>
        </div>
        <p v-if="formErrors.sPicture" class="text-xs text-red-500 mt-1">{{ formErrors.sPicture }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

// Props
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

// Method to handle mobile number input (only 11 digits)
const handleMobileInput = (e) => {
  let value = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
  if (value.length > 11) {
    value = value.substring(0, 11);
  }
  e.target.value = value; // Force update input value in DOM
  props.onChange('sMobileNo', value);
};

// Generic method for numeric only input
const handleNumericOnly = (field, e) => {
  const value = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
  e.target.value = value; // Force update input value in DOM
  props.onChange(field, value);
};

// Method to handle Bangla input
const handleBanglaInput = (e) => {
  const value = e.target.value;
  // Allow only Bangla characters, spaces, and common punctuation
  const banglaRegex = /^[ঀ-৿\s\u09CD\u09CE\u09BC\u09BD\u09BE\u09BF\u09C0\u09C1\u09C2\u09C3\u09C4\u09C7\u09C8\u09CB\u09CC\u09CD\u09D7\u09E0\u09E1\u09E2\u09E3\u09E6\u09EF\u09F0\u09F1\u09F2\u09F3\u09F4\u09F5\u09F6\u09F7\u09F8\u09F9\u09FA\u09FB\u09FC\u09FD\u09FE\u09FF]*$/;
  
  if (banglaRegex.test(value)) {
    props.onChange('sNameBangla', value);
  }
};

// Method to validate Bangla input on keypress
const validateBanglaInput = (e) => {
  const char = String.fromCharCode(e.which);
  // Allow only Bangla characters, spaces, and common punctuation
  const banglaRegex = /[ঀ-৿\s\u09CD\u09CE\u09BC\u09BD\u09BE\u09BF\u09C0\u09C1\u09C2\u09C3\u09C4\u09C7\u09C8\u09CB\u09CC\u09CD\u09D7\u09E0\u09E1\u09E2\u09E3\u09E6\u09EF\u09F0\u09F1\u09F2\u09F3\u09F4\u09F5\u09F6\u09F7\u09F8\u09F9\u09FA\u09FB\u09FC\u09FD\u09FE\u09FF]/;
  
  if (!banglaRegex.test(char) && e.which !== 8 && e.which !== 0 && e.which !== 9 && e.which !== 13) {
    e.preventDefault();
  }
};

// Method to handle image upload
const handleImageUpload = (e) => {
  const file = e.target.files[0];
  if (file) {
    // Validate file type
    if (!file.type.match('image.*')) {
      alert('Please select an image file (JPG/PNG)');
      return;
    }
    
    // Validate file size (limit to 2MB)
    if (file.size > 2 * 1024 * 1024) {
      alert('File size should be less than 2MB');
      return;
    }
    
    const reader = new FileReader();
    reader.onloadend = () => {
      props.onChange('sPicture', reader.result);
      props.onChange('sPictureFile', file); // Store the actual file object
      props.onChange('imageMime', file.type);
      props.onChange('imageFileSelected', true);
    };
    reader.readAsDataURL(file);
  }
};
</script>