<template>
  <div class="space-y-6">
    <!-- Guardian Information -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">Guardian Information</div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Guardian Name <span class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border rounded px-3 py-2"
            :class="formErrors.gName ? 'border-red-500' : 'border-gray-300'"
            :value="formData.gName"
            @input="e => onChange('gName', e.target.value)"
          />
          <p v-if="formErrors.gName" class="text-xs text-red-500 mt-1">{{ formErrors.gName }}</p>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Guardian Mobile <span class="text-red-500">*</span></label>
          <input 
            type="tel" 
            class="w-full border rounded px-3 py-2"
            :class="formErrors.gMobileNo ? 'border-red-500' : 'border-gray-300'"
            :value="formData.gMobileNo"
            @input="handleGuardianMobileInput"
            placeholder="01XXXXXXXXX"
            maxlength="11"
          />
          <p v-if="formErrors.gMobileNo" class="text-xs text-red-500 mt-1">{{ formErrors.gMobileNo }}</p>
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Guardian Relation</label>
          <CustomSelect
            :model-value="formData.gRelation"
            :options="guardianRelationOptions"
            :placeholder="'Select Relation'"
            @update:modelValue="handleRelationSelect"
          />
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Guardian NID</label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.gNid"
            @input="e => handleNumericOnly('gNid', e)"
          />
        </div>
        
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700 mb-1">Guardian Address</label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.gAddress"
            @input="e => onChange('gAddress', e.target.value)"
          />
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Guardian Email</label>
          <input 
            type="email" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.gEmail"
            @input="e => onChange('gEmail', e.target.value)"
          />
        </div>
      </div>
    </div>

    <!-- Reference Information -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">Reference Information</div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Reference Name</label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.refName"
            @input="e => onChange('refName', e.target.value)"
          />
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Reference Mobile</label>
          <input 
            type="tel" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.refMobileNo"
            @input="handleReferenceMobileInput"
            placeholder="01XXXXXXXXX"
            maxlength="11"
          />
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Reference Relation</label>
          <CustomSelect
            :model-value="formData.refRelation"
            :options="referenceRelationOptions"
            :placeholder="'Select Relation'"
            @update:modelValue="v => onChange('refRelation', v)"
          />
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Reference NID</label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.refNid"
            @input="e => handleNumericOnly('refNid', e)"
          />
        </div>
        
        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700 mb-1">Reference Address</label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.refAddress"
            @input="e => onChange('refAddress', e.target.value)"
          />
        </div>
        
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Reference Email</label>
          <input 
            type="email" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.refEmail"
            @input="e => onChange('refEmail', e.target.value)"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import CustomSelect from '../common/CustomSelect.vue';
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

const guardianRelationOptions = ['Father','Mother','Brother','Sister','Uncle','Aunt','Grandfather','Grandmother'];
const referenceRelationOptions = ['Friend','Colleague','Neighbor','Relative','Other'];

// Method to handle guardian mobile number input (only 11 digits)
const handleGuardianMobileInput = (e) => {
  let value = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
  if (value.length > 11) {
    value = value.substring(0, 11);
  }
  props.onChange('gMobileNo', value);
};

// Method to handle reference mobile number input (only 11 digits)
const handleReferenceMobileInput = (e) => {
  let value = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
  if (value.length > 11) {
    value = value.substring(0, 11);
  }
  props.onChange('refMobileNo', value);
};

const handleRelationSelect = (relation) => {
  props.onChange('gRelation', relation);
  
  // Auto-fill guardian info if relation is Father
  if (relation === 'Father') {
    props.onChange('gName', props.formData.fName || '');
    props.onChange('gMobileNo', props.formData.fMobileNo || '');
    props.onChange('gNid', props.formData.fNid || '');
  } 
  // Auto-fill guardian info if relation is Mother
  else if (relation === 'Mother') {
    props.onChange('gName', props.formData.mName || '');
    props.onChange('gMobileNo', props.formData.mMobileNo || '');
    props.onChange('gNid', props.formData.mNid || '');
  }
  // Clear fields if relation is changed to something else
  else {
    // Only clear if the user explicitly changed from Father/Mother to another relation
    // This prevents clearing if the user just selected the relation for the first time
    if (props.formData.gRelation === 'Father' || props.formData.gRelation === 'Mother') {
      props.onChange('gName', props.formData.gName || '');
      props.onChange('gMobileNo', props.formData.gMobileNo || '');
      props.onChange('gNid', props.formData.gNid || '');
    }
  }
};

// Generic method for numeric only input
const handleNumericOnly = (field, e) => {
  const value = e.target.value.replace(/\D/g, ''); // Remove non-digit characters
  props.onChange(field, value);
};
</script>
