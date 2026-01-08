<template>
  <div class="space-y-6">
    <!-- Father Information -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">Father's Information</div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Father's Name <span class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border rounded px-3 py-2"
            :class="formErrors.fName ? 'border-red-500' : 'border-gray-300'"
            :value="formData.fName"
            @input="e => onChange('fName', e.target.value)"
          />
          <p v-if="formErrors.fName" class="text-xs text-red-500 mt-1">{{ formErrors.fName }}</p>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Father's Mobile <span class="text-red-500">*</span></label>
          <input 
            type="tel" 
            class="w-full border rounded px-3 py-2"
            :class="formErrors.fMobileNo ? 'border-red-500' : 'border-gray-300'"
            :value="formData.fMobileNo"
            @input="handleFatherMobileInput"
            placeholder="01XXXXXXXXX"
            maxlength="11"
          />
          <p v-if="formErrors.fMobileNo" class="text-xs text-red-500 mt-1">{{ formErrors.fMobileNo }}</p>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Father's Occupation</label>
          <select 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.fOccupation"
            @change="e => onChange('fOccupation', e.target.value)"
          >
            <option value="">Select Occupation</option>
            <option value="Engineer">Engineer</option>
            <option value="Doctor">Doctor</option>
            <option value="Banker">Banker</option>
            <option value="Advocate">Advocate</option>
            <option value="Farmer">Farmer</option>
            <option value="Teacher">Teacher</option>
            <option value="Professor">Professor</option>
            <option value="Businessman">Businessman</option>
            <option value="Entrepreneur">Entrepreneur</option>
            <option value="Government Employee">Government Employee</option>
            <option value="Private Job">Private Job</option>
            <option value="Accountant">Accountant</option>
            <option value="Shopkeeper">Shopkeeper</option>
            <option value="Police Officer">Police Officer</option>
            <option value="Army Personnel">Army Personnel</option>
            <option value="Navy Personnel">Navy Personnel</option>
            <option value="Air Force Personnel">Air Force Personnel</option>
            <option value="Driver">Driver</option>
            <option value="Electrician">Electrician</option>
            <option value="Plumber">Plumber</option>
            <option value="Mason">Mason</option>
            <option value="Tailor">Tailor</option>
            <option value="Carpenter">Carpenter</option>
            <option value="Painter">Painter</option>
            <option value="Day Laborer">Day Laborer</option>
            <option value="Fisherman">Fisherman</option>
            <option value="Mechanic">Mechanic</option>
            <option value="IT Professional">IT Professional</option>
            <option value="Software Engineer">Software Engineer</option>
            <option value="Unemployed">Unemployed</option>
            <option value="Retired">Retired</option>
            <option value="Other">Other</option>
          </select>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Father's Qualification</label>
          <select 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.fQualification"
            @change="e => onChange('fQualification', e.target.value)"
          >
            <option value="">Select Qualification</option>
            <option value="Completed up to Class 9">Completed up to Class 9</option>
            <option value="SSC">SSC</option>
            <option value="HSC">HSC</option>
            <option value="Bachelor">Bachelor</option>
            <option value="Masters">Masters</option>
            <option value="PhD">PhD</option>
          </select>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Father's NID</label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.fNid"
            @input="e => handleNumericOnly('fNid', e)"
          />
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Father's Monthly Income</label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.fMonthlyIncome"
            @input="e => onChange('fMonthlyIncome', e.target.value)"
            placeholder="BDT"
          />
        </div>
      </div>
    </div>

    <!-- Mother Information -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">Mother's Information</div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Mother's Name <span class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border rounded px-3 py-2"
            :class="formErrors.mName ? 'border-red-500' : 'border-gray-300'"
            :value="formData.mName"
            @input="e => onChange('mName', e.target.value)"
          />
          <p v-if="formErrors.mName" class="text-xs text-red-500 mt-1">{{ formErrors.mName }}</p>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Mother's Mobile</label>
          <input 
            type="tel" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.mMobileNo"
            @input="handleMotherMobileInput"
            placeholder="01XXXXXXXXX"
            maxlength="11"
          />
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Mother's Occupation</label>
          <select 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.mOccupation"
            @change="e => onChange('mOccupation', e.target.value)"
          >
            <option value="">Select Occupation</option>
            <option value="Engineer">Engineer</option>
            <option value="Doctor">Doctor</option>
            <option value="Banker">Banker</option>
            <option value="Advocate">Advocate</option>
            <option value="Farmer">Farmer</option>
            <option value="Teacher">Teacher</option>
            <option value="Professor">Professor</option>
            <option value="Businessman">Businessman</option>
            <option value="Entrepreneur">Entrepreneur</option>
            <option value="Government Employee">Government Employee</option>
            <option value="Private Job">Private Job</option>
            <option value="Accountant">Accountant</option>
            <option value="Shopkeeper">Shopkeeper</option>
            <option value="Police Officer">Police Officer</option>
            <option value="Army Personnel">Army Personnel</option>
            <option value="Navy Personnel">Navy Personnel</option>
            <option value="Air Force Personnel">Air Force Personnel</option>
            <option value="Driver">Driver</option>
            <option value="Electrician">Electrician</option>
            <option value="Plumber">Plumber</option>
            <option value="Mason">Mason</option>
            <option value="Tailor">Tailor</option>
            <option value="Carpenter">Carpenter</option>
            <option value="Painter">Painter</option>
            <option value="Day Laborer">Day Laborer</option>
            <option value="Fisherman">Fisherman</option>
            <option value="Mechanic">Mechanic</option>
            <option value="IT Professional">IT Professional</option>
            <option value="Software Engineer">Software Engineer</option>
            <option value="Unemployed">Unemployed</option>
            <option value="Retired">Retired</option>
            <option value="Housewife">Housewife</option>
            <option value="Other">Other</option>
          </select>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Mother's Qualification</label>
          <select 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.mQualification"
            @change="e => onChange('mQualification', e.target.value)"
          >
            <option value="">Select Qualification</option>
            <option value="Completed up to Class 9">Completed up to Class 9</option>
            <option value="SSC">SSC</option>
            <option value="HSC">HSC</option>
            <option value="Bachelor">Bachelor</option>
            <option value="Masters">Masters</option>
            <option value="PhD">PhD</option>
          </select>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Mother's NID</label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.mNid"
            @input="e => handleNumericOnly('mNid', e)"
          />
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Mother's Monthly Income</label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.mMonthlyIncome"
            @input="e => onChange('mMonthlyIncome', e.target.value)"
            placeholder="BDT"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
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

// Generic method for numeric only input
const handleNumericOnly = (field, e) => {
  const value = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
  e.target.value = value; // Force update input value in DOM
  props.onChange(field, value);
};

// Method to handle father's mobile number input (only 11 digits)
const handleFatherMobileInput = (e) => {
  let value = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
  if (value.length > 11) {
    value = value.substring(0, 11);
  }
  e.target.value = value; // Force update input value in DOM
  props.onChange('fMobileNo', value);
};

// Method to handle mother's mobile number input (only 11 digits)
const handleMotherMobileInput = (e) => {
  let value = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
  if (value.length > 11) {
    value = value.substring(0, 11);
  }
  e.target.value = value; // Force update input value in DOM
  props.onChange('mMobileNo', value);
};
</script>