<template>
    <div>
        <Navbar/>
        <div class="relative bg-gradient-to-r">

            <div class="absolute bg-blue-600 rounded-full w-96 h-96 -top-32 -left-32 mix-blend-multiply opacity-50"></div>
            <div class="absolute bg-blue-500 w-64 h-64 transform rotate-45 -bottom-16 -right-32 mix-blend-multiply opacity-50"></div>
            <div class="absolute bg-blue-700 w-96 h-32 -bottom-8 -right-16 mix-blend-multiply opacity-50"></div>

            <div class="container mx-auto">
                <div class="flex justify-center">
                    <h1 class="text-4xl font-bold mt-5 text-blue-900">Approved Job Postings</h1>
                </div>
                <div class="flex justify-center items-center">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 mt-10 mb-10">
                        <div v-for="acceptedJob in acceptedJobPostings" :key="acceptedJob.id" class="relative">
                            <a :href="'/admin/job-postings/' + acceptedJob.id">
                                <div class="bg-white rounded-lg shadow-md p-6 w-full md:w-5/6 lg:w-8/10 jobCard cursor-pointer">
                                    <h2 class="text-lg font-semibold mb-4 text-blue-900">{{ acceptedJob.title }}</h2>
                                    <p class="text-gray-700 mb-4 description">{{ acceptedJob.desc }}</p>
                                    <div class="text-gray-700 mb-4">
                                        <p class="font-semibold text-blue-900">Category:</p>
                                        <p class="italic">{{ acceptedJob.category }}</p>
                                        <p class="font-semibold text-blue-900">Location:</p>
                                        <p class="italic">{{ acceptedJob.location }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import Navbar from './Navbar.vue';

export default {
    
    name: 'JobPostings',
    components: {
    Navbar 
  },
    props: {
        acceptedJobPostings: {
            type: Array,
            default: () => []
        }
    },
    methods: {
    approveJob(jobId) {
        fetch(`/admin/job-postings/update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                id: jobId,
                status: 'accepted'
            })
        })
        .then(response => {
            if (response.ok) {
                this.acceptedJobPostings = this.acceptedJobPostings.filter(job => job.id !== jobId);
            } else {
                console.error('Failed to update job posting');
            }
        })
        .catch(error => {
            console.error('Error while updating job posting:', error);
        });
    },
    rejectJob(jobId) {
        fetch(`/admin/job-postings/update`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                id: jobId,
                status: 'rejected'
            })
        })
        .then(response => {
            if (response.ok) {
                // Remove the rejected job posting from the array
                this.acceptedJobPostings = this.acceptedJobPostings.filter(job => job.id !== jobId);
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
<style>
.jobCard {
    width: 300px;
    height: 400px; 
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.description {
    flex-grow: 1; 
    overflow: auto;
}

.description::-webkit-scrollbar {
    width: 8px; 
}

.description {
    scrollbar-width: thin; 
    scrollbar-color: #9facf3 #f1f1f1; 
}
</style>
