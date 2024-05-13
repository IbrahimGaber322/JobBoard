<template>
  <GuestLayout>
    <Head title="Create Job" />
    <form @submit.prevent="submitForm" class="max-w-xl mx-auto">
      <!-- Job Details -->
      <div class="mb-6">
        <InputLabel for="title" value="Job Title" />
        <TextInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus />
      </div>
      
      <div class="mb-6">
        <InputLabel for="desc" value="Description" />
        <textarea id="desc" class="mt-1 block w-full tall-input" v-model="form.desc" required></textarea>
        <InputError class="mt-2" :message="form.errors.desc" />
      </div>

      <div class="mb-6">
        <InputLabel for="responsibilities" value="Responsibilities" />
        <textarea id="responsibilities" class="mt-1 block w-full tall-input" v-model="form.responsibilities" required></textarea>
        <InputError class="mt-2" :message="form.errors.responsibilities" />
      </div>

      <div class="mb-6">
        <InputLabel for="skills" value="Skills" />
        <textarea id="skills" class="mt-1 block w-full tall-input" v-model="form.skills" required></textarea>
        <InputError class="mt-2" :message="form.errors.skills" />
      </div>

      <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
          <InputLabel for="experience_level" value="Experience Level" />
          <TextInput id="experience_level" type="text" v-model="form.experience_level" />
        </div>
        <div>
          <InputLabel for="salary_range" value="Salary Range" />
          <TextInput id="salary_range" type="text" class="mt-1 block w-full" v-model="form.salary_range" />
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4 mb-6">
        <div>
          <InputLabel for="category" value="Category" />
          <TextInput id="category" type="text" class="mt-1 block w-full" v-model="form.category" />
        </div>
        <div>
          <InputLabel for="work_type" value="Work Type" />
          <select id="work_type" v-model="form.work_type" required class="mt-1 block w-full">
            <option value="hybrid">Hybrid</option>
            <option value="remote">Remote</option>
            <option value="onsite">Onsite</option>
          </select>
          <InputError class="mt-2" :message="form.errors.work_type" />
        </div>
      </div>

      <div class="mb-6">
        <InputLabel for="location" value="Location" />
        <TextInput id="location" type="text" class="mt-1 block w-full" v-model="form.location" />
      </div>

      <div class="mb-6">
       
        <div>
          <InputLabel for="company_name" value="Company Name" />
          <TextInput id="company_name" type="text" class="mt-1 block w-full" v-model="form.company_name" />
        </div>
      </div>

      <div class="mb-6">
        <InputLabel for="deadline" value="Deadline" />
        <input id="deadline" type="date" class="mt-1 block w-full" v-model="form.deadline" />
      </div>

      <!-- Submit Button -->
      <div class="flex items-center justify-end">
        <PrimaryButton type="submit" :disabled="form.processing">
          Submit
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>

<script setup>
  import GuestLayout from '@/Layouts/GuestLayout.vue';
  import InputError from '@/Components/InputError.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import TextInput from '@/Components/TextInput.vue';
  import { Head, useForm } from '@inertiajs/vue3';

  const form = useForm({
    title: '',
    desc: '',
    experience_level: '',
    responsibilities: '',
    skills: '',
    salary_range: '',
    category: '',
    location: '',
    work_type: '',
    status: '',
    emp_id: '',
    no_of_candidates: '',
    deadline: '',
    company_name: ''

  });

  const submitForm = () => {
    form.post(route('jobs.store'));
  };
</script>

<style scoped>
.tall-input {
  min-height: 120px;
}
</style>