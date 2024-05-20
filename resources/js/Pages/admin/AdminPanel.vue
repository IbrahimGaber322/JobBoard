<template>
    <div>   
       <Navbar />

  <div class="relative bg-gradient-to-r  h-screen overflow-hidden">

    <div class="absolute bg-blue-600 rounded-full w-96 h-96 -top-32 -left-32 mix-blend-multiply opacity-50"></div>
    <div class="absolute bg-blue-500 w-64 h-64 transform rotate-45 -bottom-16 -right-32 mix-blend-multiply opacity-50"></div>
    <div class="absolute bg-blue-700 w-96 h-32 -bottom-8 -right-16 mix-blend-multiply opacity-50"></div>

    <div class="container mx-auto flex flex-col items-center justify-center h-screen">
      <h1 class="text-3xl font-bold mb-4">Welcome to Admin Panel</h1>
      <p class="mb-8">This is where you can manage various aspects of your application as an administrator.</p>

      <!-- Navigation Buttons -->
      <div class="flex flex-col mb-4">
      

        <button @click="redirectToAdminDashboard" class="mb-4 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none">
          Dashboard
        </button>
      </div>

    </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios';
import Navbar from './Navbar.vue';

export default {
  components: {
    Navbar // Register the Navbar component
  },
  
  methods: {
 

    redirectToAdminDashboard(){
      window.location.href = '/admin/dashboard';
    },

  }
}
</script>
