<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
<template>
  <AuthenticatedLayout>
      <div class="container mx-auto py-6">
          <h1 class="text-2xl font-bold mb-4">Applied Jobs</h1>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
              <!-- Check if there are applied jobs, if not, display a message -->
              <div v-if="!appliedJobs.length" class="text-gray-700">
                  You haven't applied to any job yet.
              </div>
              <!-- If there are applied jobs, display each job card -->
              <div
                  v-else
                  v-for="job in appliedJobs"
                  :key="job.job_id"
                  class="bg-white rounded-lg shadow-md p-4"
              >
                  <div class="mb-4">
                      <h2 class="text-lg font-semibold mb-2">
                          <a
                              :href="`../job/${job.job_id}`"
                              class="text-black hover:text-blue-600"
                          >
                              {{ job.job_title }}
                          </a>
                      </h2>
                  </div>
                  <p class="text-gray-700">Job Description: {{ job.job_description }}</p>
                  <p class="text-gray-700">Application Status: {{ job.application_status }}</p>
                  <button @click="markStatus('Cancelled', job.application_id)" 
                          :disabled="job.application_status !== 'pending'"
                          :class="{'text-gray-400 cursor-not-allowed': job.application_status !== 'pending'}">Cancel</button>
              </div>
          </div>
      </div>
  </AuthenticatedLayout>
</template>



<script>
export default {
  props: {
    appliedJobs: {
      type: Array,
      required: true
    }
  },
  methods: {
    markStatus(status, applicationId) {
      this.$inertia.post(route('app.update'), { id: applicationId, status: status });
    }

  }
}
</script>
