<template>
  <div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>

    <div class="grid grid-cols-2 gap-4">
     
      <!-- Employer Job Postings -->
      <div class="bg-yellow-200 rounded-lg shadow-md p-6 cursor-pointer" v-for="employer in employerJobPostings" :key="employer.id" @click="redirectToEmployerJobPostings(employer.id)">
        <h2 class="text-xl font-semibold mb-4">{{ employer.name }} Job Postings</h2>
        <p class="text-gray-700">{{ employer.job_postings_count }}</p>
      </div>

      <!-- Accepted Job Postings -->
      <div class="bg-green-200 rounded-lg shadow-md p-6 cursor-pointer" @click="redirectToAcceptedJobPostings">
        <h2 class="text-xl font-semibold mb-4">Accepted Job Postings</h2>
        <p class="text-gray-700">{{ jobCounts.accepted }}</p>
      </div>

      <!-- Pending Job Postings -->
      <div class="bg-blue-200 rounded-lg shadow-md p-6 cursor-pointer" @click="redirectToPendingJobPostings">
        <h2 class="text-xl font-semibold mb-4">Pending Job Postings</h2>
        <p class="text-gray-700">{{ jobCounts.pending }}</p>
      </div>

      <!-- Rejected Job Postings -->
      <div class="bg-red-200 rounded-lg shadow-md p-6 cursor-pointer" @click="redirectToRejectedJobPostings">
        <h2 class="text-xl font-semibold mb-4">Rejected Job Postings</h2>
        <p class="text-gray-700">{{ jobCounts.rejected }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    employerJobPostings: {
      type: Array,
      required: true
    },
    jobCounts: {
      type: Object,
      required: true
    }
  },
  methods: {
    redirectToAcceptedJobPostings() {
      window.location.href = '/admin/accepted-job-postings';
    },
    redirectToPendingJobPostings() {
      window.location.href = '/admin/pending-job-postings';
    },
    redirectToRejectedJobPostings() {
      window.location.href = '/admin/rejected-job-postings';
    },
    redirectToEmployerJobPostings(employerId) {
      window.location.href = `/admin/employer/${employerId}/job-postings`;
    }
  }
};
</script>
