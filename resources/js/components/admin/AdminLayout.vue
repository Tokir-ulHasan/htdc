<template>
  <div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <div :class="['bg-gray-800 text-white z-20', sidebarOpen ? 'w-64 fixed inset-y-0 left-0' : 'hidden', 'md:block md:w-64']">
      <div class="p-4 border-b border-gray-700">
        <h1 class="text-xl font-bold">Admin Panel</h1>
      </div>
      <nav class="mt-4">
        <a href="/admin/dashboard" class="block py-2 px-4 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">Dashboard</a>
        <a href="/admin/notices" class="block py-2 px-4 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">Notices</a>
        <a href="/admin/students" class="block py-2 px-4 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">Students</a>
        <a href="/admin/gallery" class="block py-2 px-4 text-gray-300 hover:bg-gray-700 hover:text-white transition-colors">Gallery</a>
        <form method="POST" action="/logout" class="mt-4 px-4">
          <input type="hidden" name="_token" :value="csrf" />
          <button class="w-full text-left py-2 text-red-300 hover:bg-gray-700 hover:text-red-200">Logout</button>
        </form>
      </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Header -->
      <header class="bg-white shadow-sm">
        <div class="flex items-center justify-between p-4">
          <div class="flex items-center">
            <button @click="toggleSidebar" class="mr-4 text-gray-600 focus:outline-none md:hidden">
              <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                <path d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
            </button>
            <h2 class="text-lg font-semibold text-gray-800">Admin</h2>
          </div>
          <div class="flex items-center space-x-4">
            <div class="relative">
              <button class="text-gray-600 focus:outline-none">
                <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                </svg>
              </button>
            </div>
            <div class="relative">
              <button class="flex items-center space-x-2 focus:outline-none">
                <div class="w-8 h-8 rounded-full bg-green-600 flex items-center justify-center text-white font-bold">
                  A
                </div>
                <span class="text-gray-700 hidden md:inline">Admin</span>
              </button>
            </div>
          </div>
        </div>
      </header>

      <!-- Content -->
      <main class="flex-1 overflow-y-auto p-4">
        <slot></slot>
      </main>

      <!-- Footer -->
      <footer class="bg-white border-t p-4">
        <div class="text-center text-gray-600 text-sm">
          &copy; {{ new Date().getFullYear() }} Hazera-Taju Degree College. All rights reserved.
        </div>
      </footer>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AdminLayout',
  data() {
    return {
      sidebarOpen: false,
      csrf: document.querySelector('meta[name=\"csrf-token\"]')?.getAttribute('content') || ''
    };
  },
  methods: {
    toggleSidebar() {
      this.sidebarOpen = !this.sidebarOpen;
    }
  }
};
</script>
