<template>
  <div class="container mx-auto">
    <h1 class="text-3xl font-bold mb-4">Employee Job Statistics</h1>

    <div v-if="employees.length === 0">
      <p>No employees found.</p>
    </div>

    <div v-else>
      <div class="flex flex-wrap"> <!-- Use flexbox with wrap to ensure charts wrap to next line if needed -->
        <div v-for="employee in employees" :key="employee.id" class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-4 mb-8"> <!-- Adjusted width and margin-bottom -->
          <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-2">{{ employee.name }}</h2>
            <canvas :id="'chart-' + employee.id" width="200" height="200"></canvas> <!-- Adjusted width and height -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Chart from 'chart.js/auto';

export default {
  props: {
    employees: Array,
  },
  mounted() {
    this.renderCharts();
  },
  methods: {
    renderCharts() {
      this.employees.forEach(employee => {
        const ctx = document.getElementById('chart-' + employee.id).getContext('2d');
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['Total Jobs', 'Accepted Jobs', 'Rejected Jobs', 'Pending Jobs'],
            datasets: [{
              label: 'Job Count',
              data: [employee.total_jobs, employee.accepted_jobs, employee.rejected_jobs, employee.pending_jobs],
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


