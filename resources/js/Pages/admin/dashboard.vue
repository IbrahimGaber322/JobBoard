<template>
    <div class="container mx-auto">
      <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>
  
      <div class="grid grid-cols-2 gap-4">
        <!-- Total Users -->
        <div @click="redirectTouserCounts" class="bg-indigo-200 rounded-lg shadow-md p-6 cursor-pointer">
          <h2 class="text-xl font-semibold mb-4">Total Users</h2>
          <p class="text-gray-700">{{ totalUsers }}</p>
        </div>
  
        <!-- Total Job Postings -->
        <div @click="redirectToJobPostingsDash" class="bg-red-200 rounded-lg shadow-md p-6 cursor-pointer">
          <h2 class="text-xl font-semibold mb-4">Total Job Postings</h2>
          <p class="text-gray-700">{{ totalJobs }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      totalUsers: {
        type: Number,
        required: true
      },
      totalJobs: {
        type: Number,
        required: true
      }
    },
    methods: {
      redirectToJobPostingsDash() {
        window.location.href = '/admin/job-postings-dashboard';
      },
      redirectTouserCounts() {
        window.location.href = '/admin/user-counts';
      }
    }
  };
  </script>
  