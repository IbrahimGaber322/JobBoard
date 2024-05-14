<template>
  <div>
    <h2>Notifications</h2>
    <ul>
      <li v-for="(notification, index) in notifications" :key="index">
        {{ notification }}
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
