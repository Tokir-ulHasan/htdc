<template>
  <div class="space-y-6">
    <!-- By default (mobile-first), the sections will stack.
         On medium screens (md) and up, they will display side-by-side. -->
    <div class="flex flex-col md:flex-row gap-6">
      <!-- Section 1: Slider 
           Mobile: Full width (w-full).
           Medium (md) and up: 60% width (w-3/5). -->
      <section class="w-full md:w-3/5">
        <Slider :images="banners" />
      </section>

      <!-- Section 2: Welcome 
           Mobile: Full width (w-full).
           Medium (md) and up: 40% width (w-2/5). -->
      <section class="w-full md:w-2/5 bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold">{{ welcomeText }}</h1>
        <div class="mt-2 text-slate-700" v-html="welcomeContent"></div>
      </section>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Slider from './Slider.vue';

// Data
const banners = ref(['images/banner1.png', 'images/banner2.png', 'images/banner3.png']);
const welcomeText = ref('Welcome to Hazera-Taju Degree College');
const welcomeContent = ref('This is a starter site scaffolded per provided specifications. Use the sidebar to navigate pages.');

// Lifecycle
onMounted(() => {
  // Fetch Slider
  // In a real application, you would uncomment the following code:
  /*
  fetch('api/admin/slider')
    .then(res => res.json())
    .then(data => {
      if(data.slides && data.slides.length > 0) {
        banners.value = data.slides;
      }
    })
    .catch(err => console.error(err));
  */

  // Fetch Page Content (Welcome Message) - Assuming we use slug 'home-welcome'
  // In a real application, you would uncomment the following code:
  /*
  fetch('api/admin/pages?slug=home-welcome')
    .then(res => res.json())
    .then(data => {
      if(data.page) {
        welcomeText.value = data.page.title;
        welcomeContent.value = data.page.content;
      }
    })
    .catch(err => console.error(err));
  */
});
</script>
