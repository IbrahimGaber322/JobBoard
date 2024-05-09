<template>
  <div>
    <h1>{{ job.title }}</h1>
    <p>Description: {{ job.desc }}</p>
    <p>Work Type: {{ job.work_type }}</p>
    <!-- Add other job details you want to display -->
    <h2><a :href="`/job/${job.id}/edit`">Edit Job</a></h2>
    <button @click="deleteJob">Delete Job</button>
  </div>
</template>

<script>
export default {
  props: {
    job: {
      type: Object,
      required: true
    }
  },
  methods: {
    deleteJob() {
      if (confirm('Are you sure you want to delete this job?')) {
        this.$inertia.delete(route('job.delete', { id: this.job.id }))
          .then(() => {
            // Redirect to a page or perform any other actions after deletion
            // For example, redirect to the jobs index page
            this.$inertia.visit(route('job.index'));
          })
          .catch(error => {
            console.error('Error deleting job:', error);
            // Handle errors, such as displaying an error message to the user
          });
      }
    }
  }
}
</script>
