<template>
  <nav class="bg-[#0d3a37] shadow-sm text-white">
    <div class="max-w-7xl mx-auto px-4">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-2">
          <button 
            @click="toggleSidebar" 
            class="md:hidden px-2 py-1 bg-[#0d3a37] text-white hover:bg-green-800" 
            aria-label="Toggle sidebar"
          >
            ☰
          </button>
          <div class="hidden md:flex space-x-3">
            <!-- Desktop Navigation -->
            <template v-for="label in allLinks" :key="label">
              <dropdown-menu 
                v-if="dropdowns[label]" 
                :label="label" 
                :items="dropdowns[label]" 
                :is-mobile="false"
              />
              <a 
                v-else 
                :href="hrefFor(label)" 
                class="text-sm text-slate-100 px-3 py-1 hover:bg-green-800"
              >
                {{ label }}
              </a>
            </template>
          </div>
        </div>

        <div class="md:hidden">
          <button 
            @click="toggleMobileMenu" 
            aria-label="Toggle menu" 
            class="px-2 py-1 bg-[#0d3a37] text-white hover:bg-green-800"
          >
            ☰
          </button>
        </div>
      </div>

      <div v-if="mobileMenuOpen" class="md:hidden pb-3">
        <!-- Mobile Navigation -->
        <div class="flex flex-col space-y-1">
          <template v-for="label in allLinks" :key="label">
            <dropdown-menu 
              v-if="dropdowns[label]" 
              :label="label" 
              :items="dropdowns[label]" 
              :is-mobile="true"
            />
            <a 
              v-else 
              :href="hrefFor(label)" 
              class="text-sm text-slate-100 px-3 py-2 hover:bg-green-800 rounded block"
            >
              {{ label }}
            </a>
          </template>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue';
import DropdownMenu from './DropdownMenu.vue'; // We'll create this component

// Props
const props = defineProps({
  setSidebarOpen: {
    type: Function,
    default: null
  }
});

// Data
const mobileMenuOpen = ref(false);

// Dropdown configuration
const dropdowns = {
  'RESULT': [
    { label: "HSC", href: "#" },
    { 
      label: "HONORS", 
      key: 'honors',
      subItems: [
        { label: "- ACCOUNTING", href: "#" },
        { label: "- MANAGEMENT", href: "#" },
        { label: "- ECONOMICS", href: "#" },
      ]
    },
    { 
      label: "DEGREE (PASS)", 
      key: 'degree',
      subItems: [
        { label: "- 1st YEAR", href: "#" },
        { label: "- 2nd YEAR", href: "#" },
        { label: "- 3rd YEAR", href: "#" },
      ] 
    }
  ],
  'E-SERVICES': [
    { label: "Online Admission", href: "/apply" },
    { label: "HSC", href: "#" },
    { label: "Honours", href: "#" },
    { label: "Degree", href: "#" },
  ],
  'DAILY ATTENDANCE': [
    { label: "Teacher Attendance", href: "#" },
    { label: "HSC Attedance", href: "#" },
    { label: "Honours Attedance", href: "#" },
    { label: "Drgree Attedance", href: "#" },
  ]
};

const allLinks = [
  'HOME', 'BOU', 'E-SERVICES', 'RESULT', 'NOTICE', 'FORM DOWNLOAD', 'PHOTO GALLARY', 'CONTACT', 'DAILY ATTENDANCE'
];

// Methods
const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value;
};

const toggleSidebar = () => {
  if (props.setSidebarOpen) {
    props.setSidebarOpen(prev => !prev);
  }
};

const hrefFor = (label) => {
  const key = label.toLowerCase();
  if(key === 'home') return '/' 
  if(key === 'form download') return '/form-download'
  if(key === 'contact') return '/contact'
  if(key === 'photo gallary') return '/gallery'
  if(key === 'notice') return '/notice'
  return '#'
};
</script>