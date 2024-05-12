<template>
  <div class="flex justify-center items-center h-screen">
    <div class="max-w-lg w-full bg-white shadow-md rounded-lg p-8">
      <h1 class="text-2xl font-bold mb-4">{{ user.name }}'s Profile</h1>
      <p class="text-gray-700 mb-2">Email: {{ user.email }}</p>
      <p class="text-gray-700 mb-2">Telephone: {{ user.telephone }}</p>
      <p class="text-gray-700 mb-2">Bio: {{ user.bio }}</p>
      <p class="text-gray-700 mb-2">Location: {{ user.location }}</p>
      <p class="text-gray-700 mb-2">Number Of Employees: {{ user.no_of_employees }}</p>
      <div class="flex justify-end">
        <a :href="`/employer/profile/edit`" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out">Update Your Profile</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    user: {
      type: Object,
      required: true
    }
  }
}
</script>
