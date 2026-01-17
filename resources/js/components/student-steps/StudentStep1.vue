<template>
  <div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Program <span class="text-red-500">*</span></label>
        <CustomSelect
          :model-value="formData.program"
          :options="programOptions"
          :placeholder="'Select Program'"
          :error="!!formErrors.program"
          @update:modelValue="v => handleProgramChange({ target: { value: v }})"
        />
        <p v-if="formErrors.program" class="text-xs text-red-500 mt-1">{{ formErrors.program }}</p>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Group <span class="text-red-500">*</span></label>
        <CustomSelect
          :model-value="formData.group"
          :options="groupOptions"
          :placeholder="'Select Group'"
          :disabled="!formData.program"
          :error="!!formErrors.group"
          @update:modelValue="v => onChange('group', v)"
        />
        <p v-if="formErrors.group" class="text-xs text-red-500 mt-1">{{ formErrors.group }}</p>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Session <span class="text-red-500">*</span></label>
        <CustomSelect
          :model-value="formData.session"
          :options="sessionOptions"
          :placeholder="'Select Session'"
          :error="!!formErrors.session"
          @update:modelValue="v => onChange('session', v)"
        />
        <p v-if="formErrors.session" class="text-xs text-red-500 mt-1">{{ formErrors.session }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
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

// Reactive data
const programs = ref([]);
const groups = ref([]);
const sessions = ref([]);

// Computed property to filter groups based on selected program
const filteredGroups = computed(() => {
  if (!props.formData.program) {
    return [];
  }
  
  const programId = programs.value.find(p => p.name === props.formData.program)?.id;
  if (!programId) {
    return [];
  }
  
  return groups.value.filter(g => g.programId === programId);
});

const groupOptions = computed(() => filteredGroups.value.map(g => ({ label: g.name, value: g.name })));
const programOptions = computed(() => programs.value.map(p => p.name));
const sessionOptions = computed(() => sessions.value.map(s => s.session));
// Fetch data from API
onMounted(async () => {
  try {
    const segments = window.location.pathname.split('/').filter(Boolean);
    const base = segments[0] && segments[0].toLowerCase() === 'htdc' ? `/${segments[0]}` : '';
    const apiBase = `${base}/api`;
    const [programsRes, groupsRes, sessionsRes] = await Promise.all([
      fetch(`${apiBase}/programs`),
      fetch(`${apiBase}/groups`),
      fetch(`${apiBase}/sessions`)
    ]);
    
    programs.value = (await programsRes.json()).filter(p => p.admissionStatus == 1);
    groups.value = (await groupsRes.json()).filter(g => g.admissionStatus == 1);
    sessions.value = (await sessionsRes.json()).filter(s => s.admissionStatus == 1);
  } catch (error) {
    console.error('Error fetching data:', error);
  }
});

// Handle program change - reset group when program changes
const handleProgramChange = (event) => {
  const selectedProgram = event.target.value;
  props.onChange('program', selectedProgram);
  // Reset group selection when program changes
  props.onChange('group', '');
};
</script>

<style scoped>
/* Basic styling for the select box */
  select {
    padding: 10px;
    font-size: 16px;
    width: 200px;
  }

  /* Styling the option groups */
  optgroup {
    font-weight: bold;
    font-style: italic;
  }

  /* NOTE: Browser support for hover on <option> is limited. 
     This works best in Firefox/Chrome for specific attributes.
  */
  option:hover, 
  option:focus, 
  option:checked {
    background-color: rgb(13, 255, 0) !important;
    color: white !important;
  }

  /* Class applied via JS when an option is selected */
  .selected-option {
    background-color: rgb(0, 255, 145) !important;
    color: white !important;
  }
</style>
