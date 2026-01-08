<template>
  <div 
    v-if="!isMobile"
    class="relative"
    @mouseenter="setIsOpen(true)"
    @mouseleave="() => { setIsOpen(false); setOpenSubmenu(null); }"
  >
    <a 
      href="#" 
      class="text-sm text-slate-100 px-3 py-1 hover:bg-ddPrimary-100 flex items-center"
      aria-expanded="isOpen"
      @click.prevent="setIsOpen(true)"
    >
      {{ label }}
      <span 
        class="ml-1 transition-transform duration-300" 
        :class="isOpen ? 'rotate-180' : 'rotate-0'"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </span>
    </a>
    
    <ul 
      v-if="isOpen"
      class="absolute z-[9999] top-full left-0 mt-0 w-56 bg-ddPrimary-300 shadow-lg py-0"
    >
      <li 
        v-for="(item, index) in items" 
        :key="index" 
        class="relative border-b border-gray-50"
      >
        <div
          v-if="item.subItems"
          @mouseenter="!isMobile ? setOpenSubmenu(item.key) : undefined"
          @mouseleave="!isMobile ? setOpenSubmenu(null) : undefined"
        >
          <a 
            href="#" 
            class="text-sm text-slate-100 px-3 py-1 hover:bg-green-800 whitespace-nowrap flex justify-between items-center"
            @click.prevent="isMobile ? handleSubToggle(item.key) : undefined"
          >
            {{ item.label }}
            <span 
              class="transition-transform duration-200" 
              :class="openSubmenu === item.key ? 'rotate-180' : 'rotate-0'"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </span>
          </a>

          <ul 
            v-if="openSubmenu === item.key || (isMobile && openSubmenu === item.key)"
            class="z-[10000] w-full bg-ddPrimary-300 shadow-xl py-1 absolute top-0 left-full mt-0"
          >
            <li v-for="(subItem, subIndex) in item.subItems" :key="subIndex">
              <a 
                :href="subItem.href || '#'" 
                class="text-xs text-slate-300 pl-6 py-1 hover:bg-green-700 whitespace-nowrap block"
              >
                {{ subItem.label }}
              </a>
            </li>
          </ul>
        </div>
        <a 
          v-else 
          :href="item.href || '#'" 
          class="text-sm text-slate-100 px-3 py-1 hover:bg-green-800 whitespace-nowrap flex justify-between items-center"
        >
          {{ item.label }}
        </a>
      </li>
    </ul>
  </div>

  <div v-else class="relative">
    <a 
      href="#" 
      class="text-sm text-slate-100 px-3 py-2 hover:bg-green-800 rounded block flex justify-between items-center"
      @click.prevent="handleMainToggle"
    >
      {{ label }}
      <span 
        class="transition-transform duration-300" 
        :class="isOpen ? 'rotate-180' : 'rotate-0'"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </span>
    </a>
    <ul 
      v-if="isOpen"
      class="z-[9999] static w-full bg-ddPrimary-300 shadow-lg py-0"
    >
      <li 
        v-for="(item, index) in items" 
        :key="index" 
        class="relative border-b border-gray-50"
      >
        <div>
          <a 
            v-if="item.subItems"
            href="#" 
            class="text-sm text-slate-100 px-3 py-1 hover:bg-green-800 whitespace-nowrap flex justify-between items-center"
            @click.prevent="handleSubToggle(item.key)"
          >
            {{ item.label }}
            <span 
              class="transition-transform duration-200" 
              :class="openSubmenu === item.key ? 'rotate-180' : 'rotate-0'"
            >
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </span>
          </a>
          <a 
            v-else 
            :href="item.href || '#'" 
            class="text-sm text-slate-100 px-3 py-1 hover:bg-green-800 whitespace-nowrap flex justify-between items-center"
          >
            {{ item.label }}
          </a>

          <ul 
            v-if="openSubmenu === item.key"
            class="z-[10000] w-full bg-ddPrimary-300 shadow-xl py-1 ml-0 static"
          >
            <li v-for="(subItem, subIndex) in item.subItems" :key="subIndex">
              <a 
                :href="subItem.href || '#'" 
                class="text-xs text-slate-300 pl-6 py-1 hover:bg-green-700 whitespace-nowrap block"
              >
                {{ subItem.label }}
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

// Props
const props = defineProps({
  label: {
    type: String,
    required: true
  },
  items: {
    type: Array,
    required: true
  },
  isMobile: {
    type: Boolean,
    default: false
  }
});

// Data
const localIsOpen = ref(false);
const localOpenSubmenu = ref(null);

// Computed
const isOpen = computed({
  get: () => localIsOpen.value,
  set: (value) => {
    localIsOpen.value = value;
    if (!value) {
      localOpenSubmenu.value = null;
    }
  }
});

const openSubmenu = computed({
  get: () => localOpenSubmenu.value,
  set: (value) => {
    localOpenSubmenu.value = value;
  }
});

// Methods
const setIsOpen = (value) => {
  isOpen.value = value;
};

const setOpenSubmenu = (key) => {
  openSubmenu.value = openSubmenu.value === key ? null : key;
};

const handleMainToggle = (e) => {
  e.preventDefault(); 
  setIsOpen(!isOpen.value);
};

const handleSubToggle = (key) => {
  setOpenSubmenu(openSubmenu.value === key ? null : key);
};
</script>