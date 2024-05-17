<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
<template>
    <AuthenticatedLayout>
        <div class="flex justify-center items-center h-screen">
            <div class="max-w-lg w-full bg-white shadow-md rounded-lg p-8">
                <h1 class="text-2xl font-bold mb-4">Candidate Details</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <div class="flex items-center mb-2">
                            <div class="relative w-20 h-20 rounded-full overflow-hidden mr-4 bg-gray-200">
                                <img v-if="candidate && candidate.image" :src="candidate.image" alt="candidate Image"
                                    class="w-full h-full object-cover rounded-full">
                                <img v-else :src="imageUrl" alt="Default Profile Image"
                                    class="w-full h-full object-cover rounded-full">
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold">{{ candidate.name }}</h2>
                            </div>
                        </div>
                        <p>Email: {{ candidate.email }}</p>
                        <p>Gender: {{ candidate.gender }}</p>
                        <p>Telephone: {{ candidate.telephone }}</p>
                        <p>Bio: {{ candidate.bio }}</p>
                        <p>Title: {{ candidate.title }}</p>
                        <p>Skills: {{ candidate.skills }}</p>
                        <p>Experience: {{ candidate.experience }}</p>
                        <a :href="candidate.resume" class="text-blue-600 hover:underline"
                            @click.prevent="downloadResume">Download Resume</a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<script>
export default {
    props: {
        candidate: {
            required: true
        }
    },
    methods: {
        async downloadResume() {
            try {
                const response = await fetch(this.candidate.resume);
                const blob = await response.blob();
                const url = window.URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'resume.pdf');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } catch (error) {
                console.error('Error downloading resume:', error);
            }
        }
    }
}
</script>
