<template>
  <div  class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-6">Jobs</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div v-for="job in jobs" :key="job.id">
        <div v-if="isEmployer || job.status === 'accepted'" class="bg-white rounded-lg shadow-md overflow-hidden p-6 flex flex-col justify-between items-center"> <!-- Adjusted flex properties -->
          <!-- Display user image if available -->
          <div v-if="job.employer && job.image" class="mb-6 flex justify-center">
            <div class="w-32 h-32 rounded-full overflow-hidden">
              <img :src="job.image" alt="User Image" class="w-full h-full object-cover rounded-full">
            </div>
          </div>
          <!-- If user has no image -->
          <div v-else class="mb-6 flex justify-center items-center w-32 h-32 rounded-full bg-gray-200">
            <span class="text-gray-500 text-lg font-semibold">Company Logo</span>
          </div>
          <!-- Job Title -->
          <h2 class="text-xl font-semibold mb-2">
            <a :href="`/job/${job.id}`" class="text-gray-900 hover:no-underline">{{ job.title }}</a>
          </h2>
          <!-- Job Description -->
          <div class="text-gray-700 mb-4">
            <p>{{ job.desc }}</p>
          </div>
          <!-- Job Details -->
          <div class="flex items-center justify-center w-full">
            <div class="flex flex-wrap">
              <div class="flex items-center mb-2 mr-4">
                <i class="fas fa-folder mr-1"></i>
                <span>{{ job.category }}</span>
              </div>
              <div class="flex items-center mb-2 mr-4">
                <i class="fas fa-clock mr-1"></i>
                <span>{{ job.work_type }}</span>
              </div>
              <div class="flex items-center mb-2">
                <i class="fas fa-map-marker-alt mr-1"></i>
                <span>{{ job.location }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import "@fortawesome/fontawesome-free/css/all.css";

export default {
  props: {
    jobs: {
      type: Array,
      required: true,
    },
    userRole: {
      type: String,
      required: true
    },
    userId: {
      type: String,
      required: true
    },
    isOwner: {
      type: Boolean,
      required: true
    },
  },
  computed: {
    isEmployer() {
      return this.userRole === 'employer' && this.isOwner === true; 
    },
    isCandidate(){
      return this.userRole === 'candidate';
    },
  }
};
</script>

<style scoped>
.overflow-hidden {
  overflow: hidden;
}

.rounded-full {
  border-radius: 50%;
}

/* Remove underline on job title hover */
.hover\:no-underline:hover {
  text-decoration: none;
}
</style>
