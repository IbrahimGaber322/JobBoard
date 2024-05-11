<template>
  <div>
    <h1>Jobs</h1>
    <ul>
      <li v-for="job in appliedJobs" :key="job.job_id">
        <h2><a :href="`/job/${job.id}`">{{ job.job_title }}</a></h2>
        <p>Description: {{ job.job_description }}</p>
        <button @click="markStatus('Cancelled', job.application_id)" >cancel</button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    appliedJobs: {
      type: Array,
      required: true
    }
  },
  methods: {
    markStatus(status, applicationId) {
      this.$inertia.post(route('applications.update'), { id: applicationId, status: status });
    }

  }
}
</script>
