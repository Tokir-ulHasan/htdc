<template>
  <div ref="root" class="relative">
    <button
      type="button"
      :disabled="disabled"
      @click="toggle"
      class="w-full border rounded px-3 py-2 text-left flex items-center justify-between"
      :class="[error ? 'border-red-500' : 'border-green-600', (!modelValue ? 'text-gray-400' : 'text-black')]"
    >
      <span>{{ displayLabel }}</span>
      <ChevronDownIcon
        class="w-5 h-5 text-gray-500 transition-transform"
        :class="open ? 'rotate-180' : ''"
      />
    </button>
    <div
      v-if="open"
      class="absolute z-10 mt-1 w-full bg-white border border-green-600 rounded shadow-sm"
    >
      <div class="p-2 border-b border-gray-200">
        <input
          type="text"
          v-model="query"
          class="w-full border border-gray-300 rounded px-2 py-1 text-sm"
          placeholder="Search..."
        />
      </div>
      <ul class="max-h-60 overflow-auto">
        <li
          v-for="(opt, i) in filteredOptions"
          :key="String(opt.value)"
          @mouseenter="hoverIndex = i"
          @mouseleave="hoverIndex = -1"
          @click="!opt.disabled && select(opt.value)"
          class="px-3 py-2 cursor-pointer"
          :class="[
            opt.disabled ? 'opacity-50 cursor-not-allowed' : '',
            (hoverIndex === i || modelValue === opt.value) ? 'bg-ddPrimary-100 text-white' : 'bg-white text-black'
          ]"
        >
          {{ opt.label }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { ChevronDownIcon } from '@heroicons/vue/24/outline'

const props = defineProps({
  modelValue: {
    type: [String, Number],
    default: ''
  },
  options: {
    type: Array,
    default: () => []
  },
  placeholder: {
    type: String,
    default: 'Select...'
  },
  disabled: {
    type: Boolean,
    default: false
  },
  error: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits(['update:modelValue'])

const open = ref(false)
const hoverIndex = ref(-1)
const root = ref(null)
const query = ref('')

const normalizedOptions = computed(() => {
  return props.options.map(o => {
    if (typeof o === 'string' || typeof o === 'number') {
      return { label: String(o), value: o, disabled: false }
    }
    return { label: o.label, value: o.value, disabled: !!o.disabled }
  })
})

const filteredOptions = computed(() => {
  const q = query.value.trim().toLowerCase()
  if (!q) return normalizedOptions.value
  return normalizedOptions.value.filter(o => o.label.toLowerCase().includes(q))
})

const displayLabel = computed(() => {
  const found = normalizedOptions.value.find(o => o.value === props.modelValue)
  return found ? found.label : props.placeholder
})

const toggle = () => {
  if (props.disabled) return
  open.value = !open.value
}

const select = (val) => {
  emit('update:modelValue', val)
  open.value = false
}

const handleClickOutside = (e) => {
  if (root.value && !root.value.contains(e.target)) {
    open.value = false
  }
}

onMounted(() => {
  document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside)
})
</script>
