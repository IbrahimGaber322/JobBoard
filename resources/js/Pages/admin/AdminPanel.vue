<template>
    <div class="container mx-auto">
      <h1 class="text-3xl font-bold mb-4">Welcome to Admin Panel</h1>
      <p class="mb-8">This is where you can manage various aspects of your application as an administrator.</p>
      
      <!-- Tailwind CSS cards to display pending job postings -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div v-for="pendingJob in pendingJobPostings" :key="pendingJob.id">
          <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">{{ pendingJob.title }}</h2>
            <p class="text-gray-700 mb-4">{{ pendingJob.desc }}</p>
            <p class="text-gray-700 mb-4">Category: {{ pendingJob.category }}</p>
            <p class="text-gray-700 mb-4">Location: {{ pendingJob.location }}</p>
            <div class="flex justify-between">
              <button @click="approveJob(pendingJob.id)" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded focus:outline-none">Approve</button>
              <button @click="rejectJob(pendingJob.id)" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">Reject</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'AdminPanel',
    props: {
      pendingJobPostings: {
        type: Array,
        default: () => []
      }
    },
    methods: {
      // Method to approve a job posting
      approveJob(jobId) {
        // Implement the logic to approve the job posting
        console.log('Approve job:', jobId);
      },
      // Method to reject a job posting
      rejectJob(jobId) {
        // Implement the logic to reject the job posting
        console.log('Reject job:', jobId);
      }
    }
  }
  </script>
  