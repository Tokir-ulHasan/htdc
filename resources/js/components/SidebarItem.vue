<template>
  <li 
    :class="['text-sm', bnClass, depth === 0 ? 'border-b border-gray-200' : '', 'relative']"
    @mouseenter="handleMouseEnter"
    @mouseleave="handleMouseLeave"
  >
    <!-- Main Link/Toggle -->
    <a 
      :href="item.href || '#'"
      @click="toggleOpen"
      :class="[
        'block py-3 hover:bg-slate-100',
        paddingClass,
        hasChildren ? 'font-medium flex justify-between items-center pr-2' : ''
      ]"
    >
      <span>{{ item.label }}</span>
      <chevron-icon v-if="hasChildren" :is-open="isOpen" />
    </a>

    <!-- Sub-menu (Conditional Styling) -->
    <ul 
      v-if="hasChildren && isOpen"
      :class="[
        'bg-slate-50 border-t border-gray-200 z-10',
        // Desktop Flyout Classes
        'md:absolute md:left-full md:top-0 md:w-60 md:shadow-lg md:border md:border-gray-300 md:z-20'
      ]"
    >
      <sidebar-item
        v-for="(child, index) in item.children"
        :key="index"
        :item="child"
        :depth="depth + 1"
        :bn-class="bnClass"
      />
    </ul>
  </li>
</template>

<script setup>
import { ref, computed } from 'vue';
import ChevronIcon from './ChevronIcon.vue';

// Props
const props = defineProps({
  item: {
    type: Object,
    required: true
  },
  depth: {
    type: Number,
    default: 0
  },
  bnClass: {
    type: String,
    default: ''
  }
});

// Data
const localIsOpen = ref(false);

// Computed
const hasChildren = computed(() => props.item.children && props.item.children.length > 0);

const isOpen = computed({
  get: () => localIsOpen.value,
  set: (value) => {
    localIsOpen.value = value;
  }
});

const paddingClass = computed(() => `pl-${2 + props.depth * 3}`);

// Methods
const toggleOpen = (e) => {
  // If the item has children, toggle the state on click
  if (hasChildren.value) {
    e.preventDefault();
    isOpen.value = !isOpen.value;
  }
};

// Desktop Flyout Handlers (Hover)
const handleMouseEnter = () => {
  if (hasChildren.value) { 
    isOpen.value = true;
  }
};

const handleMouseLeave = () => {
  if (hasChildren.value) {
    isOpen.value = false;
  }
};
</script>