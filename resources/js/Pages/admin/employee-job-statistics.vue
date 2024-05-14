<template>
    <div class="container mx-auto">
      <h1 class="text-3xl font-bold mb-4">Employee Job Statistics</h1>
  
      <div v-if="employees.length === 0">
        <p>No employees found.</p>
      </div>
  
      <div v-else>
        <div v-for="employee in employees" :key="employee.id">
          <h2 class="text-xl font-semibold">{{ employee.name }}</h2>
          <p>Total Jobs: {{ employee.total_jobs }}</p>
          <p>Accepted Jobs: {{ employee.accepted_jobs }}</p>
          <p>Rejected Jobs: {{ employee.rejected_jobs }}</p>
          <p>Pending Jobs: {{ employee.pending_jobs }}</p>
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
  