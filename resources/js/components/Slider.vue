<template>
  <div v-if="images && images.length > 0" class="relative w-full overflow-hidden rounded shadow group">
    <div 
      class="flex transition-transform duration-500" 
      :style="{ transform: `translateX(-${currentIndex * 100}%)` }"
    >
      <div 
        v-for="(item, i) in images" 
        :key="i" 
        class="flex-shrink-0 w-full"
      >
        <div>
          <a 
            v-if="getImageLink(item)" 
            :href="getImageLink(item)" 
            target="_blank" 
            rel="noopener noreferrer"
          >
            <div class="relative">
              <img 
                :src="getImageSrc(item)" 
                :alt="`slide-${i}`" 
                class="w-full h-56 md:h-72 object-cover" 
              />
              <div 
                v-if="getImageTitle(item)" 
                class="absolute bottom-0 left-0 right-0 bg-black/50 text-white p-2 text-center"
              >
                {{ getImageTitle(item) }}
              </div>
            </div>
          </a>
          <div v-else class="relative">
            <img 
              :src="getImageSrc(item)" 
              :alt="`slide-${i}`" 
              class="w-full h-56 md:h-72 object-cover" 
            />
            <div 
              v-if="getImageTitle(item)" 
              class="absolute bottom-0 left-0 right-0 bg-black/50 text-white p-2 text-center"
            >
              {{ getImageTitle(item) }}
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Prev/Next -->
    <button 
      aria-label="Prev" 
      @click="prevSlide" 
      class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/40 text-white rounded-full p-2"
    >
      ‹
    </button>
    <button 
      aria-label="Next" 
      @click="nextSlide" 
      class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/40 text-white rounded-full p-2"
    >
      ›
    </button>

    <!-- Dots -->
    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2">
      <button
        v-for="(item, i) in images"
        :key="i"
        @click="goToSlide(i)"
        :class="[
          'w-2 h-2 rounded-full',
          i === currentIndex ? 'bg-white' : 'bg-white/60'
        ]"
      ></button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';

// Props
const props = defineProps({
  images: {
    type: Array,
    default: () => []
  }
});

// Data
const currentIndex = ref(0);
let intervalId = null;

// Computed
const hasImages = computed(() => props.images && props.images.length > 0);

// Methods
const computePublicUrl = (p) => {
  if (!p) return '';
  let path = String(p).replace(/^\/+/, '');
  // If absolute URL or data URL, return as-is
  if (/^(https?:)?\/\//i.test(p) || /^data:/i.test(p)) return p;
  const needsPublic = window.location.pathname.includes('/index.php');
  if (needsPublic && !/^public\//.test(path)) {
    path = `public/${path}`;
  }
  try {
    return new URL(path, document.baseURI).href;
  } catch {
    const meta = document.querySelector('meta[name="base-url"]');
    const base = meta ? meta.getAttribute('content') || '' : '';
    const normalizedBase = base.replace(/\/+$/, '');
    return `${normalizedBase}/${path}`;
  }
};

const getImageSrc = (item) => {
  const src = typeof item === 'string' ? item : item.image;
  return computePublicUrl(src);
};

const getImageTitle = (item) => {
  return typeof item === 'object' ? item.title : null;
};

const getImageLink = (item) => {
  return typeof item === 'object' ? item.link : null;
};

const nextSlide = () => {
  currentIndex.value = (currentIndex.value + 1) % props.images.length;
};

const prevSlide = () => {
  currentIndex.value = (currentIndex.value - 1 + props.images.length) % props.images.length;
};

const goToSlide = (index) => {
  currentIndex.value = index;
};

// Lifecycle
onMounted(() => {
  if (props.images.length > 0) {
    intervalId = setInterval(() => {
      nextSlide();
    }, 4000);
  }
});

onUnmounted(() => {
  if (intervalId) {
    clearInterval(intervalId);
  }
});
</script>
