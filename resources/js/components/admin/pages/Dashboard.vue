<template>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Stats Card 1 -->
    <div class="bg-white p-6 rounded-lg shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500 uppercase">Total Students</p>
          <h3 class="text-2xl font-bold text-gray-800">1,234</h3>
        </div>
        <div class="p-3 bg-blue-100 rounded-full text-blue-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </div>
      </div>
    </div>

    <!-- Stats Card 2 -->
    <div class="bg-white p-6 rounded-lg shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500 uppercase">Pending Applications</p>
          <h3 class="text-2xl font-bold text-gray-800">56</h3>
        </div>
        <div class="p-3 bg-yellow-100 rounded-full text-yellow-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
        </div>
      </div>
    </div>

    <!-- Stats Card 3 -->
    <div class="bg-white p-6 rounded-lg shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500 uppercase">Total Notices</p>
          <h3 class="text-2xl font-bold text-gray-800">12</h3>
        </div>
        <div class="p-3 bg-green-100 rounded-full text-green-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
          </svg>
        </div>
      </div>
    </div>

    <!-- Stats Card 4 -->
    <div class="bg-white p-6 rounded-lg shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500 uppercase">Gallery Items</p>
          <h3 class="text-2xl font-bold text-gray-800">45</h3>
        </div>
        <div class="p-3 bg-purple-100 rounded-full text-purple-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Dashboard'
}
</script>