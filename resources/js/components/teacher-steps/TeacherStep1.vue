<template>
  <div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Teacher Name (English) <span class="text-red-500">*</span></label>
        <input 
          type="text" 
          class="w-full border rounded px-3 py-2"
          :class="formErrors.teacherName ? 'border-red-500' : 'border-gray-300'"
          :value="formData.teacherName"
          @input="e => onChange('teacherName', e.target.value)"
        />
        <p v-if="formErrors.teacherName" class="text-xs text-red-500 mt-1">{{ formErrors.teacherName }}</p>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Teacher Name (Bangla)</label>
        <input 
          type="text" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.teacherNameBangla"
          @input="e => onChange('teacherNameBangla', e.target.value)"
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
        <input 
          type="text" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.designation"
          @input="e => onChange('designation', e.target.value)"
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Index Number</label>
        <input 
          type="text" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.indexNo"
          @input="e => onChange('indexNo', e.target.value)"
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">EIN</label>
        <input 
          type="text" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.ein"
          @input="e => onChange('ein', e.target.value)"
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Mobile Number <span class="text-red-500">*</span></label>
        <input 
          type="text" 
          class="w-full border rounded px-3 py-2"
          :class="formErrors.mobile ? 'border-red-500' : 'border-gray-300'"
          :value="formData.mobile"
          @input="e => onChange('mobile', e.target.value)"
        />
        <p v-if="formErrors.mobile" class="text-xs text-red-500 mt-1">{{ formErrors.mobile }}</p>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <input 
          type="email" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.email"
          @input="e => onChange('email', e.target.value)"
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Appointment Type</label>
        <select 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.appointmentType"
          @change="e => onChange('appointmentType', e.target.value)"
        >
          <option value="">Select</option>
          <option value="Permanent">Permanent</option>
          <option value="Temporary">Temporary</option>
          <option value="Part-time">Part-time</option>
        </select>
      </div>
    </div>
  </div>
</template>

<script setup>
// Props
defineProps({
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
</script>