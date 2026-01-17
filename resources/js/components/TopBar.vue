<template>
  <!-- Tailwind CSS classes used in this component: text-red-500, bg-green-900, text-white -->
  <div class="topbar-bg text-white relative " :style="{ backgroundImage: `url('${computePublicUrl('images/Bannerbuilding.jpeg')}')` }">
    <!-- center column: logo + title centered -->
    <div class="topbar-bg-inner flex items-center sm:justify-start md:justify-center  gap-6 sm:items-start pb-2 pt-3">
        <img 
        :src="computePublicUrl('images/logo.svg')" 
        alt="Hazera-Taju logo" 
        class="h-14 w-14 md:h-32 md:w-36 lg:h-32 lg:w-36" 
        />
        <div class="md:mr-5">
            <p class="bn-font bn-text-stroke text-2xl sm:text-4xl md:text-5xl lg:text-6xl">
                {{ bntitle }}
            </p>
            <p class="text-white  text-base sm:text-xl md:text-2xl text-center font-bold text-stroke " style="webkit-text-stroke: 1px black;">
                {{ title }}
            </p>
        </div>
    </div>
    <!-- right column: slogan + apply button -->
    <div class="absolute bottom-1 right-1 flex flex-col items-end">
        <div class="text-[0.8em] sm:text-[0.75em] opacity-90  mb-2">
        <span class="ml-1 bg-ddPrimary-200">
          <span class="cursor text-lg font-bold " :class="{ 'cursor-blink ': showCursor }">|</span><span class="">{{ displayedText }}</span>
        </span>
        </div>
        <div>
        <a 
            href="student/apply" 
            class="bg-ddPrimary-200  text-sm  px-2 hover:bg-ddPrimary-100 rounded-full hover:opacity-90"
        >
            Apply Application
        </a>
        </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue'

// Logic constants
const title = 'Hazera-Taju Degree College'
const bntitle = 'হাজেরা-তজু ডিগ্রী কলেজ'
const sloganText = 'A NON POLITICAL INSTITUE'

// State
const charIndex = ref(0)
const isDeleting = ref(false)
const pause = ref(false)
const showCursor = ref(true)
let timeoutId = null
let cursorInterval = null

// Computed property for the displayed text
const displayedText = computed(() => {
  if (isDeleting.value) {
    // When deleting, remove from the left by showing the remaining text after the deleted portion
    return sloganText.substring(charIndex.value)
  } else {
    // When typing, show the text up to the current index
    return sloganText.substring(0, charIndex.value)
  }
})

function computePublicUrl(p) {
  const segments = window.location.pathname.split('/').filter(Boolean);
  const base = segments[0] && segments[0].toLowerCase() === 'htdc' ? `/${segments[0]}` : '';
  return `${base}/${p}`;
}
const handleTyping = () => {
  if (pause.value) return

  const speed = isDeleting.value ? 50 : 120

  timeoutId = setTimeout(() => {
    if (!isDeleting.value) {
      // Typing - add characters from left to right
      charIndex.value++
      
      if (charIndex.value === sloganText.length) {
        pause.value = true
        setTimeout(() => {
          isDeleting.value = true
          pause.value = false
          charIndex.value = 0; // Start deleting from the beginning
          handleTyping()
        }, 1000)
        return // Exit to let the nested timeout handle the next step
      }
    } else {
      // Deleting - remove characters from left to right
      charIndex.value++
      
      if (charIndex.value >= sloganText.length) {
        pause.value = true
        setTimeout(() => {
          isDeleting.value = false
          pause.value = false
          charIndex.value = 0
          handleTyping()
        }, 500)
        return
      }
    }
    handleTyping() // Recursive call for next character
  }, speed)
}

onMounted(() => {
  // Start the typing animation
  handleTyping()
  
  // Start cursor blinking
  cursorInterval = setInterval(() => {
    showCursor.value = !showCursor.value;
  }, 530); // Blink every 530ms for a natural typing effect
  
  // Cursor will be shown during typing and deletion by the handleTyping function
  // Start with no text and no cursor initially
  showCursor.value = false;
})

onUnmounted(() => {
  if (timeoutId) clearTimeout(timeoutId)
  if (cursorInterval) clearInterval(cursorInterval)
})
</script>

<style scoped>
/* Add any specific animations or fonts here */
.topbar-bg {
  background-size: 100% 350%;
  background-repeat: no-repeat;
  background-position: center ;
  background-color: transparent;
}
.topbar-bg-inner{
  background-image: radial-gradient(circle at center, rgba(0,87,67,0.83) 0%, rgba(0,24,7,0.95) 70%);
  height: 100%;
}


.bn-text-stroke {
    text-shadow: 1px 2px 0 #000, -2px 0 0 #000000, 2px 1px 0 #000, 3px -2px 0 #000;
}

.cursor {
  animation: blink 1s infinite;
  
  /* Make cursor bolder and bigger */
  font-weight: bold;
  font-size: 1.2em;
}

.cursor-blink {
  animation: blink 1s infinite;
}

@keyframes blink {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0;
  }
}

/* Ensure text remains white */

@media (max-width: 767px) {
  .topbar-bg {
    /* Slightly larger on mobile so it remains visible */
    background-size: 80% auto;
    background-repeat: no-repeat;
    background-position: center center;
    background-color: transparent;
  }
  .topbar-bg-inner {
    justify-content: flex-start !important;
    padding-left: 1rem;
  }
}

</style>
