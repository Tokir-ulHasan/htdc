<template>
  <div>
    <!-- Top Bar -->
    <top-bar></top-bar>

    <!-- Navigation Bar -->
    <nav-bar 
      :set-sidebar-open="setSidebarOpen"
    ></nav-bar>

    <!-- Main Content Area with Sidebar -->
    <div class="flex flex-col lg:flex-row">
      <!-- Sidebar -->
      <sidebar-component ref="sidebar" :current-route="currentRoute"></sidebar-component>

      <!-- Main Content -->
      <main class="flex-grow min-h-screen">
        <div class="container mx-auto px-4 py-6">
          <slot></slot>
        </div>
      </main>
    </div>

    <!-- Footer -->
    <footer-component></footer-component>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import TopBar from './TopBar.vue';
import NavBar from './NavBar.vue';
import SidebarComponent from './SideBar.vue';
import FooterComponent from './Footer.vue';

const sidebar = ref(null);
const currentRoute = ref(window.location.pathname);
const showMobileNav = ref(false);

const setSidebarOpen = (callback) => {
  if (sidebar.value) {
    const currentOpen = sidebar.value.isOpen; // sidebar has an isOpen property
    const newValue = typeof callback === 'function' ? callback(currentOpen) : callback;
    // Call the toggle method on the sidebar component
    if (typeof newValue === 'boolean' && newValue !== currentOpen) {
      sidebar.value.toggleSidebar();
    } else if (typeof newValue === 'function') {
      // If callback is a function, we execute it with current value
      const result = callback(currentOpen);
      if (result !== currentOpen) {
        sidebar.value.toggleSidebar();
      }
    }
  }
};

const toggleSidebar = () => {
  if (sidebar.value) {
    sidebar.value.toggleSidebar();
  }
};

const toggleMobileNav = () => {
  showMobileNav.value = !showMobileNav.value;
};

// Update current route when URL changes (for SPA behavior if needed)
onMounted(() => {
  // For now, just use the current path, but in a full SPA you would watch for route changes
  window.addEventListener('popstate', () => {
    currentRoute.value = window.location.pathname;
  });
});
</script>
