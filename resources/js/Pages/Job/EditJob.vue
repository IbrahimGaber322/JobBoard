<template>
  <GuestLayout>
    <Head title="Create Job" />
    <form @submit.prevent="submitForm" class="max-w-xl mx-auto">
      <!-- Job Details -->
      <div class="mb-6">
        <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
        <input id="title" type="text" class="mt-1 block w-full rounded-md" v-model="form.title" required autofocus />
      </div>
      
      <div class="mb-6">
        <label for="desc" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea id="desc" class="mt-1 block w-full rounded-md tall-input" v-model="form.desc" required></textarea>
        <!-- You might add validation errors handling here if needed -->
      </div>

      <div class="mb-6">
        <label for="responsibilities" class="block text-sm font-medium text-gray-700">Responsibilities</label>
        <textarea id="responsibilities" class="mt-1 block w-full rounded-md tall-input" v-model="form.responsibilities" required></textarea>
        <!-- You might add validation errors handling here if needed -->
      </div>

      <div class="mb-6">
        <label for="skills" class="block text-sm font-medium text-gray-700">Skills</label>
        <textarea id="skills" class="mt-1 block w-full rounded-md tall-input" v-model="form.skills" required></textarea>
        <!-- You might add validation errors handling here if needed -->
      </div>

      <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
          <label for="experience_level" class="block text-sm font-medium text-gray-700">Experience Level</label>
          <input id="experience_level" type="text" class="mt-1 block w-full rounded-md" v-model="form.experience_level" />
        </div>
        <div>
          <label for="salary_range" class="block text-sm font-medium text-gray-700">Salary Range</label>
          <input id="salary_range" type="text" class="mt-1 block w-full rounded-md" v-model="form.salary_range" />
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
          <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
          <input id="category" type="text" class="mt-1 block w-full rounded-md" v-model="form.category" />
        </div>
        <div>
          <label for="work_type" class="block text-sm font-medium text-gray-700">Work Type</label>
          <select id="work_type" v-model="form.work_type" required class="mt-1 block w-full rounded-md">
            <option value="hybrid">Hybrid</option>
            <option value="remote">Remote</option>
            <option value="onsite">Onsite</option>
          </select>
          <!-- You might add validation errors handling here if needed -->
        </div>
      </div>

      <div class="mb-6">
        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
        <input id="location" type="text" class="mt-1 block w-full rounded-md" v-model="form.location" />
      </div>

      <div class="mb-6">
       
        <div>
          <label for="company_name" class="block text-sm font-medium text-gray-700">Company Name</label>
          <input id="company_name" type="text" class="mt-1 block w-full rounded-md" v-model="form.company_name" />
        </div>
      </div>

      <div class="mb-6">
        <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
        <input id="deadline" type="date" class="mt-1 block w-full rounded-md" v-model="form.deadline" />
      </div>

      <input type="file" id="image" @change="handleFileUpload('image', $event)" />

      <div v-if="jobImage" style="width: 200px; height: 200px; overflow: hidden; border-radius: 50%;">
        <img :src="jobImage" class="w-full h-full object-cover" />
      </div>
      <!-- Submit Button -->
      <div class="flex items-center justify-end">
        <button type="submit" :disabled="form.processing" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
          Submit
        </button>
      </div>
    </form>
  </GuestLayout>
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { ref } from 'vue';
const jobImage = ref('');

export default {
  components: {
    GuestLayout
  },
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
        emp_id: '',
        company_name: '',
        deadline: '',
        image:''
      },
      formFields: {
        title: { label: 'Title', type: 'text', required: true },
        desc: { label: 'Description', type: 'textarea', required: true },
        experience_level: { label: 'Experience Level', type: 'text', required: false },
        responsibilities: { label: 'Responsibilities', type: 'textarea', required: false },
        skills: { label: 'Skills', type: 'textarea', required: false },
        salary_range: { label: 'Salary Range', type: 'text', required: false },
        date: { label: 'Date', type: 'date', required: false },
        category: { label: 'Category', type: 'text', required: false },
        location: { label: 'Location', type: 'text', required: false },
        work_type: { label: 'Work Type', type: 'text', required: false },
        emp_id: { label: 'Employer ID', type: 'text', required: false },
        company_name: { label: 'Company Name', type: 'text', required: false },
        deadline: { label: 'Deadline', type: 'date', required: false }
      }
    };
  },
  props: {
    job: {
      type: Object,
      required: true
    }
  },
  computed: {
    filteredFormFields() {
      const excludedFields = ['date', 'no_of_candidates', 'emp_id', 'status'];
      return Object.keys(this.formFields)
        .filter(fieldName => !excludedFields.includes(fieldName))
        .reduce((obj, key) => {
          obj[key] = this.formFields[key];
          return obj;
        }, {});
    }
  },
  mounted() {
    this.populateForm();
  },
  methods: {

    handleFileUpload(field, event) {
    const file = event.target.files[0];  
    if (file) {
      this.form[field] = file;
      jobImage.value = URL.createObjectURL(file);
      console.log(jobImage.value);
    }
},
    populateForm() {
      for (const field in this.form) {
        if (this.job.hasOwnProperty(field)) {
          this.form[field] = this.job[field];
        }
      }
    },
    submitForm() {
      console.log('Submitting form with data:', this.form);
      return this.$inertia.post(route('job.update', { id: this.job.id }), this.form)
        .then(() => {
          this.$inertia.visit(route('job.show', { id: this.job.id }));
        })
        .catch((error) => {
          console.error('Error updating job:', error);
          throw error;
        });
    }
  }
};
</script>



<style scoped>
.job-form-container {
  max-width: 500px;
  margin: 0 auto;
}

.form-title {
  text-align: center;
  margin-bottom: 20px;
}

.job-form {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 5px;
}

.form-group {
  margin-bottom: 20px;
}

.form-label {
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
}

.input-wrapper {
  position: relative;
}

.form-input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.tall-input {
  min-height: 100px; 
}

.submit-button {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  margin-top: 20px;
}

.submit-button:hover {
  background-color: #0056b3;
}
</style>
