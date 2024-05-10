<template>
  <div>
    <h1>Create Job</h1>
    <form @submit.prevent="submitForm">
      <div>
        <label>Title:</label>
        <input v-model="form.title" required />
      </div>
      <div>
        <label>Description:</label>
        <textarea v-model="form.desc" required></textarea>
      </div>
      <div>
        <label>Experience Level:</label>
        <input v-model="form.experience_level" />
      </div>
      <div>
        <label>Responsibilities:</label>
        <textarea v-model="form.responsibilities"></textarea>
      </div>
      <div>
        <label>Skills:</label>
        <textarea v-model="form.skills"></textarea>
      </div>
      <div>
        <label>Salary Range:</label>
        <input v-model="form.salary_range" />
      </div>
      <div>
        <label>Date:</label>
        <input type="date" v-model="form.date" />
      </div>
      <div>
        <label>Category:</label>
        <input v-model="form.category" />
      </div>
      <div>
        <label>Location:</label>
        <input v-model="form.location" />
      </div>
     <div>
  <label>Work Type:</label>
  <select v-model="form.work_type" required>
    <option value="hybrid">Hybrid</option>
    <option value="remote">Remote</option>
    <option value="onsite">Onsite</option>
  </select>
</div>

      <div>
        <label>Status:</label>
        <input v-model="form.status" />
      </div>
      <div>
        <label>Employer ID:</label>
        <input v-model="form.emp_id" />
      </div>
   
      <div>
        <label>Deadline:</label>
        <input type="date" v-model="form.deadline" />
      </div>
      <div>
        <button type="submit">Submit</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        title: '',
        desc: '',
        experience_level: '',
        responsibilities: '',
        skills: '',
        salary_range: '',
        date: '',
        category: '',
        location: '',
        work_type: '',
        status: '',
        emp_id: '',
        no_of_candidates: '',
        deadline: ''
      },
    };
  },
  methods: {
    submitForm() {
      this.$inertia.post(route('jobs.store'), this.form);
    }
  }
}
</script>
