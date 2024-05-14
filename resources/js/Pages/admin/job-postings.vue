<template>
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-8">Pending Job Postings</h1>
        
        <!-- Tailwind CSS cards to display pending job postings -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <div v-for="pendingJob in pendingJobPostings" :key="pendingJob.id" class="relative">
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h2 class="text-lg font-semibold mb-2">{{ pendingJob.title }}</h2>
                    <p class="text-gray-700 mb-2">{{ pendingJob.desc }}</p>
                    <div class="text-gray-700 mb-2">
                        <p class="font-semibold">Category:</p>
                        <p class="italic">{{ pendingJob.category }}</p>
                        <p class="font-semibold">Location:</p>
                        <p class="italic">{{ pendingJob.location }}</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <button @click="approveJob(pendingJob.id)" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded focus:outline-none">Approve</button>
                        <button @click="rejectJob(pendingJob.id)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded focus:outline-none">Reject</button>
                    </div>
                </div>
                <div class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-blue-500 text-white px-2 py-1 rounded-full">
                    <span class="text-xs font-semibold">New</span>
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
    rejectJob(jobId) {
        // Send a POST request to reject the job posting
        fetch(`/admin/job-postings/update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                id: jobId,
                status: 'rejected' // Set the status to 'rejected'
            })
        })
        .then(response => {
            if (response.ok) {
                // If the update was successful, refresh the data in the component
                this.fetchPendingJobPostings(); // You need to define this method to fetch updated data
            } else {
                console.error('Failed to reject job posting');
            }
        })
        .catch(error => {
            console.error('Error while rejecting job posting:', error);
        });
    }
}

}
</script>
