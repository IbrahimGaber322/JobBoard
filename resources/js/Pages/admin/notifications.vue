<template>
  <div>
    <h2 class="text-xl font-bold mb-4">Notifications</h2>
    <ul>
      <li v-for="(notification, index) in notifications" :key="index" class="mb-2">
        <div class="flex items-center justify-between border rounded-lg p-4 text-sm bg-blue-100">
          <div class="flex items-center">
            <div class="w-4 h-4 bg-blue-500 rounded-full mr-2"></div> <!-- Colored dot -->
            <span class="font-semibold">Notification:</span>
            <span class="ml-2">{{ notification }}</span>
          </div>
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
