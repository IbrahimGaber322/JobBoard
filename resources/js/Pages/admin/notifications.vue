<template>
  <div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Notifications</h2>
    <ul class="list-none">
      <li v-for="(notification, index) in notifications" :key="index" class="flex items-center justify-between bg-gray-100 rounded-lg p-4 shadow-sm mb-2">
        <div class="flex items-center mr-4">
          <div :class="{ 'bg-green-500': notification.read, 'bg-red-500': !notification.read }" class="w-4 h-4 rounded-full"></div>
          <span class="ml-2">{{ notification }}</span>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    notifications: {
      type: Array,
      required: true
    }
  }
}
</script>
