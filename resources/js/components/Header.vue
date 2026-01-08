<template>
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="./" class="text-xl font-bold text-green-500">MyApp</a>
                
                <button class="md:hidden text-gray-500 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                
                <div class="hidden md:flex space-x-8">
                    <a href="./" class="text-green-500 hover:text-red-700 transition-colors duration-300">Home</a>
                    <a href="about" class="text-gray-600 hover:text-green-500 transition-colors duration-300">About</a>
                    <a href="contact" class="text-gray-600 hover:text-green-500 transition-colors duration-300">Contact</a>
                    <template v-if="!isLoggedIn">
                        <a href="login" class="text-gray-600 hover:text-green-500 transition-colors duration-300">Login</a>
                        <a href="register" class="text-gray-600 hover:text-green-500 transition-colors duration-300">Register</a>
                    </template>
                    <template v-else>
                        <a href="#" class="text-gray-600 hover:text-green-500 transition-colors duration-300" @click.prevent="logout">Logout</a>
                    </template>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
    name: 'HeaderComponent',
    setup() {
        const isLoggedIn = ref(false);
        
        onMounted(() => {
            // Check if user is logged in by checking for auth token in localStorage
            const token = localStorage.getItem('auth_token');
            if (token) {
                isLoggedIn.value = true;
            }
        });
        
        const logout = () => {
            // Remove auth token from localStorage
            localStorage.removeItem('auth_token');
            isLoggedIn.value = false;
            // Redirect to home or login page
            window.location.href = './';
        };
        
        return {
            isLoggedIn,
            logout
        };
    }
};
</script>

<style scoped>
/* All styles are now handled by Tailwind CSS */
</style>
