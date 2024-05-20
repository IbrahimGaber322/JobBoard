<template>
  <nav class="bg-blue-800 p-4 flex justify-between items-center relative z-10">
    <div class="flex items-center">
      <div class="text-white font-bold text-xl mr-4"><a href="/admin">Admin Panel</a></div>
      <div class="dropdown-container">
        <button class="text-white font-bold text-xl mr-4 focus:outline-none" @click="toggleDropdownEmp">
          Users
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl" v-if="showDropdownEmp">
          <a @click="redirectToEmployeeJobStatistics" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">Employers</a>
          <a @click="redirectToCandidateApplications" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">Candidates</a>
        </div>
      </div>
      <div class="dropdown-container">
        <button class="text-white font-bold text-xl mr-4 focus:outline-none" @click="toggleDropdown">
          Jobs
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </button>
        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl" v-if="showDropdown">
          <a @click="redirectToJobPostings" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">Pending Jobs</a>
          <a @click="redirectToAcceptedJobPostings" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">Approved Jobs</a>
          <a @click="redirectToRejectedJobPostings" class="block px-4 py-2 text-gray-800 hover:bg-blue-500 hover:text-white">Rejected Jobs</a>
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
      showDropdown: false,
      showDropdownEmp: false
    };
  },
  created() {
    this.fetchNotificationCount();
    this.pollNotifications();
  },
  methods: {
    toggleDropdown() {
      this.showDropdown = !this.showDropdown;
    },
    toggleDropdownEmp() {
      this.showDropdownEmp = !this.showDropdownEmp;
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
      setInterval(() => {
        this.fetchNotificationCount();
      }, 3000);
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
      axios.post('/logout')
        .then(() => {
          window.location.href = '/';
        })
        .catch(error => {
          console.error('Error logging out:', error);
        });
    },redirectToEmployeeJobStatistics() {
      this.$inertia.visit('/admin/employee-job-statistics');
    },
    redirectToCandidateApplications() {
      this.$inertia.visit('/admin/candidate-applications');
    }
  }
}
</script>

<style>
.dropdown-container {
  position: relative;
  margin-right: 20px;
}
.notification-counter {
  background-color: #e53e3e;
  color: white;
  font-size: 0.5rem;
  padding: 0.1rem 0.4rem;
  border-radius: 999px;
  position: absolute;
  top: -0.5rem;
  right: -0.5rem;
}
</style>
