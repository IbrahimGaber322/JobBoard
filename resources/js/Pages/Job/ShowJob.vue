<template>
  <div class="flex justify-center items-center h-screen">
    <div class="max-w-lg w-full bg-white shadow-md rounded-lg p-8">
      <h1 class="text-2xl font-bold mb-4">{{ job.title }}</h1>
      <p class="text-gray-700 mb-2">Description: {{ job.desc }}</p>
      <p class="text-gray-700 mb-2">Experience Level: {{ job.experience_level }}</p>
      <p class="text-gray-700 mb-2">Responsibilities: {{ job.responsibilities }}</p>
      <p class="text-gray-700 mb-2">Skills: {{ job.skills }}</p>
      <p class="text-gray-700 mb-2">Salary Range: {{ job.salary_range }}</p>
      <p class="text-gray-700 mb-2">Category: {{ job.category }}</p>
      <p class="text-gray-700 mb-2">Location: {{ job.location }}</p>
      <p class="text-gray-700 mb-2">Work Type: {{ job.work_type }}</p>
      <p class="text-gray-700 mb-2">Status: {{ job.status }}</p>
      <p class="text-gray-700 mb-2">Company Name: {{ job.company_name }}</p>
      <p class="text-gray-700 mb-2">Deadline: {{ formatDeadline(job.deadline) }}</p>
      <div class="flex justify-between items-center">
        <!-- Edit button with conditional styling -->
        <button 
          v-if="isEmployer" 
          @click="editJob" 
          class="text-blue-600 hover:underline"
        >
          Edit Job
        </button>
        <!-- Delete button with conditional styling -->
        <button 
          v-if="isEmployer" 
          @click="deleteJob" 
          class="text-red-600 hover:underline"
        >
          Delete Job
        </button>
      </div>
      <!-- Submit button -->
      <button @click="apply" >Submit</button>
    </div>
  </div>
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
    userId: {
      type: String,
      required: true
    },
    isOwner: {
      type: Boolean,
      required: true
    },
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
    editJob() {
      
      window.location.href = `/job/${this.job.id}/edit`;
    }
  },
  computed: {
    isEmployer() {
      const data = {
          empId: this.job.emp_id,
          jobId: this.job.id
        };
      return this.userRole === 'employer' && this.isOwner === true; 
    }
  }
}
</script>

<style>
/* Add any additional styling here if needed */
</style>