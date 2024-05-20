<template>
  <div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-4">Users</h1>
    <div class="grid grid-cols-2 gap-4">
      <!-- Employers Card -->
      
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
