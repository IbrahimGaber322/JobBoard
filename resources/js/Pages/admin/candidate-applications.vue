<template>
    <div class="container mx-auto">
      <h1 class="text-3xl font-bold mb-4">Candidate Applications</h1>
  
      <div v-if="candidates.length === 0">
        <p>No candidates found.</p>
      </div>
  
      <div v-else class="flex flex-wrap -mx-4">
        <div v-for="candidate in candidates" :key="candidate.id" class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-4 mb-4">
          <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-2">{{ candidate.name }}</h2>
            <p class="text-gray-700">Total Applications: <span class="text-blue-600">{{ candidate.total_applications }}</span></p>
            <p class="text-gray-700">Accepted Applications: <span class="text-green-600">{{ candidate.accepted_applications }}</span></p>
            <p class="text-gray-700">Rejected Applications: <span class="text-red-600">{{ candidate.rejected_applications }}</span></p>
            <p class="text-gray-700">Pending Applications: <span class="text-yellow-600">{{ candidate.pending_applications }}</span></p>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      candidates: Array,
    },
  };
  </script>
  