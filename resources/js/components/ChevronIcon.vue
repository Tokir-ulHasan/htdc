<template>
  <svg 
    :class="['h-4 w-4 transition-transform duration-200', isOpen ? 'transform rotate-90' : '']"
    xmlns="http://www.w3.org/2000/svg" 
    viewBox="0 0 20 20" 
    fill="currentColor"
  >
    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10l-3.293-3.293a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
  </svg>
</template>

<script setup>
// Props
defineProps({
  isOpen: {
    type: Boolean,
    default: false
  }
});
</script>