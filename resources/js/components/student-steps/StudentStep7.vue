<template>
  <div class="space-y-6">
    <!-- Loading indicator -->
    <div v-if="loadingSubjects" class="text-center py-4">
      Loading subjects...
    </div>
    
    <!-- Error message -->
    <div v-if="error" class="text-red-500 text-center py-4">
      {{ error }}
    </div>
    
    <!-- SSC Information -->
    <div class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">SSC / Equivalent</div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Board <span class="text-red-500">*</span></label>
          <select 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :class="{'border-red-500': !formData.sscBoard}"
            :value="formData.sscBoard"
            @change="e => onChange('sscBoard', e.target.value)"
          >
            <option value="">Select Board</option>
            <option value="Dhaka">Dhaka</option>
            <option value="Chittagong">Chittagong</option>
            <option value="Comilla">Comilla</option>
            <option value="Rajshahi">Rajshahi</option>
            <option value="Sylhet">Sylhet</option>
            <option value="Barisal">Barisal</option>
            <option value="Khulna">Khulna</option>
            <option value="Jessore">Jessore</option>
            <option value="Dinajpur">Dinajpur</option>
            <option value="Mymensingh">Mymensingh</option>
            <option value="Technical">Technical</option>
            <option value="Madrasah">Madrasah</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Passing Year <span class="text-red-500">*</span></label>
          <select 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :class="{'border-red-500': !formData.sscYear}"
            :value="formData.sscYear"
            @change="e => onChange('sscYear', e.target.value)"
          >
            <option value="">Select Year</option>
            <option v-for="year in passingYears(2000)" :key="year" :value="year">{{ year }}</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Session <span class="text-red-500">*</span></label>
          <select 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :class="{'border-red-500': !formData.sscSession}"
            :value="formData.sscSession"
            @change="e => onChange('sscSession', e.target.value)"
          >
            <option value="">Select Session</option>
            <option 
              v-for="session in sessions" 
              :key="session.session" 
              :value="session.session"
            >
              {{ session.session }}
            </option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Roll No <span class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :class="{'border-red-500': !formData.sscRoll}"
            :value="formData.sscRoll"
            @input="e => onChange('sscRoll', e.target.value)"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Registration No <span class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :class="{'border-red-500': !formData.sscReg}"
            :value="formData.sscReg"
            @input="e => onChange('sscReg', e.target.value)"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">GPA <span class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :class="{'border-red-500': !formData.gpa1}"
            :value="formData.gpa1"
            @input="e => onChange('gpa1', e.target.value)"
          />
        </div>
      </div>
    </div>

    <!-- HSC Information (Conditional based on program hscStatus) -->
    <div v-if="isHSCStatusOpen" class="border p-4 rounded relative">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">HSC / Equivalent</div>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Board <span v-if="isHSCStatusOpen" class="text-red-500">*</span></label>
          <select 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :class="{'border-red-500': isHSCStatusOpen && !formData.hscBoard}"
            :value="formData.hscBoard"
            @change="e => onChange('hscBoard', e.target.value)"
          >
            <option value="">Select Board</option>
            <option value="Dhaka">Dhaka</option>
            <option value="Chittagong">Chittagong</option>
            <option value="Comilla">Comilla</option>
            <option value="Rajshahi">Rajshahi</option>
            <option value="Sylhet">Sylhet</option>
            <option value="Barisal">Barisal</option>
            <option value="Khulna">Khulna</option>
            <option value="Jessore">Jessore</option>
            <option value="Dinajpur">Dinajpur</option>
            <option value="Mymensingh">Mymensingh</option>
            <option value="Technical">Technical</option>
            <option value="Madrasah">Madrasah</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Passing Year <span v-if="isHSCStatusOpen" class="text-red-500">*</span></label>
          <select 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :class="{'border-red-500': isHSCStatusOpen && !formData.hscYear}"
            :value="formData.hscYear"
            @change="e => onChange('hscYear', e.target.value)"
          >
            <option value="">Select Year</option>
            <option v-for="year in passingYears(2000)" :key="year" :value="year">{{ year }}</option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Session <span v-if="isHSCStatusOpen" class="text-red-500">*</span></label>
          <select 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :class="{'border-red-500': isHSCStatusOpen && !formData.hscSession}"
            :value="formData.hscSession"
            @change="e => onChange('hscSession', e.target.value)"
          >
            <option value="">Select Session</option>
            <option 
              v-for="session in sessions" 
              :key="session.session" 
              :value="session.session"
            >
              {{ session.session }}
            </option>
          </select>
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Roll No <span v-if="isHSCStatusOpen" class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :class="{'border-red-500': isHSCStatusOpen && !formData.hscRoll}"
            :value="formData.hscRoll"
            @input="e => onChange('hscRoll', e.target.value)"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Registration No <span v-if="isHSCStatusOpen" class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :class="{'border-red-500': isHSCStatusOpen && !formData.hscReg}"
            :value="formData.hscReg"
            @input="e => onChange('hscReg', e.target.value)"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">GPA <span v-if="isHSCStatusOpen" class="text-red-500">*</span></label>
          <input 
            type="text" 
            class="w-full border border-gray-300 rounded px-3 py-2"
            :class="{'border-red-500': isHSCStatusOpen && !formData.gpa2}"
            :value="formData.gpa2"
            @input="e => onChange('gpa2', e.target.value)"
          />
        </div>
      </div>
    </div>

    <!-- Subject Selection (Elective subjects for HSC programs with hscStatus=1) -->
    <div v-if="!isHSCStatusOpen && !loadingSubjects && subjects.length > 0" class="border p-4 rounded relative mt-4">
      <div class="absolute -top-3 left-3 bg-white px-2 text-sm font-bold text-green-700">Subject Selection</div>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
        <!-- Fixed Compulsory Subjects based on selected group -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Compulsory Subject 1 <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="getFixedCompulsorySubject(1)"
            :options="[getFixedCompulsorySubject(1)]"
            :placeholder="'Subject'"
            :disabled="true"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Compulsory Subject 2 <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="getFixedCompulsorySubject(2)"
            :options="[getFixedCompulsorySubject(2)]"
            :placeholder="'Subject'"
            :disabled="true"
          />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Compulsory Subject 3 <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="getFixedCompulsorySubject(3)"
            :options="[getFixedCompulsorySubject(3)]"
            :placeholder="'Subject'"
            :disabled="true"
          />
        </div>
        
        <!-- Elective and Optional Subjects with Group-Specific Logic -->
        <div v-if="getSelectedGroup() === 'Humanities'">
          <label class="block text-sm font-medium text-gray-700 mb-1">Elective Subject 1 (Status 0) <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="formData.elective1"
            :options="getElectiveSubjectByStatusForField(0, 'elective1').map(s => ({ label: s.name, value: s.name }))"
            :placeholder="'Select Subject'"
            :error="!formData.elective1"
            @update:modelValue="v => handleElectiveChange('elective1', v)"
          />
        </div>
        <div v-if="getSelectedGroup() === 'Humanities'">
          <label class="block text-sm font-medium text-gray-700 mb-1">Elective Subject 2 (Status 0) <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="formData.elective2"
            :options="getElectiveSubjectByStatusForField(0, 'elective2').map(s => ({ label: s.name, value: s.name }))"
            :placeholder="'Select Subject'"
            :error="!formData.elective2"
            @update:modelValue="v => handleElectiveChange('elective2', v)"
          />
        </div>
        <div v-if="getSelectedGroup() !== 'Science' && getSelectedGroup() !== 'Business Studies' && getSelectedGroup() !== 'Humanities'">
          <label class="block text-sm font-medium text-gray-700 mb-1">Elective Subject 1 (Status 4) <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="formData.elective1"
            :options="getElectiveSubjectByStatusForField(4, 'elective1').map(s => ({ label: s.name, value: s.name, disabled: isSubjectSelected(s.name, ['elective1']) }))"
            :placeholder="'Select Subject'"
            :error="!formData.elective1"
            @update:modelValue="v => handleElectiveChange('elective1', v)"
          />
        </div>
        <div v-if="getSelectedGroup() !== 'Science' && getSelectedGroup() !== 'Business Studies' && getSelectedGroup() !== 'Humanities'">
          <label class="block text-sm font-medium text-gray-700 mb-1">Elective Subject 2 (Status 5) <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="formData.elective2"
            :options="getElectiveSubjectByStatusForField(5, 'elective2').map(s => ({ label: s.name, value: s.name, disabled: isSubjectSelected(s.name, ['elective2']) }))"
            :placeholder="'Select Subject'"
            :error="!formData.elective2"
            @update:modelValue="v => handleElectiveChange('elective2', v)"
          />
        </div>
        <div v-if="getSelectedGroup() === 'Science'">
          <label class="block text-sm font-medium text-gray-700 mb-1">Elective Subject 1 (Fixed) <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="getFixedSubjectByStatusAndGroup(4)"
            :options="[getFixedSubjectByStatusAndGroup(4)]"
            :placeholder="'Subject'"
            :disabled="true"
          />
        </div>
        <div v-if="getSelectedGroup() === 'Science'">
          <label class="block text-sm font-medium text-gray-700 mb-1">Elective Subject 2 (Fixed) <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="getFixedSubjectByStatusAndGroup(5)"
            :options="[getFixedSubjectByStatusAndGroup(5)]"
            :placeholder="'Subject'"
            :disabled="true"
          />
        </div>
        <div v-if="getSelectedGroup() === 'Business Studies'">
          <label class="block text-sm font-medium text-gray-700 mb-1">Elective Subject 1 (Fixed) <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="getFixedSubjectByStatusAndGroup(4)"
            :options="[getFixedSubjectByStatusAndGroup(4)]"
            :placeholder="'Subject'"
            :disabled="true"
          />
        </div>
        <div v-if="getSelectedGroup() === 'Business Studies'">
          <label class="block text-sm font-medium text-gray-700 mb-1">Elective Subject 2 (Fixed) <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="getFixedSubjectByStatusAndGroup(5)"
            :options="[getFixedSubjectByStatusAndGroup(5)]"
            :placeholder="'Subject'"
            :disabled="true"
          />
        </div>
        <div v-if="getSelectedGroup() === 'Business Studies'">
          <label class="block text-sm font-medium text-gray-700 mb-1">Elective Subject 3 (Fixed) <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="getFixedSubjectByStatusAndGroup(6)"
            :options="[getFixedSubjectByStatusAndGroup(6)]"
            :placeholder="'Subject'"
            :disabled="true"
          />
        </div>
        <div v-if="getSelectedGroup() === 'Business Studies'">
          <label class="block text-sm font-medium text-gray-700 mb-1">Optional Subject (Fixed) <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="getFixedSubjectByStatusAndGroup(7)"
            :options="[getFixedSubjectByStatusAndGroup(7)]"
            :placeholder="'Subject'"
            :disabled="true"
          />
        </div>
        <div v-if="getSelectedGroup() === 'Humanities'">
          <label class="block text-sm font-medium text-gray-700 mb-1">Elective Subject 3 (Status 0) <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="formData.elective3"
            :options="getElectiveSubjectByStatusForField(0, 'elective3').map(s => ({ label: s.name, value: s.name }))"
            :placeholder="'Select Subject'"
            :error="!formData.elective3"
            @update:modelValue="v => handleElectiveChange('elective3', v)"
          />
        </div>
        <div v-if="getSelectedGroup() !== 'Business Studies' && getSelectedGroup() !== 'Humanities'">
          <label class="block text-sm font-medium text-gray-700 mb-1">Elective Subject 3 (Status 0) <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="formData.elective3"
            :options="getElectiveSubjectByStatusForField(0, 'elective3').map(s => ({ label: s.name, value: s.name }))"
            :placeholder="'Select Subject'"
            :error="!formData.elective3"
            @update:modelValue="v => handleScienceElective3Change(v)"
          />
        </div>
        <div v-if="getSelectedGroup() === 'Humanities'">
          <label class="block text-sm font-medium text-gray-700 mb-1">Optional Subject (Status 0) <span class="text-red-500">*</span></label>
          <CustomSelect
            :model-value="formData.optional"
            :options="getElectiveSubjectByStatusForField(0, 'optional').map(s => ({ label: s.name, value: s.name }))"
            :placeholder="'Select Subject'"
            :error="!formData.optional"
            @update:modelValue="v => handleElectiveChange('optional', v)"
          />
        </div>
        <div v-if="getSelectedGroup() !== 'Business Studies' && getSelectedGroup() !== 'Humanities'">
          <label class="block text-sm font-medium text-gray-700 mb-1">Optional Subject (Auto-selected)</label>
          <CustomSelect
            :model-value="getScienceOptionalSubject()"
            :options="[getScienceOptionalSubject()]"
            :placeholder="'Subject'"
            :disabled="true"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, ref, onMounted, watch } from 'vue';
import CustomSelect from '../common/CustomSelect.vue';

// State for subjects and sessions
const subjects = ref([]);
const sessions = ref([]);
const loadingSubjects = ref(true);
const loadingSessions = ref(true);
const error = ref(null);

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

// Computed properties to determine if the selected program requires HSC information
const isHSCStatusOpen = computed(() => {
  // According to API data: HSC has hscStatus=0, Degree/Honours have hscStatus=1
  // When hscStatus is 1, HSC details should be shown
  // When hscStatus is 0, HSC details should be hidden
  return props.formData.program && (props.formData.program.toLowerCase().includes('degree') ||props.formData.program.toLowerCase().includes('honours'));
});

// Method to determine if the selected program is HSC (Program ID 1)
const isHSCProgram = computed(() => {
  return props.formData.program && props.formData.program.toLowerCase().includes('hsc');
});

// Fetch subjects and sessions from API
const fetchSubjects = async () => {
  try {
    loadingSubjects.value = true;
    error.value = null;
    
    const parts = window.location.pathname.split('/');
    const base = parts[1] ? `/${parts[1]}` : '';
    const apiBase = `${base}/api`;
    const response = await fetch(`${apiBase}/subjects`);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    
    const data = await response.json();
    subjects.value = data;
  } catch (err) {
    console.error('Error fetching subjects:', err);
    error.value = 'Failed to load subjects. Please try again later.';
  } finally {
    loadingSubjects.value = false;
  }
};

const fetchSessions = async () => {
  try {
    loadingSessions.value = true;
    
    const parts = window.location.pathname.split('/');
    const base = parts[1] ? `/${parts[1]}` : '';
    const apiBase = `${base}/api`;
    const response = await fetch(`${apiBase}/sessions`);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    
    const data = await response.json();
    sessions.value = data;
  } catch (err) {
    console.error('Error fetching sessions:', err);
    error.value = 'Failed to load sessions. Please try again later.';
  } finally {
    loadingSessions.value = false;
  }
};

// Method to get fixed compulsory subject based on position and selected group
const getFixedCompulsorySubject = (position) => {
  const selectedGroup = props.formData.group;
  const selectedProgram = props.formData.program;
  
  // Find subjects that match the status for compulsory subjects (1, 2, 3)
  let status;
  if (position === 1) status = 1;
  else if (position === 2) status = 2;
  else if (position === 3) status = 3;
  
  // First, try to find subjects specific to the selected group
  if (selectedGroup) {
    const groupSpecificSubject = subjects.value.find(subject => 
      subject.status === status && 
      subject.groupId === getGroupIdByName(selectedGroup)
    );
    
    if (groupSpecificSubject) {
      return groupSpecificSubject.name;
    }
  }
  
  // If no group-specific subject found, fall back to general subject (groupId 0)
  const generalSubject = subjects.value.find(subject => 
    subject.status === status && 
    subject.groupId === 0
  );
  
  return generalSubject ? generalSubject.name : '';
};

// Method to get group ID by name
const getGroupIdByName = (groupName) => {
  const groupMap = {
    'Science': 1,
    'Business Studies': 2,
    'Humanities': 3,
  };
  return groupMap[groupName] || 0;
};

// Method to get selected group
const getSelectedGroup = () => {
  return props.formData.group;
};

// Method to get fixed subject by status and group
const getFixedSubjectByStatusAndGroup = (status) => {
  const selectedGroup = props.formData.group;
  
  if (selectedGroup) {
    const groupId = getGroupIdByName(selectedGroup);
    
    // Find subject with the specific status and group ID
    const subject = subjects.value.find(subject => 
      subject.status === status && 
      subject.groupId === groupId
    );
    
    return subject ? subject.name : '';
  }
  
  return '';
};

// Method to get subjects by specific status and group for a specific field
const getElectiveSubjectByStatusForField = (status, currentField) => {
  const selectedGroup = props.formData.group;
  
  // If a group is selected, filter by that group ID
  if (selectedGroup) {
    const groupId = getGroupIdByName(selectedGroup);
    
    // First, get subjects specific to the selected group
    let groupSpecificSubjects = subjects.value.filter(subject => 
      subject.status === status && 
      subject.groupId === groupId
    );
    
    // For Humanities group (Group ID 3), filter out already selected subjects from other fields
    if (groupId === 3) {
      groupSpecificSubjects = groupSpecificSubjects.filter(subject => 
        !isSubjectAlreadySelectedForField(subject.name, currentField)
      );
    }
    
    // If no group-specific subjects found, return all subjects with that status
    if (groupSpecificSubjects.length > 0) {
      return groupSpecificSubjects;
    }
  }
  
  // Return all subjects with the specified status
  let subjectsWithStatus = subjects.value.filter(subject => 
    subject.status === status
  );
  
  // For Humanities group (Group ID 3), filter out already selected subjects from other fields
  if (getGroupIdByName(selectedGroup) === 3) {
    subjectsWithStatus = subjectsWithStatus.filter(subject => 
      !isSubjectAlreadySelectedForField(subject.name, currentField)
    );
  }
  
  return subjectsWithStatus;
};

// Method to check if a subject is already selected in other fields (excluding the current field)
const isSubjectAlreadySelectedForField = (subjectName, currentField) => {
  const selectedGroup = props.formData.group;
  
  // Only apply this logic for Humanities group (Group ID 3)
  if (getGroupIdByName(selectedGroup) !== 3) {
    return false;
  }
  
  // Define all subject fields
  const allSubjectFields = [
    'elective1',
    'elective2', 
    'elective3',
    'optional'
  ];
  
  // Check if the subject is already selected in any field except the current one
  for (const field of allSubjectFields) {
    if (field !== currentField && props.formData[field] === subjectName) {
      return true;
    }
  }
  
  return false;
};

// Method to handle Science Elective 3 change (auto-select optional)
const handleScienceElective3Change = (selectedSubject) => {
  props.onChange('elective3', selectedSubject);
  
  // Auto-select optional subject based on elective 3
  // In Science group, when elective3 is selected, the optional is auto-selected
  // For example, if elective3 is MATHEMATICS, optional could be BIOLOGY, and vice versa
  const optionalSubject = getAutoSelectedOptionalSubject(selectedSubject);
  props.onChange('optional', optionalSubject);
};

// Method to get auto-selected optional subject based on elective3
const getAutoSelectedOptionalSubject = (elective3Subject) => {
  if (!elective3Subject) return '';
  
  const selectedGroup = props.formData.group;
  const groupId = selectedGroup ? getGroupIdByName(selectedGroup) : 0;
  
  // Special handling for Science group (Group ID 1) where Math and Biology are interdependent
  if (groupId === 1) {
    // If elective3 is Mathematics, optional should be Biology
    if (elective3Subject.toLowerCase().includes('mathematics') || elective3Subject.toLowerCase().includes('math')) {
      const biologySubject = subjects.value.find(subject => 
        subject.groupId === 1 && 
        subject.status === 0 && 
        (subject.name.toLowerCase().includes('biology') || subject.name.toLowerCase().includes('bio'))
      );
      return biologySubject ? biologySubject.name : '';
    }
    // If elective3 is Biology, optional should be Mathematics
    else if (elective3Subject.toLowerCase().includes('biology') || elective3Subject.toLowerCase().includes('bio')) {
      const mathSubject = subjects.value.find(subject => 
        subject.groupId === 1 && 
        subject.status === 0 && 
        (subject.name.toLowerCase().includes('mathematics') || subject.name.toLowerCase().includes('math'))
      );
      return mathSubject ? mathSubject.name : '';
    }
  }
  
  // For other groups or if specific logic doesn't apply, use the general logic
  // Find all subjects with status 0 for the selected group
  const optionalSubjects = subjects.value.filter(subject => 
    subject.status === 0 && 
    subject.groupId === groupId
  );
  
  // If there are multiple optional subjects, return the one that's not the same as elective3
  const otherSubject = optionalSubjects.find(subject => 
    subject.name !== elective3Subject
  );
  
  return otherSubject ? otherSubject.name : '';
};

// Method to get the optional subject for Science group
const getScienceOptionalSubject = () => {
  // The optional subject is auto-selected based on elective3
  if (props.formData.elective3) {
    return getAutoSelectedOptionalSubject(props.formData.elective3);
  }
  return '';
};

// Utility function to generate passing years
const passingYears = (startYear) => {
  const currentYear = new Date().getFullYear();
  const years = [];
  for (let year = currentYear; year >= startYear; year--) {
    years.push(year);
  }
  return years;
};

// Method to check if a subject is already selected in other fields
const isSubjectSelected = (subject, excludeFields) => {
  // Check all subject fields except the ones we're excluding
  const allSubjectFields = [
    'compulsory1', 'compulsory2', 'compulsory3',
    'elective1', 'elective2', 'elective3', 'optional'
  ];
  
  for (const field of allSubjectFields) {
    if (!excludeFields.includes(field) && props.formData[field] === subject) {
      return true;
    }
  }
  return false;
};

// Method to handle elective subject changes
const handleElectiveChange = (field, value) => {
  props.onChange(field, value);
  
  // Reset subsequent fields when a field changes
  if (field === 'elective1') {
    props.onChange('elective2', '');
    props.onChange('elective3', '');
    props.onChange('optional', '');
  } else if (field === 'elective2') {
    props.onChange('elective3', '');
    props.onChange('optional', '');
  } else if (field === 'elective3') {
    props.onChange('optional', '');
  }
};

// Initialize subjects and sessions when component is mounted
onMounted(() => {
  fetchSubjects();
  fetchSessions();
});

// Watch for group changes and update compulsory subjects accordingly
watch(() => props.formData.group, (newGroup) => {
  if (subjects.value.length > 0) {
    // Update the compulsory subjects based on the selected group
    const comp1 = getFixedCompulsorySubject(1);
    const comp2 = getFixedCompulsorySubject(2);
    const comp3 = getFixedCompulsorySubject(3);
    
    // Update the form data with the fixed compulsory subjects
    props.onChange('compulsory1', comp1);
    props.onChange('compulsory2', comp2);
    props.onChange('compulsory3', comp3);
    
    // Update fixed elective subjects based on the selected group
    if (newGroup === 'Science') {
      const elective1 = getFixedSubjectByStatusAndGroup(4);
      const elective2 = getFixedSubjectByStatusAndGroup(5);
      props.onChange('elective1', elective1);
      props.onChange('elective2', elective2);
    } else if (newGroup === 'Business Studies') {
      const elective1 = getFixedSubjectByStatusAndGroup(4);
      const elective2 = getFixedSubjectByStatusAndGroup(5);
      const elective3 = getFixedSubjectByStatusAndGroup(6);
      const optional = getFixedSubjectByStatusAndGroup(7);
      props.onChange('elective1', elective1);
      props.onChange('elective2', elective2);
      props.onChange('elective3', elective3);
      props.onChange('optional', optional);
    }
  }
}, { immediate: true });

// Watch for subjects to load and update compulsory and fixed elective subjects
watch(() => subjects.value, (newSubjects) => {
  if (newSubjects.length > 0) {
    // Update the compulsory subjects based on the loaded subjects
    const comp1 = getFixedCompulsorySubject(1);
    const comp2 = getFixedCompulsorySubject(2);
    const comp3 = getFixedCompulsorySubject(3);
    
    // Update the form data with the fixed compulsory subjects
    props.onChange('compulsory1', comp1);
    props.onChange('compulsory2', comp2);
    props.onChange('compulsory3', comp3);
    
    // Update fixed elective subjects based on the loaded subjects
    const selectedGroup = props.formData.group;
    if (selectedGroup === 'Science') {
      const elective1 = getFixedSubjectByStatusAndGroup(4);
      const elective2 = getFixedSubjectByStatusAndGroup(5);
      props.onChange('elective1', elective1);
      props.onChange('elective2', elective2);
    } else if (selectedGroup === 'Business Studies') {
      const elective1 = getFixedSubjectByStatusAndGroup(4);
      const elective2 = getFixedSubjectByStatusAndGroup(5);
      const elective3 = getFixedSubjectByStatusAndGroup(6);
      const optional = getFixedSubjectByStatusAndGroup(7);
      props.onChange('elective1', elective1);
      props.onChange('elective2', elective2);
      props.onChange('elective3', elective3);
      props.onChange('optional', optional);
    }
  }
}, { immediate: true });
</script>
