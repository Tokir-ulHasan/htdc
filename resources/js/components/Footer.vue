<template>
  <footer class="bg-ddPrimary-300 text-white w-full">
    <!-- Quick Links Section -->
    <div class="w-full">
      <!-- Links arranged responsively -->
      <ul class="text-sm flex flex-wrap text-xs gap-1 p-4">
        <li v-for="(link, i) in displayLinks" :key="i" class="w-full md:w-auto bg-ddPrimary-100 px-2 py-1">
          <a :href="link.url" target="_blank" rel="noopener noreferrer" class="hover:underline">{{ link.label }}</a>
        </li>
      </ul>
    </div>

    <div class="border-t border-green-800 text-center py-2 text-xs">
      <p>&copy; {{ new Date().getFullYear() }} Hazera-Taju Degree College. All rights reserved.</p>
    </div>
  </footer>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';

// State
const links = ref([]);

// Default links
const defaultLinks = [
  { label: "Chittagong Education Board", url: "https://www.bise-ctg.gov.bd" },
  { label: "National University", url: "https://www.nubd.info" },
  { label: "National University Admission", url: "https://app1.nu.edu.bd" },
  { label: "সোনালী ব্যাংক (Sonali Bank)", url: "https://202.51.179.36/pms/default.aspx" },
  { label: "National University Result", url: "https://www.nubd.info" },
  { label: "Directorate of Secondary And Higher Education", url: "https://www.dshe.gov.bd/" }
];

// Fetch dynamic links on component mount
onMounted(() => {
  const parts = window.location.pathname.split('/');
  const base = parts[1] ? `/${parts[1]}` : '';
  const apiBase = `${base}/api`;
  fetch(`${apiBase}/admin/settings`)
    .then(res => res.json())
    .then(data => {
      if(data.settings) {
        const s = data.settings;
        const dynamicLinks = [];
        // Check for up to 5 dynamic links
        for(let i = 1; i <= 5; i++) {
          if(s[`footer_link_${i}_label`] && s[`footer_link_${i}_url`]) {
            dynamicLinks.push({
              label: s[`footer_link_${i}_label`],
              url: s[`footer_link_${i}_url`]
            });
          }
        }
        if(dynamicLinks.length > 0) links.value = dynamicLinks;
      }
    })
    .catch(err => console.error(err));
});

// Computed property for display links
const displayLinks = computed(() => {
  return links.value.length > 0 ? links.value : defaultLinks;
});
</script>
