<template>
  <div class="space-y-6">
    <!-- Current Role Info (if applicable, though usually this is "Joining as") -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">Recruitment Information</div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Institution Type</label>
          <select class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.institutionType" @change="e => onChange('institutionType', e.target.value)">
            <option value="">Select</option>
            <option value="School">School</option>
            <option value="College">College</option>
            <option value="School & College">School & College</option>
            <option value="Madrasah">Madrasah</option>
            <option value="Technical">Technical</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Subject (Recruitment)</label>
          <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.subject" @input="e => onChange('subject', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
          <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.department" @input="e => onChange('department', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Program</label>
          <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.program" @input="e => onChange('program', e.target.value)" />
        </div>
      </div>
    </div>

    <!-- Previous Experience -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">Previous Experience</div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Previous Institution</label>
          <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.previousInstitution" @input="e => onChange('previousInstitution', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
          <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.previousDesignation" @input="e => onChange('previousDesignation', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Join Date</label>
          <input type="date" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.previousJoinDate" @input="e => onChange('previousJoinDate', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Relieve Date</label>
          <input type="date" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.previousRelieveDate" @input="e => onChange('previousRelieveDate', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Experience Certificate (PDF)</label>
          <input type="file" accept="application/pdf" @change="e => handleFileChange(e, 'experienceCertificateScan')" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
          <p v-if="formData.experienceCertificateScan" class="text-xs text-green-600 mt-1">File selected</p>
        </div>
      </div>
    </div>

    <!-- MPO / Subject Teacher Info -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">MPO / Subject Info</div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">SSC Subject Teacher?</label>
          <select class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.sscSubjectTeacher" @change="e => onChange('sscSubjectTeacher', e.target.value)">
            <option value="">Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">SSC Joining Date</label>
          <input type="date" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.sscJoiningDate" @input="e => onChange('sscJoiningDate', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">HSC Subject Teacher?</label>
          <select class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.hscSubjectTeacher" @change="e => onChange('hscSubjectTeacher', e.target.value)">
            <option value="">Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">HSC Joining Date</label>
          <input type="date" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.hscJoiningDate" @input="e => onChange('hscJoiningDate', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Want to be Examiner (SSC)?</label>
          <select class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.sscWantToBe" @change="e => onChange('sscWantToBe', e.target.value)">
            <option value="">Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Want to be Examiner (HSC)?</label>
          <select class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.hscWantToBe" @change="e => onChange('hscWantToBe', e.target.value)">
            <option value="">Select</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
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

// Methods
const handleFileChange = (e, field) => {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onloadend = () => {
      props.onChange(field, reader.result);
    };
    reader.readAsDataURL(file);
  }
};
</script>