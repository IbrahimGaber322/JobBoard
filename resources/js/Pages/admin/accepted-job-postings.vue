<template>
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Accepted Job Postings</h1>
        
        <!-- Tailwind CSS cards to display accepted job postings -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div v-for="acceptedJob in acceptedJobPostings" :key="acceptedJob.id">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">{{ acceptedJob.title }}</h2>
                    <p class="text-gray-700 mb-4">{{ acceptedJob.desc }}</p>
                    <p class="text-gray-700 mb-4">Category: {{ acceptedJob.category }}</p>
                    <p class="text-gray-700 mb-4">Location: {{ acceptedJob.location }}</p>
                    <!-- Add additional job details as needed -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AcceptedJobPostings',
    props: {
        acceptedJobPostings: {
            type: Array,
            default: () => []
        }
    }
}
</script>
