<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
  <AuthenticatedLayout>
    <div v-if="isEmployer || job.status === 'accepted'" class="flex justify-center items-center h-screen">
      <div class="max-w-lg w-full bg-white shadow-md rounded-lg p-8 mb-8">
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center">
            <div v-if="job.image" class="w-20 h-20 rounded-full overflow-hidden mr-4">
              <img :src="job.image" alt=" Logo" class="w-full h-full object-cover rounded-full">
            </div>
            <div v-else class="w-20 h-20 rounded-full bg-gray-200 flex justify-center items-center mr-4">
              <span class="text-gray-500 text-lg font-semibold">🏢</span>
            </div>
            <h1 class="text-2xl font-bold">{{ job.company_name }}</h1>
          </div>
          <div class="flex items-center">
            <button v-if="isEmployer" @click="editJob" class="text-blue-600 hover:underline mr-2">
              Edit Job
            </button>
            <button v-if="isEmployer" @click="deleteJob" class="text-red-600 hover:underline">
              Delete Job
            </button>
          </div>
        </div>
        <div>
          <h2 class="text-xl font-semibold mb-2">Job Details</h2>
          <div class="grid grid-cols-2 gap-4 mb-4">
            <div class="col-span-2 md:col-span-1">
              <p class="text-gray-700"><strong>Title:</strong> {{ job.title }}</p>
              <p class="text-gray-700"><strong>Salary Range:</strong> {{ job.salary_range }}</p>
              <p class="text-gray-700"><strong>Category:</strong> {{ job.category }}</p>
              <p class="text-gray-700"><strong>Location:</strong> {{ job.location }}</p>
              <p class="text-gray-700"><strong>Work Type:</strong> {{ job.work_type }}</p>
              <p v-if="isEmployer" class="text-gray-700"><strong>Status:</strong> {{ job.status }}</p>
              <p class="text-gray-700"><strong>Deadline:</strong> {{ formatDeadline(job.deadline) }}</p>
              <p v-if="isEmployer" class="text-gray-700"><strong>Number of Candidates:</strong> {{ job.no_of_candidates
                }}</p>
            </div>
          </div>
        </div>
        <button @click="apply" class="mt-4 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600"
          v-if="isCandidate && !hasApplied && !deadlinePassed">
          🚀 Submit Application
        </button>
        <p v-if="isCandidate && !hasApplied && deadlinePassed" class="text-red-500">⏰ Deadline has passed</p>
        <button v-if="isCandidate && hasApplied && isPending" @click="markStatus('Cancelled', appId)"
          class="mt-4 bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600">
          🚫 Cancel Application
        </button>
      </div>
      <!-- Additional Information Card -->
      <div class="bg-white p-8 rounded-lg shadow-xl" style="margin-top: -30px;">
        <h2 class="text-2xl font-semibold mb-4">Additional Information</h2>
        <div class="border-b-2 border-gray-200 mb-6"></div>
        <div class="mb-6">
          <h3 class="text-lg font-semibold mb-2 text-gray-800">Description</h3>
          <p class="text-base text-gray-700">{{ job.desc }}</p>
        </div>
        <div class="mb-6">
          <h3 class="text-lg font-semibold mb-2 text-gray-800">Responsibilities</h3>
          <ul class="list-disc list-inside text-base text-gray-700">
            {{ job.responsibilities }}
          </ul>
        </div>
        <div>
          <h3 class="text-lg font-semibold mb-2 text-gray-800">Skills</h3>
          <ul class="list-disc list-inside text-base text-gray-700">
            {{ job.skills }}
          </ul>
        </div>
      </div>

    </div>
  </AuthenticatedLayout>
</template>

<script>
export default {
  props: {
    job: {
      type: Object,
      required: true
    },
    userRole: {
      type: String,
      required: true
    },
    hasApplied: {
      type: Boolean,
      default: false
    },
    isPending: {
      type: Boolean,
      default: false
    },
    appId: {
      type: Number,
      default: null
    },
    userId: {
      type: String,
      required: true
    },
    isOwner: {
      type: Boolean,
      required: true
    },
  },
  data() {
    return {
      deadlinePassed: false
    };
  },
  mounted() {
    this.checkDeadline();
  },
  methods: {
    deleteJob() {
      if (confirm('Are you sure you want to delete this job?')) {
        this.$inertia.delete(route('job.delete', { id: this.job.id }))
          .then(() => {
            this.$inertia.visit(route('job.index'));
          })
          .catch(error => {
            console.error('Error deleting job:', error);
          });
      }
    },
    apply() {
      if (confirm('Are you sure you want to apply for this job?')) {
        const data = {
          empId: this.job.emp_id,
          jobId: this.job.id
        };

        const routeParams = { id: this.job.id };

        this.$inertia.post(route('application.store', routeParams), data);
      }
    },
    formatDeadline(deadline) {
      return new Date(deadline).toLocaleDateString();
    },
    markStatus(status, applicationId) {
      console.log('Marking status:', status, 'for application ID:', applicationId);
      this.$inertia.post(route('app.update'), { id: applicationId, status: status });
    },
    editJob() {
      window.location.href = `/job/${this.job.id}/edit`;
    },
    checkDeadline() {
      const deadlineDate = new Date(this.job.deadline);
      const currentDate = new Date();
      if (currentDate > deadlineDate) {
        this.deadlinePassed = true;
      }
    }
  },
  computed: {
    isEmployer() {
      return this.userRole === 'employer' && this.isOwner === true;
    },
    isCandidate() {
      return this.userRole === 'candidate';
    }
  }
}
</script>

<style></style>
