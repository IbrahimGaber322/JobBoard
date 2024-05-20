<template>
  
<nav class="bg-blue-800 p-4 flex justify-between items-center relative z-10">
  <div class="flex items-center">
  <div class="text-white font-bold text-xl mr-4"><a href="/admin">Admin Panel</a></div>
  <div class="relative">
    <button class="text-white font-bold text-xl mr-4 focus:outline-none" @click="toggleDropdown">
      Jobs
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
      </svg>
    </button>
    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl" v-if="showDropdown">
      <a @click="redirectToJobPostings" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">Pending Jobs</a>
      <a  @click="redirectToAcceptedJobPostings" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">Approved Jobs</a>
      <a  @click="redirectToRejectedJobPostings" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">Rejected Jobs</a>
    </div>
  </div>
</div>

    <div class="flex items-center">
        <div class="text-white relative mr-4">
            <a href="/admin/notifications" class="block">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 8v6a2 2 0 0 1-2 2v0a2 2 0 0 1-2-2v-6m4 0v-2a6 6 0 0 0-12 0v2m4 8h4a1 1 0 0 1 1 1v0a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v0a1 1 0 0 1 1-1z"></path>
                </svg>
                <span v-if="notificationCount > 0" class="notification-counter">{{ notificationCount }}</span>
            </a>
        </div>
        <div class="text-white">
            <svg @click="logout" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
        </div>
    </div>
</nav>

</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      notificationCount: 0,
      showDropdown: false
    };
  },
  created() {
    this.fetchNotificationCount();
    // Start polling for new notifications every 10 seconds
    this.pollNotifications();
  },
  methods: {
    toggleDropdown() {
      this.showDropdown = !this.showDropdown;
    },
    fetchNotificationCount() {
      axios.get('/admin/notifications/count')
        .then(response => {
          this.notificationCount = response.data.count;
        })
        .catch(error => {
          console.error('Error fetching notification count:', error);
        });
    },
    pollNotifications() {
      // Poll for new notifications every 10 seconds
      setInterval(() => {
        this.fetchNotificationCount();
      }, 3000); // 10 seconds in milliseconds
    },
    redirectToJobPostings() {
      window.location.href = '/admin/job-postings';
    },
    redirectToAcceptedJobPostings() {
      window.location.href = '/admin/accepted-job-postings';
    },
    redirectToRejectedJobPostings() {
      window.location.href = '/admin/rejected-job-postings';
    },
    logout() {
      axios.post('/logout') // Assuming you have a logout route
        .then(() => {
          window.location.href = '/'; // Redirect to login page after logout
        })
        .catch(error => {
          console.error('Error logging out:', error);
        });
    }
  }
}
</script>

<style>

.notification-counter {
  background-color: #e53e3e; /* Red color */
  color: white;
  font-size: 0.5rem; /* Make the font size smaller */
  padding: 0.1rem 0.4rem; /* Adjust padding */
  border-radius: 999px; /* Make it rounded */
  position: absolute;
  top: -0.5rem; /* Position it above the icon */
  right: -0.5rem; /* Position it to the right of the icon */
}

</style>