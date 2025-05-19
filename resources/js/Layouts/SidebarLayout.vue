<!-- src/Layouts/SidebarLayout.vue -->
<template>
    <div class="min-h-screen flex flex-col md:flex-row" :class="{ 'overflow-hidden': sidebarOpen }">
      <!-- Sidebar -->
      <div
        class="fixed inset-y-0 left-0 z-50 w-64 bg-gray-800 text-white transform md:relative md:translate-x-0 transition-transform duration-300 ease-in-out"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
      >
        <div class="flex items-center justify-between px-4 py-4 border-b border-gray-700 md:hidden">
          <span class="font-bold text-lg">MyApp</span>
          <button @click="toggleSidebar" class="text-white">
            ✕
          </button>
        </div>
        <div class="hidden md:block px-4 py-4 font-bold text-xl border-b border-gray-700">MyApp</div>
        <nav class="mt-4 space-y-2 px-4">
          <a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Dashboard</a>
          <a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Users</a>
          <a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Settings</a>
        </nav>
      </div>
  
      <!-- Overlay (mobile only) -->
      <div
        v-if="sidebarOpen"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
        @click="closeSidebar"
      ></div>
  
      <!-- Main content -->
      <div class="flex-1 flex flex-col min-h-screen">
        <!-- Top bar -->
        <div class="md:hidden flex items-center justify-between p-4 bg-white border-b">
          <button @click="toggleSidebar" class="text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          <h1 class="font-bold text-lg">Dashboard</h1>
        </div>
  
        <!-- Slot for child content -->
        <main class="flex-1 p-6 bg-gray-100">
          <slot />
        </main>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  
  const sidebarOpen = ref(false);
  
  const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
  };
  
  const closeSidebar = () => {
    sidebarOpen.value = false;
  };
  </script>
  