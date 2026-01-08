<template>
  <!-- Mobile sidebar overlay -->
  <div v-if="isOpen" class="fixed inset-0 z-40 lg:hidden" @click="closeSidebar">
    <div class="fixed inset-0 bg-black bg-opacity-25"></div>
  </div>

  <!-- Sidebar -->
  <aside :class="[base, sidebarClass]">
    <div class="flex items-center justify-between p-4 border-b">
      <h2 class="text-lg font-bold text-gray-800">Menu</h2>
      <button 
        v-if="isOpen" 
        @click="closeSidebar" 
        class="lg:hidden text-gray-500 hover:text-gray-700"
        aria-label="Close sidebar"
      >
        ✕
      </button>
    </div>
    <ul class="divide-y divide-gray-200 p-2">
      <sidebar-item
        v-for="(item, index) in sidebarData"
        :key="index"
        :item="item"
        :depth="0"
        :bn-class="bnClass"
      />
    </ul>
  </aside>
</template>

<script setup>
import { computed, ref, defineExpose } from 'vue';
import SidebarItem from './SidebarItem.vue';

// Props
const props = defineProps({
  currentRoute: {
    type: String,
    default: '/'
  }
});

// State
const isOpenState = ref(false);

// Methods
const toggleSidebar = () => {
  isOpenState.value = !isOpenState.value;
};

const closeSidebar = () => {
  isOpenState.value = false;
};

// Computed properties
const isOpen = computed(() => isOpenState.value);

const sidebarClass = computed(() => {
  return [
    'bg-white text-sm fixed lg:static z-50 h-full',
    isOpen.value ? 'left-0 w-64' : '-left-64 lg:left-0 lg:w-60',
    'top-0 lg:top-auto',
    'transition-all duration-300 ease-in-out',
    'border-r',
    isOpen.value ? 'block' : 'hidden lg:block'
  ];
});

defineExpose({
  toggleSidebar,
  closeSidebar,
  isOpen
});

const bnClass = computed(() => ''); // No language support in this version

const base = 'bg-white text-sm';

// Data structure
const sidebarData = [
  { label: 'About College', href: '#', children: [
    { label: 'About Us', href: '/about' },
    { label: 'At A Glance', href: 'at_a_Glance.php' },
  ]},
  { label: 'Academic', href: '#', children: [
    { label: 'Admission', href: '/apply' },
    { label: 'Principal List', href: 'principle_list.php' },
    { label: 'Vice Principal List', href: 'vice_principle_list.php' },
    { label: 'GB', href: 'governing_board.php' },
  ]},
  { label: 'Department', href: '#', children: [
    { label: 'HSC', href: '#', children: [ // Nested Level 3
      { label: 'Science', href: 'science.php' },
      { label: 'Business Studies', href: 'businessStudies.php' },
      { label: 'Humanities', href: 'humanities.php' },
    ]},
    { label: 'Honours', href: '#', children: [
      { label: 'Accounting', href: 'accounting.php' },
      { label: 'Management', href: 'management.php' },
      { label: 'Economics', href: 'economics.php' },
    ]},
    { label: 'DEGREE', href: '#', children: [
      { label: 'BA', href: 'bA.php' },
      { label: 'BBS', href: 'BBS.php' },
      { label: 'BSS', href: 'BSS.php' },
    ]},
  ]},
  { label: 'Facilities', href: '#', children: [
    { label: 'Digital Content', href: 'digital_content_video.php' },
    { label: 'Multimedia Classroom', href: 'multimediaClassroom.php' },
    { label: 'Central Library', href: 'centralLibrary.php' },
    { label: 'ICT Lab', href: 'ictLab.php' },
    { label: 'Wi-Fi', href: 'wifi.php' },
    { label: 'Rover Scout', href: 'roverScout.php' },
    { label: 'BNCC', href: 'bncc.php' },
    { label: 'Red Crescent', href: 'redCrescent.php' },
    { label: 'Science Lab', href: 'scienceLab.php' },
  ]},
  { label: 'Teacher Information', href: '#', children: [
    { label: 'Teacher Information', href: 'teacherInformation.php' },
    { label: 'Teacher Vacant Post', href: 'teacherVacantPost.php' },
    { label: "Teacher's Panel", href: '#' },
  ]},
  { label: 'Staff information', href: '#', children: [
    { label: 'Staff information', href: 'staffInformation.php' },
    { label: 'Staff Vacant Post', href: 'staffVacantPost.php' },
  ]},
  { label: 'Student Information', href: '#', children: [
    { label: "Student's Details", href: 'studentsDetails.php' },
    { label: "Student's Panel", href: '#' },
    { label: "Guardian's Panel", href: '#' },
  ]},
  { label: 'Activity', href: '#', children: [
    { label: 'Class Routine', href: 'classRoutine.php' },
    { label: 'Academic Calender', href: 'academicCalender.php' },
    { label: 'Exam Routine', href: 'examRoutine.php' },
    { label: 'Yearly Holidays List', href: 'yearlyHolidaysList.php' },
    { label: 'Testimonial and TC', href: '#' },
  ]},
  { label: 'Archive', href: '#', children: [
    { label: 'Ex. Teacher List', href: 'exTeacherList.php' },
    { label: 'Ex. Student List', href: 'exStudentList.php' },
    { label: 'Magazine', href: 'magazine.php' },
    { label: 'Three Years Public Exam Result', href: 'threeYearsPublicExamResult.php' },
  ]},
  { label: 'Feedback', href: '/feedback' },
];
</script>