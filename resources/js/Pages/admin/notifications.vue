<template>
  <div>
    <Navbar/>
    <div class="relative bg-gradient-to-r from-white-600 to-blue-500">
      <div class="absolute bg-blue-600 rounded-full w-48 h-48 -top-16 -left-16 mix-blend-multiply opacity-50"></div>
      <div class="absolute bg-blue-500 w-64 h-64 transform rotate-45 -bottom-16 -right-32 mix-blend-multiply opacity-50"></div>
      <div class="absolute bg-blue-700 w-96 h-32 -bottom-8 -right-16 mix-blend-multiply opacity-50"></div>
      <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold mt-3 mb-3 text-blue-900 text-center">Notifications</h1>
        <ul class="list-none">
          <li v-for="(notification, index) in notifications" :key="index" class="flex items-center justify-between bg-gray-100 rounded-lg p-4 shadow-sm mb-2">
            <div class="flex items-center mr-4">
              <div :class="{ 'bg-blue-500': notification.read, 'bg-blue-700': !notification.read }" class="w-4 h-4 rounded-full"></div>
              <span class="ml-2">{{ notification }}</span>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import Navbar from './Navbar.vue';

export default {
  components: {
    Navbar
  },
  props: {
    notifications: {
      type: Array,
      required: true
    }
  }
}
</script>
