<template>
    <AuthenticatedLayout>
        <div class="flex justify-center items-center h-screen">
            <div class="max-w-lg w-full bg-white shadow-md rounded-lg p-8">
                <h1 class="text-2xl font-bold mb-4">Candidate Details</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="col-span-1 md:col-span-2 lg:col-span-3"> <!-- Adjusted column span to take the whole width -->
                        <div class="bg-white rounded-lg shadow-md p-4 w-full"> <!-- Set width to full -->
                            <img :src="candidate.image" alt="Candidate Image" class="w-full h-auto mb-4">
                            <h2 class="text-lg font-semibold mb-2">{{ candidate.name }}</h2>
                            <p>Email: {{ candidate.email }}</p>
                            <p>Gender: {{ candidate.gender }}</p>
                            <p>Telephone: {{ candidate.telephone }}</p>
                            <p>Bio: {{ candidate.bio }}</p>
                            <p>Title: {{ candidate.title }}</p>
                            <p>Skills: {{ candidate.skills }}</p>
                            <p>Experience: {{ candidate.experience }}</p>
                            <a :href="candidate.resume_url" class="text-blue-600 hover:underline">Download Resume</a>
                        </div>
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
    }
}
</script>
