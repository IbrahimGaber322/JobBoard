<template>
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-4">Pending Job Postings</h1>
        
        <!-- Tailwind CSS cards to display pending job postings -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div v-for="pendingJob in pendingJobPostings" :key="pendingJob.id">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4">{{ pendingJob.title }}</h2>
                    <p class="text-gray-700 mb-4">{{ pendingJob.desc }}</p>
                    <p class="text-gray-700 mb-4">Category: {{ pendingJob.category }}</p>
                    <p class="text-gray-700 mb-4">Location: {{ pendingJob.location }}</p>
                    <div class="flex justify-between">
                        <button @click="approveJob(pendingJob.id)" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded focus:outline-none">Approve</button>
                        <button @click="rejectJob(pendingJob.id)" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">Reject</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'JobPostings',
    props: {
        pendingJobPostings: {
            type: Array,
            default: () => []
        }
    },
    methods: {
    approveJob(jobId) {
        // Send a POST request to update the job posting status
        fetch(`/admin/job-postings/update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                id: jobId,
                status: 'accepted' // Change the status as needed
            })
        })
        .then(response => {
            if (response.ok) {
                // If the update was successful, refresh the data in the component
                this.fetchPendingJobPostings(); // You need to define this method to fetch updated data
            } else {
                console.error('Failed to update job posting');
            }
        })
        .catch(error => {
            console.error('Error while updating job posting:', error);
        });
    },
}

}
</script>
