<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
<template>
    <AuthenticatedLayout>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Accepted Jobs</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div
                v-for="job in acceptedJobs"
                :key="job.job_id"
                class="bg-white rounded-lg shadow-md p-4"
            >
                <div class="mb-4">
                    <div class="text-green-600 font-semibold mt-2">Congratulations! You have been accepted for this job.</div>
                    <h2 class="text-lg font-semibold mb-2">
                        <a
                            :href="`../job/${job.job_id}`"
                            class="text-black hover:text-blue-600"
                        >
                            {{ job.job_title }}
                        </a>
                    </h2>
                </div>
                <p class="text-gray-700">job description: {{ job.job_description }}</p>
            </div>
        </div>
    </div>
</AuthenticatedLayout>
</template>



<script>
export default {
  props: {
    acceptedJobs: {
      type: Array,
      required: true
    }
  }
}
</script>
