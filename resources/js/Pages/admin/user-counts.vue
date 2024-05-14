<template>
  <div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-4">Users</h1>
    <div class="grid grid-cols-2 gap-4">
      <!-- Employers Card -->
      <div @click="redirectToEmployeeJobStatistics" class="bg-blue-200 border border-blue-400 p-4 rounded-lg cursor-pointer">
        <h2 class="text-lg font-semibold mb-2">Employers Numbers</h2>
        <p class="text-md">{{ employersCount }}</p>
      </div>
      <!-- Candidates Card -->
      <div @click="redirectToCandidateApplications" class="bg-green-200 border border-green-400 p-4 rounded-lg cursor-pointer">
        <h2 class="text-lg font-semibold mb-2">Candidates Numbers</h2>
        <p class="text-md">{{ candidatesCount }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    employersCount: Number,
    candidatesCount: Number
  },
  methods: {
    redirectToEmployeeJobStatistics() {
      this.$inertia.visit('/admin/employee-job-statistics');
    },
    redirectToCandidateApplications() {
      this.$inertia.visit('/admin/candidate-applications');
    }
  }
};
</script>
