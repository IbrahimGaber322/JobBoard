<template>
    <div class="container mx-auto">
      <h1 class="text-3xl font-bold mb-4">Employee Job Statistics</h1>
  
      <div v-if="employees.length === 0">
        <p>No employees found.</p>
      </div>
  
      <div v-else>
        <div v-for="employee in employees" :key="employee.id" class="flex mb-4">
          <div class="bg-white shadow-md rounded-lg py-3 px-4 mr-4">
            <h2 class="text-lg font-semibold text-blue-600 mb-2">{{ employee.name }}</h2>
            <p class="text-gray-700">Total Jobs: <span class="text-green-600">{{ employee.total_jobs }}</span></p>
            <p class="text-gray-700">Accepted Jobs: <span class="text-blue-600">{{ employee.accepted_jobs }}</span></p>
            <p class="text-gray-700">Rejected Jobs: <span class="text-red-600">{{ employee.rejected_jobs }}</span></p>
            <p class="text-gray-700">Pending Jobs: <span class="text-yellow-600">{{ employee.pending_jobs }}</span></p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  
  
  
  <script>
  export default {
    props: {
      employees: {
        type: Array,
        required: true
      }
    }
  };
  </script>
  