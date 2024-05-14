<template>
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Rejected Job Postings</h1>
        
        <!-- Tailwind CSS cards to display rejected job postings -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div v-for="rejectedJob in rejectedJobPostings" :key="rejectedJob.id">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">{{ rejectedJob.title }}</h2>
                    <p class="text-gray-700 mb-4">{{ rejectedJob.desc }}</p>
                    <p class="text-gray-700 mb-4">Category: {{ rejectedJob.category }}</p>
                    <p class="text-gray-700 mb-4">Location: {{ rejectedJob.location }}</p>
                    <!-- Add additional job details as needed -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'RejectedJobPostings',
    props: {
        rejectedJobPostings: {
            type: Array,
            default: () => []
        }
    }
}
</script>
