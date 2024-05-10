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
        <button @click="" >Mark Accepted</button>
        <button @click="" >Mark Rejected</button>
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
  }
}
</script>
