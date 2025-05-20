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
          <NavLink :href="route('dashboard')" :active="route().current('dashboard')" :icon="HomeIcon">Dashboard</NavLink>
          <NavLink :href="route('users.index')" :active="route().current('users.*')" :icon="UsersIcon">Users</NavLink>
          <NavLink :href="route('roles.index')" :active="route().current('roles.*')" :icon="KeyIcon">Roles</NavLink>
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
        <div class="flex items-center justify-between md:justify-end p-4 bg-white border-b">
          <button @click="toggleSidebar" class="md:hidden text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>

          <!-- Settings Dropdown -->
          <div class="ms-3 relative">
              <Dropdown align="right" width="48">
                  <template #trigger>
                      <span class="inline-flex rounded-md">
                          <button
                              type="button"
                              class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                          >
                              {{ $page.props.auth.user.name }}

                              <svg
                                  class="ms-2 -me-0.5 h-4 w-4"
                                  xmlns="http://www.w3.org/2000/svg"
                                  viewBox="0 0 20 20"
                                  fill="currentColor"
                              >
                                  <path
                                      fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"
                                  />
                              </svg>
                          </button>
                      </span>
                  </template>

                  <template #content>
                      <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                      <DropdownLink :href="route('logout')" method="post" as="button">Logout</DropdownLink>
                  </template>
              </Dropdown>
          </div>
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
  import Dropdown from '@/Components/Dropdown.vue';
  import DropdownLink from '@/Components/DropdownLink.vue';
  import NavLink from '@/Components/NavLink.vue';
  import { HomeIcon, UsersIcon, KeyIcon } from '@heroicons/vue/24/outline'

  const sidebarOpen = ref(false);
  
  const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
  };
  
  const closeSidebar = () => {
    sidebarOpen.value = false;
  };
</script>
  