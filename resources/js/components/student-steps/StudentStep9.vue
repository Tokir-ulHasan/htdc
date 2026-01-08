<template>
  <div class="flex flex-col items-center w-full overflow-x-auto">
    <div v-if="loading" class="text-center py-8">
      <p class="text-gray-600">Loading application data...</p>
    </div>
    
    <div v-else-if="error" class="text-center py-8">
      <p class="text-red-600">{{ error }}</p>
    </div>

    <div v-else-if="applicationData" class="w-full flex flex-col items-center">
      <!-- PDF Content Area -->
      <div ref="contentRef" class="bg-white shadow-sm min-w-[784px]" style="width: 784px;">
        <div class="px-0 pt-0">
          <div :class="`pb-3 ${colorClass.bg}`">
            <!-- Header -->
            <div class="flex items-center justify-between pt-1 pb-2 px-1">
              <img :src="computePublicUrl('images/logo.svg')" alt="logo" class="w-28 h-32" />
              <div class="text-center">
                <h1 class="text-3xl font-bold">HAZERA-TAJU DEGREE COLLEGE</h1>
                <p class="text-sm">B Sc chattar, Chandgaon, Chattogram</p>
                <p class="text-sm">Application Form for {{ applicationData.program }} Admission</p>
                <p class="text-2xl font-bold">{{ applicationData.group }} Group</p>
                <p class="text-base font-bold mb-1">Session: {{ applicationData.session }}</p>
              </div>
              <img v-if="applicationData.sPicture" :src="computePublicUrl(applicationData.sPicture)" alt="student photo" class="w-28 h-36 object-cover" />
              <div v-else class="w-28 h-36 bg-gray-200 border border-gray-400 flex items-center justify-center text-xs text-gray-500">No Photo</div>
            </div>

            <!-- Info Bar -->
            <div class="grid grid-cols-3 gap-2 border-t-2 border-gray-50 px-1 text-base font-medium mb-1 py-[5px] h-[30px]">
              <div class="ml-1 font-bold">PIN CODE: <strong>{{ computedPin }}</strong></div>
              <div class="flex">
                <div class="pb-3">Admission Date: </div>
                <div class="bg-white w-[120px] h-full ml-2"></div>
              </div>
              <div class="flex">
                <div class="pb-3">Class Roll:</div>
                <div class="bg-white w-[120px] h-full ml-2"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="px-1 relative">
          <!-- Watermark -->
          <div class="absolute inset-0 flex items-center justify-center opacity-10 pointer-events-none z-0">
            <img :src="computePublicUrl('images/logo.svg')" alt="watermark" class="w-3/4 h-auto object-contain" />
          </div>

          <div class="relative z-10 pb-8">
            <!-- 1. Student Information -->
            <div class="relative mt-5">
              <div :class="`pb-2 absolute top-[-12px] left-4 bg-gray-50 border ${colorClass.border} px-2`">1. Student Information</div>
              <div :class="`border ${colorClass.border} p-4 pt-6`">
                <p class="mt-2 mb-4 mx-1 text-justify leading-loose">
                  <span>Student Name (in English) : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.sNameEnglish || '' }}</span>&nbsp;&nbsp;
                  <span>Student Name (in Bangla) : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.sNameBangla || '' }}</span>&nbsp;&nbsp;
                  <span>Blood Group : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[50px]`">{{ applicationData.bloodGroup || '' }}</span>&nbsp;&nbsp;
                  <span>Religion : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[80px]`">{{ applicationData.religion || '' }}</span>&nbsp;&nbsp;
                  <span>Gender : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[60px]`">{{ applicationData.gender || '' }}</span>&nbsp;&nbsp;
                  <span>Date of Birth : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.dob || '' }}</span>&nbsp;&nbsp;
                  <span>Birth Registration No : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[150px]`">{{ applicationData.bitId || '' }}</span>&nbsp;&nbsp;
                  <span>NID No : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[150px]`">{{ applicationData.nid || '' }}</span>&nbsp;&nbsp;
                  <span>Nationality : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.nationality || '' }}</span>&nbsp;&nbsp;
                  <span>Marital Status : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[80px]`">{{ applicationData.maritalStatus || '' }}</span>&nbsp;&nbsp;
                  <span>Mobile No : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[120px]`">{{ applicationData.sMobileNo || '' }}</span>
                </p>
              </div>
            </div>

            <!-- 2. Parents Information -->
            <div class="relative mt-6">
              <div :class="`pb-2 absolute top-[-12px] left-4 bg-gray-50 border ${colorClass.border} px-2`">2. Parents Information</div>
              <div :class="`border ${colorClass.border} p-4 pt-6`">
                <p class="mt-2 mb-4 mx-1 text-justify leading-loose">
                  <span>Father's Name : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[150px]`">{{ applicationData.fName || '' }}</span>&nbsp;&nbsp;
                  <span>Qualification : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.fQualification || '' }}</span>&nbsp;&nbsp;
                  <span>Occupation : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.fOccupation || '' }}</span>&nbsp;&nbsp;
                  <br/>
                  <span>Mother's Name : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[150px]`">{{ applicationData.mName || '' }}</span>&nbsp;&nbsp;
                  <span>Qualification : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.mQualification || '' }}</span>&nbsp;&nbsp;
                  <span>Occupation : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.mOccupation || '' }}</span>
                </p>
              </div>
            </div>

            <!-- 3. Present Address Information -->
            <div class="relative mt-6">
              <div :class="`pb-2 absolute top-[-12px] left-4 bg-gray-50 border ${colorClass.border} px-2`">3. Present Address Information</div>
              <div :class="`border ${colorClass.border} p-4 pt-6`">
                <p class="mt-2 mb-4 mx-1 text-justify leading-loose">
                  <span>Village : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[120px]`">{{ applicationData.presentAddressVil || '' }}</span>&nbsp;&nbsp;
                  <span>Post Office : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[120px]`">{{ applicationData.presentAddressPO || '' }}</span>&nbsp;&nbsp;
                  <span>Police Station : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[120px]`">{{ applicationData.presentAddressPS || '' }}</span>&nbsp;&nbsp;
                  <span>District : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[120px]`">{{ applicationData.presentAddressDist || '' }}</span>
                </p>
              </div>
            </div>

            <!-- 4. Permanent Address Information -->
            <div class="relative mt-6">
              <div :class="`pb-2 absolute top-[-12px] left-4 bg-gray-50 border ${colorClass.border} px-2`">4. Permanent Address Information</div>
              <div :class="`border ${colorClass.border} p-4 pt-6`">
                <p class="mt-2 mb-4 mx-1 text-justify leading-loose">
                  <span>Village : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[120px]`">{{ applicationData.permanentAddressVil || '' }}</span>&nbsp;&nbsp;
                  <span>Post Office : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[120px]`">{{ applicationData.permanentAddressPO || '' }}</span>&nbsp;&nbsp;
                  <span>Police Station : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[120px]`">{{ applicationData.permanentAddressPS || '' }}</span>&nbsp;&nbsp;
                  <span>District : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[120px]`">{{ applicationData.permanentAddressDist || '' }}</span>
                </p>
              </div>
            </div>

            <!-- 5. Guardian Information -->
            <div class="relative mt-6">
              <div :class="`pb-2 absolute top-[-12px] left-4 bg-gray-50 border ${colorClass.border} px-2`">5. Guardian Information</div>
              <div :class="`border ${colorClass.border} p-4 pt-6`">
                <p class="mt-2 mb-4 mx-1 text-justify leading-loose">
                  <span>Guardian Name : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[150px]`">{{ applicationData.gName || '' }}</span>&nbsp;&nbsp;
                  <span>Relation : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.gRelation || '' }}</span>&nbsp;&nbsp;
                  <span>Mobile : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[120px]`">{{ applicationData.gMobileNo || '' }}</span>
                </p>
              </div>
            </div>

            <!-- 6. Educational Information -->
            <div class="relative mt-6">
              <div :class="`pb-2 absolute top-[-12px] left-4 bg-gray-50 border ${colorClass.border} px-2`">6. Educational Information</div>
              <div :class="`border ${colorClass.border} p-4 pt-6`">
                <p class="mt-2 mb-4 mx-1 text-justify leading-loose">
                  <span>SSC Board : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.Board1 || '' }}</span>&nbsp;&nbsp;
                  <span>SSC Session : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.sessionExam1 || '' }}</span>&nbsp;&nbsp;
                  <span>SSC Roll : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.rollNo1 || '' }}</span>&nbsp;&nbsp;
                  <span>SSC Reg : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.regNo1 || '' }}</span>&nbsp;&nbsp;
                  <span>SSC Passing Year : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[80px]`">{{ applicationData.passingYear1 || '' }}</span>&nbsp;&nbsp;
                  <span>SSC GPA : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[50px]`">{{ applicationData.gpa1 || '' }}</span>
                  <br v-if="applicationData.program !== 'HSC'"/>
                  <template v-if="applicationData.program !== 'HSC'">
                    <span class="mt-2 inline-block">HSC Board : </span>
                    <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.Board2 || '' }}</span>&nbsp;&nbsp;
                    <span>HSC Session : </span>
                    <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.sessionExam2 || '' }}</span>&nbsp;&nbsp;
                    <span>HSC Roll : </span>
                    <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.rollNo2 || '' }}</span>&nbsp;&nbsp;
                    <span>HSC Reg : </span>
                    <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[100px]`">{{ applicationData.regNo2 || '' }}</span>&nbsp;&nbsp;
                    <span>HSC Passing Year : </span>
                    <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[80px]`">{{ applicationData.passingYear2 || '' }}</span>&nbsp;&nbsp;
                    <span>HSC GPA : </span>
                    <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[50px]`">{{ applicationData.gpa2 || '' }}</span>
                  </template>
                </p>
              </div>
            </div>

            <!-- 7. Subject Selection (Only for HSC) -->
            <div v-if="applicationData.program === 'HSC'" class="relative mt-6">
              <div :class="`pb-2 absolute top-[-12px] left-4 bg-gray-50 border ${colorClass.border} px-2`">7. Subject Selection</div>
              <div :class="`border ${colorClass.border} p-4 pt-6`">
                <p class="mt-2 mb-4 mx-1 text-justify leading-loose">
                  <span>Compulsory 1 : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[150px]`">{{ applicationData.compulsory1 || '' }}</span>&nbsp;&nbsp;
                  <span>Compulsory 2 : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[150px]`">{{ applicationData.compulsory2 || '' }}</span>&nbsp;&nbsp;
                  <span>Compulsory 3 : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[150px]`">{{ applicationData.compulsory3 || '' }}</span>&nbsp;&nbsp;
                  <span>Elective 1 : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[150px]`">{{ applicationData.elective1 || '' }}</span>&nbsp;&nbsp;
                  <span>Elective 2 : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[150px]`">{{ applicationData.elective2 || '' }}</span>&nbsp;&nbsp;
                  <span>Elective 3 : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[150px]`">{{ applicationData.elective3 || '' }}</span>&nbsp;&nbsp;
                  <span>Optional Subject : </span>
                  <span :class="`px-1 pb-1 border-b ${colorClass.border} inline-block min-w-[150px]`">{{ applicationData.optional || '' }}</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="mt-6 flex gap-4">
        <button 
          @click="generatePdf" 
          class="px-6 py-2 bg-green-600 text-white rounded shadow hover:bg-green-700 transition-colors flex items-center"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
          </svg>
          Download Application Form
        </button>
      </div>
      <div v-if="downloadError" class="mt-2 text-red-600">{{ downloadError }}</div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import html2canvas from 'html2canvas';
import jsPDF from 'jspdf';

// Props
const props = defineProps({
  formData: {
    type: Object,
    required: true
  },
  onChange: {
    type: Function,
    required: true
  }
});

// State
const applicationData = ref(null);
const loading = ref(true);
const error = ref(null);
const downloadError = ref(null);
const contentRef = ref(null);

// Group Colors Configuration
const groupColors = {
  // hsc groups
  "Science": {
    bg: "bg-yellow-200",
    text: "text-yellow-900",
    border: "border-yellow-500"
  },
  "Business Studies": {
    bg: "bg-green-200",
    text: "text-green-900",
    border: "border-green-500"
  },
  "Humanities": {
    bg: "bg-blue-200",
    text: "text-blue-900",
    border: "border-blue-500"
  },
  
  // honours groups
  "Accounting": {
    bg: "bg-yellow-300",
    text: "text-yellow-800",
    border: "border-yellow-600"
  },
  "Management": {
    bg: "bg-green-300",
    text: "text-green-800",
    border: "border-green-600"
  },
  "Economics": {
    bg: "bg-blue-300",
    text: "text-blue-800",
    border: "border-blue-600"
  },
  
  // degree groups
  "BA": {
    bg: "bg-blue-400",
    text: "text-blue-700",
    border: "border-blue-800"
  },
  "BSS": {
    bg: "bg-green-400",
    text: "text-green-700",
    border: "border-green-800"
  },
  "BBS": {
    bg: "bg-yellow-400",
    text: "text-yellow-700",
    border: "border-yellow-800"
  },
};

// Computed Properties
const colorClass = computed(() => {
  if (!applicationData.value || !applicationData.value.group) {
    return { bg: "bg-gray-100", text: "text-gray-800", border: "border-gray-600" };
  }
  return groupColors[applicationData.value.group] || { bg: "bg-gray-100", text: "text-gray-800", border: "border-gray-600" };
});

const computedPin = computed(() => {
  if (!applicationData.value) return '';
  
  const sessionPrefix = (s) => {
    const m = String(s || '').match(/(\d{4})/);
    return m ? m[1].slice(2) : '';
  };
  
  return applicationData.value.pinCode || `${sessionPrefix(applicationData.value.session)}${String(applicationData.value.id).padStart(4, '0')}`;
});

// Methods
function computePublicUrl(p) {
  const parts = window.location.pathname.split('/');
  const base = parts[1] ? `/${parts[1]}` : '';
  return `${base}/public/${p}`;
}

const generatePdf = async () => {
  if (!contentRef.value) return;
  downloadError.value = null;
  
  try {
    const element = contentRef.value;
    const canvas = await html2canvas(element, {
      scale: 2,
      useCORS: true,
      logging: false,
      windowWidth: element.scrollWidth,
      windowHeight: element.scrollHeight
    });
    
    const imgData = canvas.toDataURL('image/png');
    const pdf = new jsPDF({
      orientation: 'portrait',
      unit: 'px',
      format: [canvas.width, canvas.height]
    });
    
    pdf.addImage(imgData, 'PNG', 0, 0, canvas.width, canvas.height);
    const filename = `Application_${applicationData.value.pinCode || applicationData.value.id}.pdf`;
    pdf.save(filename);
  } catch (err) {
    console.error('PDF generation failed:', err);
    downloadError.value = 'Failed to generate PDF. Please try again.';
  }
};

const applyAgain = () => {
  props.onChange('resetForm', true);
};

// Lifecycle
onMounted(async () => {
  try {
    let pincodeToUse = props.formData.pinCode || props.formData.pincode;
    
    if (!pincodeToUse) {
      const urlParams = new URLSearchParams(window.location.search);
      pincodeToUse = urlParams.get('pincode');
    }
    
    if (pincodeToUse) {
      const parts = window.location.pathname.split('/');
      const base = parts[1] ? `/${parts[1]}` : '';
      const apiBase = `${base}/api`;
      const response = await fetch(`${apiBase}/student-application/by-pincode/${pincodeToUse}`);
      
      if (!response.ok) throw new Error('Failed to fetch application data');
      
      applicationData.value = await response.json();
    } else if (props.formData.id) {
         const parts = window.location.pathname.split('/');
         const base = parts[1] ? `/${parts[1]}` : '';
         const apiBase = `${base}/api`;
         const response = await fetch(`${apiBase}/student-application/${props.formData.id}`);
         if (response.ok) {
             applicationData.value = await response.json();
         }
    }
  } catch (err) {
    console.error('Error fetching application data:', err);
    error.value = 'Error loading application data';
  } finally {
    loading.value = false;
  }
});
</script>