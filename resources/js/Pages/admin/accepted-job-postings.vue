<template>
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-8">Accepted Job Postings</h1>
        
        <!-- Tailwind CSS cards to display accepted job postings -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <div v-for="acceptedJob in acceptedJobPostings" :key="acceptedJob.id" class="relative">
                <div class="bg-green-100 rounded-lg shadow-md p-4">
                    <h2 class="text-lg font-semibold mb-2 text-green-800">{{ acceptedJob.title }}</h2>
                    <p class="text-gray-700 mb-2">{{ acceptedJob.desc }}</p>
                    <div class="text-gray-700 mb-2">
                        <p class="font-semibold text-green-800">Category:</p>
                        <p class="italic">{{ acceptedJob.category }}</p>
                        <p class="font-semibold text-green-800">Location:</p>
                        <p class="italic">{{ acceptedJob.location }}</p>
                    </div>
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
