<template>
  <div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="md:col-span-2">
        <label class="block text-sm font-medium text-gray-700 mb-1">Present Address</label>
        <input 
          type="text" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.presentAddress"
          @input="e => onChange('presentAddress', e.target.value)"
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Upazila/Thana</label>
        <input 
          type="text" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.upazilaThana"
          @input="e => onChange('upazilaThana', e.target.value)"
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Zilla/Post Office</label>
        <input 
          type="text" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.zillaPostOffice"
          @input="e => onChange('zillaPostOffice', e.target.value)"
        />
      </div>
    </div>
    
    <div class="border-t pt-4 mt-4">
      <h3 class="text-md font-semibold mb-3">Documents</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Photo (Passport Size)</label>
          <div class="flex items-center space-x-4">
            <img :src="formData.photoPreview" alt="Preview" class="w-24 h-24 object-cover border rounded" />
            <input 
              type="file" 
              accept="image/*"
              @change="e => handleFileChange(e, 'photo')"
              class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
            />
          </div>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">NID Scan (PDF)</label>
          <input 
            type="file" 
            accept="application/pdf"
            @change="e => handleFileChange(e, 'nidScan')"
            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
          />
          <p v-if="formData.nidScan" class="text-xs text-green-600 mt-1">File selected</p>
        </div>
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

// Methods
const handleFileChange = (e, field) => {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onloadend = () => {
      props.onChange(field, reader.result);
      if (field === 'photo') {
        props.onChange('photoPreview', reader.result);
      }
    };
    reader.readAsDataURL(file);
  }
};
</script>