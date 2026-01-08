<template>
  <div class="space-y-6">
    <!-- SSC Section -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">SSC / Equivalent</div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Exam Type</label>
          <input 
            type="text" 
            placeholder="SSC/Dakhil/..."
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.sscExamType"
            @input="e => onChange('sscExamType', e.target.value)"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Board</label>
          <select 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.sscBoard"
            @change="e => onChange('sscBoard', e.target.value)"
          >
            <option value="">Select</option>
            <option v-for="board in educationalBoards" :key="board" :value="board">{{ board }}</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Passing Year</label>
          <select 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.sscYear"
            @change="e => onChange('sscYear', e.target.value)"
          >
            <option value="">Select</option>
            <option v-for="year in passingYears(1980)" :key="year" :value="year">{{ year }}</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Result (GPA/Div)</label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.sscResult"
            @input="e => onChange('sscResult', e.target.value)"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Registration No</label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.sscRegistrationNo"
            @input="e => onChange('sscRegistrationNo', e.target.value)"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Marksheet (PDF)</label>
          <input 
            type="file" 
            accept="application/pdf"
            @change="e => handleFileChange(e, 'sscMarksheetScan')"
            class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
          />
          <p v-if="formData.sscMarksheetScan" class="text-xs text-green-600 mt-1">File selected</p>
        </div>
      </div>
    </div>

    <!-- HSC Section -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">HSC / Equivalent</div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Exam Type</label>
          <input 
            type="text" 
            placeholder="HSC/Alim/..."
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.hscExamType"
            @input="e => onChange('hscExamType', e.target.value)"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Board</label>
          <select 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.hsceBoard"
            @change="e => onChange('hsceBoard', e.target.value)"
          >
            <option value="">Select</option>
            <option v-for="board in educationalBoards" :key="board" :value="board">{{ board }}</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Passing Year</label>
          <select 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.hscYear"
            @change="e => onChange('hscYear', e.target.value)"
          >
            <option value="">Select</option>
            <option v-for="year in passingYears(1980)" :key="year" :value="year">{{ year }}</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Result (GPA/Div)</label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.hscResult"
            @input="e => onChange('hscResult', e.target.value)"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Registration No</label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :value="formData.hscRegistrationNo"
            @input="e => onChange('hscRegistrationNo', e.target.value)"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Marksheet (PDF)</label>
          <input 
            type="file" 
            accept="application/pdf"
            @change="e => handleFileChange(e, 'hscMarksheetScan')"
            class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100"
          />
          <p v-if="formData.hscMarksheetScan" class="text-xs text-green-600 mt-1">File selected</p>
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

const educationalBoards = [
  "Dhaka", "Chittagong", "Rajshahi", "Sylhet", "Barisal", "Comilla", 
  "Dinajpur", "Jessore", "Bogra", "Mymensingh", "Khulna", "Rangpur", 
  "Madaripur", "Gazipur", "Narayanganj", "Gopalganj", "Shariatpur", 
  "Narsingdi", "Faridpur", "Tangail", "Kishoreganj", "Manikganj", 
  "Munshiganj", "Rajbari", "Pirojpur", "Bhola", "Jhalokati", 
  "Patuakhali", "Panchagarh", "Thakurgaon", "Dinajpur", "Rangpur", 
  "Kurigram", "Gaibandha", "Lalmonirhat", "Nilphamari", "Pabna", 
  "Bagerhat", "Chuadanga", "Jessore", "Jhenaidah", "Khulna", 
  "Kushtia", "Magura", "Meherpur", "Narail", "Satkhira"
];
</script>