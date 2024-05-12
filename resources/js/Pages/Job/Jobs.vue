<template>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Jobs</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div
                v-for="job in jobs"
                :key="job.id"
                class="bg-white rounded-lg shadow-md p-4"
            >
                <div class="mb-4">
                    <h2 class="text-lg font-semibold mb-2">
                        <a
                            :href="`/job/${job.id}`"
                            class="text-black hover:text-blue-600"
                        >
                            {{ job.title }}
                        </a>
                    </h2>

                    <div class="flex items-center text-gray-500 mb-1">
                        <i class="fas fa-folder mr-1"></i>
                        <span>{{ job.category }}</span>
                    </div>
                    <div class="flex items-center text-gray-500 mb-1">
                        <i class="fas fa-clock mr-1"></i>
                        <span>{{ job.work_type }}</span>
                    </div>
                    <div class="flex items-center text-gray-500 mb-1">
                        <i class="fas fa-building mr-1"></i>

                        <span>{{ job.company_name }}</span>
                    </div>
                    <div class="flex items-center text-gray-500">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        <span>{{ job.location }}</span>
                    </div>
                </div>
                <p class="text-gray-700">{{ job.desc }}</p>
                <!-- Add other job details you want to display -->
            </div>
        </div>
    </div>
</template>

<script>
import "@fortawesome/fontawesome-free/css/all.css";

export default {
    props: {
        jobs: {
            type: Array,
            required: true,
        },
    },
};
</script>

<style scoped>
/* Add any custom styles for the job page here */
</style>
