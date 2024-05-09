<template>
  <div>
    <h1>Jobs</h1>
    <ul>
      <li v-for="job in jobs" :key="job.id">
        <h2><a :href="`/job/${job.id}`">{{ job.title }}</a></h2>
        <p>Description: {{ job.desc }}</p>
        <p>Work Type: {{ job.work_type }}</p>
        <!-- Add other job details you want to display -->
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    jobs: {
      type: Array,
      required: true
    }
  }
}
</script>
