<template>
  <div>
    <h1>Edit Job</h1>
    <form @submit.prevent="submitForm">
      <div v-for="(field, fieldName) in formFields" :key="fieldName">
        <label>{{ field.label }}</label>
        <input v-model="form[fieldName]" :type="field.type" :required="field.required" />
      </div>
      <button type="submit">Update Job</button>
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
      formFields: {
        title: { label: 'Title', type: 'text', required: true },
        desc: { label: 'Description', type: 'textarea', required: true },
        experience_level: { label: 'Experience Level', type: 'text', required: false },
        responsibilities: { label: 'Responsibilities', type: 'textarea', required: false },
        skills: { label: 'Skills', type: 'text', required: false },
        salary_range: { label: 'Salary Range', type: 'text', required: false },
        date: { label: 'Date', type: 'date', required: false },
        category: { label: 'Category', type: 'text', required: false },
        location: { label: 'Location', type: 'text', required: false },
        work_type: { label: 'Work Type', type: 'text', required: false },
        status: { label: 'Status', type: 'text', required: false },
        emp_id: { label: 'Employer ID', type: 'text', required: false },
        no_of_candidates: { label: 'Number of Candidates', type: 'text', required: false },
        deadline: { label: 'Deadline', type: 'date', required: false }
      }
    };
  },
  mounted() {
    this.populateForm();
  },
  methods: {
    populateForm() {
      // Populate form fields with existing job details
      for (const field in this.form) {
        if (this.job.hasOwnProperty(field)) {
          this.form[field] = this.job[field];
        }
      }
    },
  submitForm() {
    console.log('Submitting form with data:', this.form); // Log form data
    return this.$inertia.post(route('job.update', { id: this.job.id }), this.form)
        .then(() => {
            // Redirect to job details page or show a success message
            this.$inertia.visit(route('job.show', { id: this.job.id }));
        })
        .catch((error) => {
            // Handle any errors
            console.error('Error updating job:', error);
            throw error; // Rethrow the error to propagate it
        });
}

  },
  props: {
    job: {
      type: Object,
      required: true
    }
  }
};
</script>
