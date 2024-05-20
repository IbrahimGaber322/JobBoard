<template>
  <div>
      <Navbar/>
      <div class="relative bg-gradient-to-r">

        <div class="absolute bg-blue-600 rounded-full w-48 h-48 -top-16 -left-16 mix-blend-multiply opacity-50"></div>
          <div class="absolute bg-blue-500 w-64 h-64 transform rotate-45 -bottom-16 -right-32 mix-blend-multiply opacity-50"></div>
          <div class="absolute bg-blue-700 w-96 h-32 -bottom-8 -right-16 mix-blend-multiply opacity-50"></div>

          <div class="container mx-auto">
              <div class="flex justify-center">
                  <h1 class="text-4xl font-bold mt-5 text-blue-900">Candidates</h1>
              </div>

    <div v-if="candidates.length === 0">
      <p>No candidates found.</p>
    </div>

    <div v-else class="flex flex-wrap -mx-4">
      <div v-for="candidate in candidates" :key="candidate.id" class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-4 mb-4">
        <div class="bg-white shadow-md rounded-lg p-6">
          <h2 class="text-xl font-semibold mb-2">{{ candidate.name }}</h2>
          <canvas :id="'chart-' + candidate.id" width="400" height="400"></canvas>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</template>

<script>
import Chart from 'chart.js/auto';
import Navbar from './Navbar.vue';

export default {
  components:{
Navbar
  },
  props: {
    candidates: Array,
  },
  mounted() {
    this.renderCharts();
  },
  methods: {
    renderCharts() {
      this.candidates.forEach(candidate => {
        const ctx = document.getElementById('chart-' + candidate.id).getContext('2d');
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['Total', 'Accepted', 'Rejected', 'Pending'],
            datasets: [{
              label: 'Applications',
              data: [candidate.total_applications, candidate.accepted_applications, candidate.rejected_applications, candidate.pending_applications],
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
              ],
              borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
              ],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      });
    }
  }
};
</script>

<style scoped>
/* Add custom styles if needed */
</style>
