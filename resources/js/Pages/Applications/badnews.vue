<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
<template>
    <AuthenticatedLayout>
        <div class="container mx-auto py-6">
            <h1 class="text-2xl font-bold mb-4">Rejected Jobs</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Check if there are rejected jobs, if not, display a message -->
                <div v-if="!rejectedJobs.length" class="text-gray-700">
                    You haven't been rejected for any job yet.
                </div>
                <!-- If there are rejected jobs, display each job card -->
                <div
                    v-else
                    v-for="job in rejectedJobs"
                    :key="job.job_id"
                    class="bg-white rounded-lg shadow-md p-4"
                >
                    <div class="mb-4">
                        <div class="text-red-600 font-semibold mt-2">Sorry! You have been rejected for this job.</div>
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
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>




<script>
export default {
  props: {
    rejectedJobs: {
      type: Array,
      required: true
    }
  }
}
</script>