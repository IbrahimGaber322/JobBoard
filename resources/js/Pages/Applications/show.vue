<template>
  <div>
    <h1>Applications</h1>
    <ul>
      <li v-for="application in userApplications" :key="application.id">
        <p>candidate name: {{ application.candidate_name }}</p>
        <p>job title: {{ application.job_title }}</p>
        <p>candidate email: {{ application.candidate_email }}</p>
        <p>applied in : {{ application.date_of_application }}</p>
        <p>status: {{ application.status }}</p>
        <button @click="markStatus('Accepted', application.id)" >Mark Accepted</button>
        <button @click="markStatus('Rejected', application.id)" >Mark Rejected</button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    userApplications: {
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
