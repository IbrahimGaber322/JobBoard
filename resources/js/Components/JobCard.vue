<template>
  <div class="bg-white rounded-lg shadow-md p-4">
    <h2 class="text-xl font-semibold mb-2"><a :href="`/job/${job.id}`">{{ job.title }}</a></h2>
    <p class="text-gray-700 mb-2">{{ job.desc }}</p>
    <p class="text-gray-500">{{ job.work_type }}</p>
    <!-- Add other job details you want to display -->
  </div>
</template>

<script setup>
  import { defineProps } from 'vue';

  const props = defineProps({
    job: {
      type: Object,
      required: true,
    },
  });
</script>

<style scoped>
/* Add any custom styles for the job card here */
</style>
