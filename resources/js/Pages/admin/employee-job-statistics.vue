<template>
    <div class="container mx-auto">
      <h1 class="text-3xl font-bold mb-4">Employee Job Statistics</h1>
  
      <!-- Display employee job statistics -->
      <div class="grid grid-cols-2 gap-4">
        <div class="bg-yellow-200 rounded-lg shadow-md p-6">
          <h2 class="text-xl font-semibold mb-4">Employee Name</h2>
          <p class="text-gray-700">Number of Jobs Posted: {{ employeeJobsCount }}</p>
          <p class="text-gray-700">Accepted Jobs: {{ acceptedJobsCount }}</p>
          <p class="text-gray-700">Pending Jobs: {{ pendingJobsCount }}</p>
          <p class="text-gray-700">Rejected Jobs: {{ rejectedJobsCount }}</p>
        </div>
        <!-- Add more cards for additional employees if needed -->
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        employeeJobsCount: 0,
        acceptedJobsCount: 0,
        pendingJobsCount: 0,
        rejectedJobsCount: 0
      };
    },
    mounted() {
      this.fetchEmployeeJobStatistics();
    },
    methods: {
      fetchEmployeeJobStatistics() {
        // Call your API endpoint to fetch employee job statistics
        // Replace this with the actual endpoint
        // Example:
        // axios.get('/admin/employee-job-statistics')
        //   .then(response => {
        //     this.employeeJobsCount = response.data.employeeJobsCount;
        //     this.acceptedJobsCount = response.data.acceptedJobsCount;
        //     this.pendingJobsCount = response.data.pendingJobsCount;
        //     this.rejectedJobsCount = response.data.rejectedJobsCount;
        //   })
        //   .catch(error => {
        //     console.error('Error fetching employee job statistics:', error);
        //   });
        // For now, let's use placeholder values
        this.employeeJobsCount = 10;
        this.acceptedJobsCount = 5;
        this.pendingJobsCount = 3;
        this.rejectedJobsCount = 2;
      }
    }
  };
  </script>
  
  <style>
  /* Add your custom styles here */
  </style>
  