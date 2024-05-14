<template>
  <div>
  <!-- Navbar -->
<nav class="bg-gray-800 p-4 flex justify-between items-center">
  <!-- Logo -->
  <div class="text-white font-bold text-xl">Admin Panel</div>
  <!-- Notification Icon -->
  <div class="text-white">
    <a href="/admin/notifications" class="block">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
      </svg>
    </a>
  </div>
</nav>


    <!-- Main Content -->
    <div class="container mx-auto flex flex-col items-center justify-center h-screen">
      <h1 class="text-3xl font-bold mb-4">Welcome to Admin Panel</h1>
      <p class="mb-8">This is where you can manage various aspects of your application as an administrator.</p>

      <!-- Navigation Buttons -->
      <div class="flex flex-col mb-4">
        <button @click="redirectToJobPostings" class="mb-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none">
          View Pending Job Postings
        </button>

        <button @click="redirectToAcceptedJobPostings" class="mb-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none">
          View Accepted Job Postings
        </button>

        <button @click="redirectToRejectedJobPostings" class="mb-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none">
          View Rejected Job Postings
        </button>
        <button @click="redirectToAdminDashboard" class="mb-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none">
          DashBoard
        </button>
      </div>

      <!-- Tailwind CSS cards to display pending job postings -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <div v-for="pendingJob in pendingJobPostings" :key="pendingJob.id">
          <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4">{{ pendingJob.title }}</h2>
            <p class="text-gray-700 mb-4">{{ pendingJob.desc }}</p>
            <p class="text-gray-700 mb-4">Category: {{ pendingJob.category }}</p>
            <p class="text-gray-700 mb-4">Location: {{ pendingJob.location }}</p>
            <div class="flex justify-between">
              <button @click="approveJob(pendingJob.id)" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded focus:outline-none">
                Approve
              </button>
              <button @click="rejectJob(pendingJob.id)" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">
                Reject
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    redirectToJobPostings() {
      window.location.href = '/admin/job-postings';
    },
    redirectToAcceptedJobPostings() {
      window.location.href = '/admin/accepted-job-postings';
    },
    redirectToRejectedJobPostings() {
      window.location.href = '/admin/rejected-job-postings';
    },
    redirectToAdminDashboard(){
      window.location.href = '/admin/dashboard';
    }
  }
}
</script>
