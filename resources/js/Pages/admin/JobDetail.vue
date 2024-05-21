<template>
  <div>   
      <Navbar />

      <div class="relative bg-gradient-to-r h-screen overflow">

          <div class="absolute bg-blue-600 rounded-full w-96 h-96 -top-32 -left-32 mix-blend-multiply opacity-50"></div>
          <div class="absolute bg-blue-500 w-64 h-64 transform rotate-45 -bottom-16 -right-32 mix-blend-multiply opacity-50"></div>
          <div class="absolute bg-blue-700 w-96 h-32 -bottom-8 -right-16 mix-blend-multiply opacity-50"></div>
      
          <div class="flex justify-center mt-8">
              <div class="w-1/3 pr-8">
                  <!-- Conditional rendering of image or icon -->
                  <img v-if="job.image" :src="job.image" alt="Job Image" class="w-full h-auto rounded-lg mb-4">
                  <i v-else class="fa fa-icon-name"></i> 
              </div>
      
              <div class="w-2/3">
                  <div class="job-detail p-4 text-left">
                      <h1 class="text-4xl font-bold mt-3 mb-6 text-blue-900">{{ job.title }}</h1>
                      <div class="max-w-md">
                          <p class="mb-2"><span class="font-semibold text-blue-600">Description:</span> {{ job.desc }}</p>
                          <p class="mb-2"><span class="font-semibold text-blue-600">Experience Level:</span> {{ job.experience_level }}</p>
                          <p class="mb-2"><span class="font-semibold text-blue-600">Responsibilities:</span> {{ job.responsibilities }}</p>
                          <p class="mb-2"><span class="font-semibold text-blue-600">Skills:</span> {{ job.skills }}</p>
                          <p class="mb-2"><span class="font-semibold text-blue-600">Salary Range:</span> {{ job.salary_range }}</p>
                          <p class="mb-2"><span class="font-semibold text-blue-600">Category:</span> {{ job.category }}</p>
                          <p class="mb-2"><span class="font-semibold text-blue-600">Location:</span> {{ job.location }}</p>
                          <p class="mb-2"><span class="font-semibold text-blue-600">Work Type:</span> {{ job.work_type }}</p>
                          <p class="mb-2"><span class="font-semibold text-blue-600">Deadline:</span> {{ job.deadline }}</p>
                          <p class="mb-2"><span class="font-semibold text-blue-600">Company Name:</span> {{ job.company_name }}</p>
                          <p class="mb-2"><span class="font-semibold text-blue-600">Employer who posted the job:</span> {{ employer.name }}</p>
                          <p class="mb-2"><span class="font-semibold text-blue-600">Employer Email:</span> {{ employer.email }}</p>
                          <!-- Display the number of candidates who have applied -->
                          <p class="mb-2"><span class="font-semibold text-blue-600">Number of Candidates Applied:</span> {{ numApplications }}</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import Navbar from './Navbar.vue';

export default {
  components: {
      Navbar 
  },
  props: ['job', 'employer', 'numApplications'], // Receive the number of applications as a prop
}
</script>
