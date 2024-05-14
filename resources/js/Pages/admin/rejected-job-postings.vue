<template>
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Rejected Job Postings</h1>
        
        <!-- Tailwind CSS cards to display rejected job postings -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div v-for="rejectedJob in rejectedJobPostings" :key="rejectedJob.id">
                <div class="bg-red-100 rounded-lg shadow-md p-4">
                    <h2 class="text-lg font-semibold mb-2 text-red-800">{{ rejectedJob.title }}</h2>
                    <p class="text-gray-700 mb-2">{{ rejectedJob.desc }}</p>
                    <div class="text-gray-700 mb-2">
                        <p class="font-semibold text-red-800">Category:</p>
                        <p class="italic">{{ rejectedJob.category }}</p>
                        <p class="font-semibold text-red-800">Location:</p>
                        <p class="italic">{{ rejectedJob.location }}</p>
                    </div>
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
