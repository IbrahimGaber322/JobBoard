<template>
    <div class="container mx-auto">
      <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>
  
      <div class="grid grid-cols-2 gap-4">
        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold mb-4">Total Users</h2>
          <p class="text-gray-700">{{ totalUsers }}</p>
        </div>
  
        <!-- Employer Job Postings -->
        <div class="bg-white rounded-lg shadow-md p-6 cursor-pointer" v-for="employer in employerJobPostings" :key="employer.id" @click="redirectToEmployerJobPostings(employer.id)">
          <h2 class="text-xl font-semibold mb-4">{{ employer.name }} Job Postings</h2>
          <p class="text-gray-700">{{ employer.job_postings_count }}</p>
        </div>
  
        <!-- Accepted Job Postings -->
        <div @click="redirectToAcceptedJobPostings" class="bg-white rounded-lg shadow-md p-6 cursor-pointer">
          <h2 class="text-xl font-semibold mb-4">Accepted Job Postings</h2>
          <p class="text-gray-700">{{ acceptedJobPostings }}</p>
        </div>
  
        <!-- Pending Job Postings -->
        <div @click="redirectToJobPostings" class="bg-white rounded-lg shadow-md p-6 cursor-pointer">
          <h2 class="text-xl font-semibold mb-4">Pending Job Postings</h2>
          <p class="text-gray-700">{{ pendingJobPostings }}</p>
        </div>
  
        <!-- Rejected Job Postings -->
        <div @click="redirectToRejectedJobPostings" class="bg-white rounded-lg shadow-md p-6 cursor-pointer">
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
      },
      employerJobPostings: {
        type: Array,
        required: true
      }
    },
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
      redirectToEmployerJobPostings(employerId) {
        window.location.href = `/admin/employer/${employerId}/job-postings`;
      },
    }
  }
  </script>
  
  <style>
  /* Add your custom styles here */
  </style>
  