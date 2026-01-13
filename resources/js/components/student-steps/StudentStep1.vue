<template>
  <div class="space-y-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Program <span class="text-red-500">*</span></label>
        <select 
          class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
          :class="formErrors.program ? 'border-red-500' : 'border-gray-300'"
          :value="formData.program"
          @change="handleProgramChange"
        >
          <option value="">Select Program</option>
          <option v-for="program in programs" :key="program.id" :value="program.name">
            {{ program.name }}
          </option>
        </select>
        <p v-if="formErrors.program" class="text-xs text-red-500 mt-1">{{ formErrors.program }}</p>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Group <span class="text-red-500">*</span></label>
        <select 
          class="w-full border rounded px-3 py-2 border-ddPrimary-400 focus:ring-2 focus:ring-red-500 focus:border-red-500"
          :class="formErrors.group ? 'border-red-500' : 'border-ddPrimary-400'"
          :value="formData.group"
          @change="e => onChange('group', e.target.value)"
          :disabled="!formData.program"
        >
          <option value="">Select Group</option>
          <option
          v-for="group in filteredGroups" :key="group.id" :value="group.name">
            {{ group.name }}
          </option>
        </select>
        <p v-if="formErrors.group" class="text-xs text-red-500 mt-1">{{ formErrors.group }}</p>
      </div>
      
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Session <span class="text-red-500">*</span></label>
        <select 
          class="w-full border rounded px-3 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500"
          :class="formErrors.session ? 'border-red-500' : 'border-gray-300'"
          :value="formData.session"
          @change="e => onChange('session', e.target.value)"
        >
          <option value="">Select Session</option>
          <option v-for="session in sessions" :key="session.session" :value="session.session">
            {{ session.session }}
          </option>
        </select>
        <p v-if="formErrors.session" class="text-xs text-red-500 mt-1">{{ formErrors.session }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';

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

// Fetch data from API
onMounted(async () => {
  try {
    const parts = window.location.pathname.split('/');
    const base = parts[1] ? `/${parts[1]}` : '';
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
/* Custom styling for select elements */
select {
  transition: all 0.2s ease;
}

/* Focus state styling */
select:focus {
  outline: none;
}

/* For Firefox - supports more select option styling */
select:-moz-focusring {
  color: transparent;
  text-shadow: 0 0 0 #000;
}

/* Styling for option hover and selected states */
select option:hover,
select option:checked,
select option:focus {
  background-color: #ef4444 !important; /* Tailwind red-500 */
  color: white;
}

/* For better option hover effect in supported browsers */
select:focus option:hover {
  background-color: #ef4444 !important; /* Tailwind red-500 */
  color: white;
}
</style>
