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
          <canvas :id="'chart-' + candidate.id" width="400" height="400"></canvas>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Chart from 'chart.js/auto';

export default {
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
