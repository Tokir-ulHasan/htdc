<template>
  <div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Father's Name</label>
        <input 
          type="text" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.fatherName"
          @input="e => onChange('fatherName', e.target.value)"
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Mother's Name</label>
        <input 
          type="text" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.motherName"
          @input="e => onChange('motherName', e.target.value)"
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Religion</label>
        <select 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.religion"
          @change="e => onChange('religion', e.target.value)"
        >
          <option value="">Select</option>
          <option value="Islam">Islam</option>
          <option value="Hinduism">Hinduism</option>
          <option value="Christianity">Christianity</option>
          <option value="Buddhism">Buddhism</option>
          <option value="Others">Others</option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Blood Group</label>
        <select 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.bloodGroup"
          @change="e => onChange('bloodGroup', e.target.value)"
        >
          <option value="">Select</option>
          <option value="A+">A+</option>
          <option value="A-">A-</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="AB+">AB+</option>
          <option value="AB-">AB-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>
        </select>
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
        <input 
          type="date" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.dob"
          @input="e => onChange('dob', e.target.value)"
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">National ID (NID)</label>
        <input 
          type="number" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.nid"
          @input="e => onChange('nid', e.target.value)"
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Bank Name</label>
        <input 
          type="text" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.bankName"
          @input="e => onChange('bankName', e.target.value)"
        />
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Bank Account No</label>
        <input 
          type="number" 
          class="w-full border border-gray-300 rounded px-3 py-2"
          :value="formData.bankAccountNo"
          @input="e => onChange('bankAccountNo', e.target.value)"
        />
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