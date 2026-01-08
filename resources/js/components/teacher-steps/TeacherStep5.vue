<template>
  <div class="space-y-6">
    <!-- Graduation Section -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">Graduation (Honours/Pass)</div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Exam Type</label>
          <input type="text" placeholder="Honours/Degree..." class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.graduationExamType" @input="e => onChange('graduationExamType', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
          <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.graduationSubject" @input="e => onChange('graduationSubject', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Result</label>
          <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.graduationResult" @input="e => onChange('graduationResult', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Passing Year</label>
          <select class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.graduationYear" @change="e => onChange('graduationYear', e.target.value)">
            <option value="">Select</option>
            <option v-for="year in passingYears(1980)" :key="year" :value="year">{{ year }}</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Marksheet (PDF)</label>
          <input type="file" accept="application/pdf" @change="e => handleFileChange(e, 'graduationMarksheetScan')" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
          <p v-if="formData.graduationMarksheetScan" class="text-xs text-green-600 mt-1">File selected</p>
        </div>
      </div>
    </div>

    <!-- Masters Section -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">Masters</div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Exam Type</label>
          <input type="text" placeholder="Masters..." class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.mastersExamType" @input="e => onChange('mastersExamType', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Result</label>
          <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.mastersResult" @input="e => onChange('mastersResult', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Passing Year</label>
          <select class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.mastersYear" @change="e => onChange('mastersYear', e.target.value)">
            <option value="">Select</option>
            <option v-for="year in passingYears(1980)" :key="year" :value="year">{{ year }}</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Certificate (PDF)</label>
          <input type="file" accept="application/pdf" @change="e => handleFileChange(e, 'mastersCertificateScan')" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
          <p v-if="formData.mastersCertificateScan" class="text-xs text-green-600 mt-1">File selected</p>
        </div>
      </div>
    </div>

    <!-- Professional Section (BEd/MEd/Others) -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">Professional / Others</div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">B.Ed Result</label>
          <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.bedResult" @input="e => onChange('bedResult', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">B.Ed Year</label>
          <select class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.bedYear" @change="e => onChange('bedYear', e.target.value)">
            <option value="">Select</option>
            <option v-for="year in passingYears(1980)" :key="year" :value="year">{{ year }}</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">B.Ed Certificate (PDF)</label>
          <input type="file" accept="application/pdf" @change="e => handleFileChange(e, 'bedCertificateScan')" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
          <p v-if="formData.bedCertificateScan" class="text-xs text-green-600 mt-1">File selected</p>
        </div>

        <div class="col-span-1 md:col-span-2 border-t my-2"></div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">M.Ed Result</label>
          <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.medResult" @input="e => onChange('medResult', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">M.Ed Year</label>
          <select class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.medYear" @change="e => onChange('medYear', e.target.value)">
            <option value="">Select</option>
            <option v-for="year in passingYears(1980)" :key="year" :value="year">{{ year }}</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">M.Ed Certificate (PDF)</label>
          <input type="file" accept="application/pdf" @change="e => handleFileChange(e, 'medCertificateScan')" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
          <p v-if="formData.medCertificateScan" class="text-xs text-green-600 mt-1">File selected</p>
        </div>

        <div class="col-span-1 md:col-span-2 border-t my-2"></div>

        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Others Exam Name</label>
          <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.othersExam" @input="e => onChange('othersExam', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Others Exam Result</label>
          <input type="text" class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.othersExamResult" @input="e => onChange('othersExamResult', e.target.value)" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Others Exam Year</label>
          <select class="w-full border border-gray-300 rounded px-3 py-2" :value="formData.othersExamYear" @change="e => onChange('othersExamYear', e.target.value)">
            <option value="">Select</option>
            <option v-for="year in passingYears(1980)" :key="year" :value="year">{{ year }}</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Others Doc (PDF)</label>
          <input type="file" accept="application/pdf" @change="e => handleFileChange(e, 'othersExamDocument')" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
          <p v-if="formData.othersExamDocument" class="text-xs text-green-600 mt-1">File selected</p>
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

// Utility functions
const passingYears = (startYear) => {
  const currentYear = new Date().getFullYear();
  const years = [];
  for (let year = currentYear; year >= startYear; year--) {
    years.push(year);
  }
  return years;
};
</script>