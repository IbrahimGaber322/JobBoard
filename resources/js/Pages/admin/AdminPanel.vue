<template>
    <div class="container mx-auto">
      <h1 class="text-3xl font-bold mb-4">Welcome to Admin Panel</h1>
      <p class="mb-8">This is where you can manage various aspects of your application as an administrator.</p>
  
      <!-- Link to Pending Job Postings page -->
      <button @click="redirectToJobPostings" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
  View Pending Job Postings
</button>

<button @click="redirectToAcceptedJobPostings" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
  View Accepted Job Postings
</button>
<button @click="redirectToRejectedJobPostings" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
  View Rejected Job Postings
</button>
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
  <script>export default {
    methods: {
      redirectToJobPostings() {
        window.location.href = '/admin/job-postings';
      },
      redirectToAcceptedJobPostings(){
        window.location.href = '/admin/accepted-job-postings';

      },
      redirectToRejectedJobPostings(){
        window.location.href = '/admin/rejected-job-postings';

      },
      
    }
  }
  </script>