<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>
<template>
  <AuthenticatedLayout>
    <div class="flex justify-center items-center pt-52">
      <div class="max-w-lg w-full bg-white shadow-md rounded-lg p-8">

        <div class="relative w-20 h-20 rounded-full overflow-hidden mr-4 bg-gray-200 ">
          <img v-if="user && user.image" :src="user.image" alt="Profile Image"
            class="w-full h-full object-cover rounded-full">
          <img v-else :src="imageUrl" alt="Default Profile Image" class="w-full h-full object-cover rounded-full">
        </div>
        <h1 class="text-2xl font-bold mb-4">{{ user.name }}'s Profile</h1>
        <p class="text-gray-700 mb-2">Email: {{ user.email }}</p>
        <p class="text-gray-700 mb-2">Telephone: {{ user.telephone }}</p>
        <p class="text-gray-700 mb-2">Bio: {{ user.bio }}</p>
        <p class="text-gray-700 mb-2">Location: {{ user.location }}</p>
        <p class="text-gray-700 mb-2">Number Of Employees: {{ user.no_of_employees }}</p>
        <div class="flex justify-between mt-4">
          <a :href="`/employer/jobs`"
            class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out">View
            My Jobs</a>
          <a :href="`/profile/employer/edit`"
            class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out">Update
            My Profile</a>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
export default {
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      imageUrl: 'https://www.pngkey.com/png/full/73-730477_first-name-profile-image-placeholder-png.png' // Default image URL
    };
  }
}
</script>
