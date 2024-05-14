<template>
    <div>
      <!-- Notification Icon -->
      <div class="text-white relative">
        <svg @click="showNotifications = !showNotifications" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
        </svg>
        <div v-show="showNotifications" class="absolute top-0 right-0 bg-white rounded-full h-4 w-4 flex justify-center items-center text-xs text-red-500">{{ notifications.length }}</div>
      </div>
  
      <!-- Notifications Panel -->
      <div v-show="showNotifications" class="absolute top-0 right-0 bg-white rounded shadow-md mt-12 p-4 w-64">
        <div v-for="notification in notifications" :key="notification.id" class="mb-2">
          {{ notification.data.message }}
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        showNotifications: false,
        notifications: []
      }
    },
    mounted() {
      this.fetchNotifications();
    },
    methods: {
      fetchNotifications() {
        axios.get('/admin/notifications') // Adjust this endpoint according to your Laravel route
          .then(response => {
            this.notifications = response.data;
          })
          .catch(error => {
            console.error('Error fetching notifications:', error);
          });
      }
    }
  }
  </script>
  