<template>
    <div class="container mx-auto">
      <h1 class="text-3xl font-bold mb-4">Pending Job Postings</h1>
      
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
    name: 'JobPostings',
    props: {
      pendingJobPostings: {
        type: Array,
        default: () => []
      }
    },
    methods: {
      // Method to approve a job posting
      async approveJob(jobId) {
        try {
          // Send a POST request to approve the job posting to the appropriate Laravel route
          const response = await fetch(`/admin/job-postings/approve`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              // Add any additional headers if needed
            },
            body: JSON.stringify({ job_id: jobId })
          });
  
          // Log the response status and data
          console.log('Response status:', response.status);
          const responseData = await response.json();
          console.log('Response data:', responseData);
  
          if (!response.ok) {
            throw new Error('Failed to approve job');
          }
  
          // Assuming the request was successful, update the UI or perform any additional actions
  
          console.log('Job approved:', jobId);
        } catch (error) {
          console.error('Error approving job:', error);
        }
      },
      // Method to reject a job posting
      rejectJob(jobId) {
        // Implement the logic to reject the job posting
        console.log('Reject job:', jobId);
      }
    }
  }
  </script>
  
  