<template>
  <div class="space-y-4">
    <!-- Terms and Conditions -->
    <div class="border p-4 rounded relative">
      <div class="mt-2">
        <div class="prose max-w-none text-sm text-gray-700 mb-4 flex justify-center">
           <div v-if="loading" class="py-10 text-center text-gray-500">Loading terms...</div>
           <img v-else :src="currentProgramImage" alt="Terms and Conditions" class="max-w-full h-auto shadow-sm border rounded">
        </div>
        
        <div class="flex items-start mt-4">
          <input 
            type="checkbox" 
            id="agreement"
            :checked="formData.agreed"
            @change="e => onChange('agreed', e.target.checked)"
            class="mt-1 h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500"
          />
          <label for="agreement" class="ml-2 block text-sm text-gray-700">
            আমি ভর্তি প্রক্রিয়ার শর্তাবলী ও নিয়মাবলীর সাথে একমত এবং নিশ্চিত করছি যে প্রদত্ত সকল তথ্য সঠিক ও যথার্থ।
          </label>
        </div>
        
        <p v-if="formErrors.agreed" class="text-xs text-red-500 mt-1">{{ formErrors.agreed }}</p>
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

const programs = ref([]);
const loading = ref(true);

const currentProgramImage = computed(() => {
  if (!programs.value.length || !props.formData.program) {
    return '/images/terms/hscTerms.png'; // Default fallback
  }
  
  const program = programs.value.find(p => p.name === props.formData.program);
  return program ? program.termsImage : '/images/terms/hscTerms.png';
});

onMounted(async () => {
  try {
    const segments = window.location.pathname.split('/').filter(Boolean);
    const base = segments[0] && segments[0].toLowerCase() === 'htdc' ? `/${segments[0]}` : '';
    const apiBase = `${base}/api`;
    
    const response = await fetch(`${apiBase}/programs`);
    if (response.ok) {
      programs.value = await response.json();
    }
  } catch (error) {
    console.error('Error fetching programs:', error);
  } finally {
    loading.value = false;
  }
});
</script>
