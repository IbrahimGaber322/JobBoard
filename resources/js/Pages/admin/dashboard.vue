<template>
  <div>
    <Navbar/>
    <div class="relative bg-gradient-to-r">
      <div class="absolute bg-blue-600 rounded-full w-48 h-48 -top-16 -left-16 mix-blend-multiply opacity-50"></div>
      <div class="absolute bg-blue-500 w-64 h-64 transform rotate-45 -bottom-16 -right-32 mix-blend-multiply opacity-50"></div>
      <div class="absolute bg-blue-700 w-96 h-32 -bottom-8 -right-16 mix-blend-multiply opacity-50"></div>
      <div class="container mx-auto flex flex-col items-center justify-center h-screen">
        <h1 class="text-4xl font-bold mt-5 text-blue-900 text-center">Analytics</h1>
        <p class="text-center text-gray-700 mt-4 mb-8">Show More Analytics Detail About Jobs Or Users</p>
        <!-- User and Job Cards -->
        <div class="flex flex-col md:flex-row mb-4 w-full max-w-md md:max-w-full">
          <div v-for="(item, key) in counts" :key="key" @click="redirect(key)" :class="[item.color, 'rounded-lg shadow-md p-2 cursor-pointer mb-4 text-center md:w-1/2']">
            <h2 class="text-sm font-semibold mb-2">{{ item.title }}</h2>
            <p class="text-gray-700">{{ item.count }}</p>
          </div>
        </div>
        <!-- Admin Dashboard Section -->
        <div class="grid grid-cols-2 gap-4">
          <div @click="redirectToEmployeeJobStatistics" class="bg-blue-200 border border-blue-400 p-4 rounded-lg cursor-pointer">
            <h2 class="text-lg font-semibold mb-2">Employers Numbers</h2>
            <p class="text-md">{{ employersCount }}</p>
          </div>
          <!-- Candidates Card -->
          <div @click="redirectToCandidateApplications" class="bg-blue-400 border border-blue-600 p-4 rounded-lg cursor-pointer">
            <h2 class="text-lg font-semibold mb-2">Candidates Numbers</h2>
            <p class="text-md">{{ candidatesCount }}</p>
          </div>
          <!-- Employer Job Postings -->
          <div v-for="employer in employerJobPostings" :key="employer.id" @click="redirectToEmployerJobPostings(employer.id)" class="bg-blue-300 rounded-lg shadow-md p-6 cursor-pointer">
            <h2 class="text-xl font-semibold mb-4">{{ employer.name }} Job Postings</h2>
            <p class="text-gray-700">{{ employer.job_postings_count }}</p>
          </div>
          <!-- Chart Card -->
          <div class="bg-gray-200 rounded-lg shadow-md p-6 col-span-2 md:col-span-1">
            <h2 class="text-xl font-semibold mb-4">Job Numbers Chart</h2>
            <canvas id="jobChart" width="400" height="200"></canvas>
          </div>
          <div class="bg-gray-200 rounded-lg shadow-md p-6 col-span-2 md:col-span-1">
            <h2 class="text-xl font-semibold mb-4">User Numbers Chart</h2>
            <canvas id="userChart" width="400" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

// Modify the script section of your Vue component
<script>
import Chart from 'chart.js/auto';
import Navbar from './Navbar.vue';

export default {
  components: {
    Navbar
  },
  props: {
    totalUsers: {
      type: Number,
      required: true
    },
    totalJobs: {
      type: Number,
      required: true
    },
    employersCount: {
      type: Number,
      required: true
    },
    candidatesCount: {
      type: Number,
      required: true
    },
    employerJobPostings: {
      type: Array,
      required: true
    },
    jobCounts: {
      type: Object,
      required: true
    }
  },

  computed: {
    counts() {
      return [
        { title: 'Users', count: this.totalUsers, color: 'bg-blue-200' },
        { title: 'All Jobs', count: this.totalJobs, color: 'bg-blue-300' },
        { title: 'Accepted Jobs', count: this.jobCounts.accepted, color: 'bg-blue-100' },
        { title: 'Pending Jobs', count: this.jobCounts.pending, color: 'bg-blue-200' },
        { title: 'Rejected Jobs', count: this.jobCounts.rejected, color: 'bg-blue-300' }
      ];
    }
  },

  methods: {
    redirect(route) {
      const routes = {
        'Users': '/admin/user-counts',
        'Job Posting Activity': '/admin/job-postings-dashboard',
        'Accepted Job Postings': '/admin/accepted-job-postings',
        'Pending Job Postings': '/admin/job-postings',
        'Rejected Job Postings': '/admin/rejected-job-postings'
      };
      window.location.href = routes[route];
    },
    redirectToEmployerJobPostings(employerId) {
      window.location.href = `/admin/employer/${employerId}/job-postings`;
    },
    createJobChart() {
      const ctx = document.getElementById('jobChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Accepted', 'Pending', 'Rejected'],
          datasets: [{
            label: 'Job Numbers',
            data: [this.jobCounts.accepted, this.jobCounts.pending, this.jobCounts.rejected],
            backgroundColor: [
              'rgba(75, 192, 192, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
              'rgba(75, 192, 192, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    },
    createUserChart() {
      const ctx = document.getElementById('userChart').getContext('2d');
      new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Candidates', 'Employers'],
          datasets: [{
            label: 'User Numbers',
            data: [this.candidatesCount, this.employersCount],
            backgroundColor: [
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
              'rgba(54, 162, 235, 1)',
              'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    },
    redirectToEmployeeJobStatistics() {
      this.$inertia.visit('/admin/employee-job-statistics');
    },
    redirectToCandidateApplications() {
      this.$inertia.visit('/admin/candidate-applications');
    }
  },

  mounted() {
    this.createJobChart();
    this.createUserChart();
  }
};
</script>
