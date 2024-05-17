<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PaginationBar from '@/Components/PaginationBar.vue';

const props = defineProps({
    userApplications: {
            type: Array,
            required: true,
            default: null
        }

});
console.log(props.userApplications)
</script>
<template>
    <AuthenticatedLayout>
        <div class="container mx-auto py-6">
            <h1 class="text-2xl font-bold mb-4">Applications</h1>
            <!-- Check if there are user applications, if not, display a message -->
            <div v-if="!userApplications || userApplications.length === 0" class="text-gray-700">
                No applications have been submitted yet.
            </div>
            <!-- If there are user applications, display each application -->
            <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div v-for="application in userApplications.data" :key="application.id"
                    class="bg-white rounded-lg shadow-md p-4">
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold mb-2">
                            <a :href="`/candidate/${application.candidate.id}`" class="text-black hover:text-blue-600">
                                {{ application.candidate.name }}
                            </a>
                        </h2>

                        <div class="flex items-center text-gray-500 mb-1">
                            <span>job title: {{ application.job.title }}</span>
                        </div>
                        <div class="flex items-center text-gray-500 mb-1">
                            <span>candidate email: {{ application.candidate.email }}</span>
                        </div>
                        <div class="flex items-center text-gray-500 mb-1">
                            <span>applied in : {{ formatDeadline(application.created_at) }}</span>
                        </div>
                        <div class="flex items-center text-gray-500">
                            <span>status: {{ application.status }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <button @click="markStatus('Rejected', application.id)" :class="{
                                'text-red-600 hover:underline': application.status === 'pending' || application.status === 'Accepted',
                                'text-gray-400 cursor-not-allowed': application.status === 'Rejected'
                            }" :disabled="application.status === 'Rejected'">
                                Mark Rejected
                            </button>

                            <button @click="markStatus('Accepted', application.id)" :class="{
                                'text-blue-600 hover:underline': application.status === 'pending' || application.status === 'Rejected',
                                'text-gray-400 cursor-not-allowed': application.status === 'Accepted'
                            }" :disabled="application.status === 'Accepted'">
                                Mark Accepted
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <PaginationBar class=" mt-auto" :links="props.userApplications.links" />
    </AuthenticatedLayout>
</template>


<script>
export default {

    methods: {
        markStatus(status, applicationId) {
            this.$inertia.post(route('app-accept.update'), { id: applicationId, status: status });
            window.alert(`Application marked as ${status}`);
        },
        formatDeadline(deadline) {
      return new Date(deadline).toLocaleDateString();
    },

    }
}
</script>
