<template>
    <div class="container mx-auto">
      <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>
      
      <div class="grid grid-cols-2 gap-4">
        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold mb-4">Total Users</h2>
          <p class="text-gray-700">{{ totalUsers }}</p>
        </div>
  
        <!-- Accepted Job Postings -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold mb-4">Accepted Job Postings</h2>
          <p class="text-gray-700">{{ acceptedJobPostings }}</p>
        </div>
  
        <!-- Pending Job Postings -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold mb-4">Pending Job Postings</h2>
          <p class="text-gray-700">{{ pendingJobPostings }}</p>
        </div>
  
        <!-- Rejected Job Postings -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold mb-4">Rejected Job Postings</h2>
          <p class="text-gray-700">{{ rejectedJobPostings }}</p>
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
      acceptedJobPostings: {
        type: Number,
        required: true
      },
      pendingJobPostings: {
        type: Number,
        required: true
      },
      rejectedJobPostings: {
        type: Number,
        required: true
      }
    }
  }
  </script>
  
  <style>
  /* Add your custom styles here */
  </style>
  