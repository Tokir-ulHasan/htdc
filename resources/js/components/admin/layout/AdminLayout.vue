<template>
  <div class="min-h-screen bg-gray-100 flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white min-h-screen flex-shrink-0">
      <div class="p-4 border-b border-gray-700">
        <h1 class="text-xl font-bold">Admin Panel</h1>
      </div>
      <nav class="mt-4">
        <router-link to="/admin/dashboard" class="block py-2 px-4 hover:bg-gray-700" :class="{ 'bg-gray-700': $route.path === '/admin/dashboard' }">
          Dashboard
        </router-link>
        <router-link to="/admin/notices" class="block py-2 px-4 hover:bg-gray-700" :class="{ 'bg-gray-700': $route.path === '/admin/notices' }">
          Notices
        </router-link>
        <router-link to="/admin/students" class="block py-2 px-4 hover:bg-gray-700" :class="{ 'bg-gray-700': $route.path === '/admin/students' }">
          Students
        </router-link>
        <router-link to="/admin/gallery" class="block py-2 px-4 hover:bg-gray-700" :class="{ 'bg-gray-700': $route.path === '/admin/gallery' }">
          Gallery
        </router-link>
      </nav>
      <div class="absolute bottom-0 w-64 p-4 border-t border-gray-700">
        <button @click="logout" class="w-full text-left py-2 px-4 hover:bg-gray-700 text-red-400">
          Logout
        </button>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
      <header class="bg-white shadow p-4 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-800">{{ $route.name }}</h2>
        <div class="flex items-center">
          <span class="mr-2">Admin</span>
          <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
        </div>
      </header>
      <div class="p-6">
        <router-view></router-view>
      </div>
    </main>
  </div>
</template>

<script>
import { useRouter } from 'vue-router';
import axios from 'axios';

export default {
  setup() {
    const router = useRouter();

    const logout = async () => {
      try {
        await axios.post('/logout');
        router.push('/login');
      } catch (error) {
        console.error('Logout failed', error);
        router.push('/login'); // Force redirect even if API fails
      }
    };

    return {
      logout
    };
  }
}
</script>