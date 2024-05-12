<template>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Applied Jobs</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div
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
                <p class="text-gray-700">{{ job.job_description }}</p>
                <button @click="markStatus('Cancelled', job.application_id)" >cancel</button>
            </div>
        </div>
    </div>
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
      this.$inertia.post(route('applications.update'), { id: applicationId, status: status });
    }

  }
}
</script>
