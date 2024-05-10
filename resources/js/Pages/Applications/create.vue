<template>
  <div>
    <form @submit.prevent="submitForm">
      <div>
        <label for="name">Name:</label>
        <input type="text" id="name" v-model="form.name">
      </div>
      <div>
        <label for="description">Description:</label>
        <textarea id="description" v-model="form.description"></textarea>
      </div>
      <div>
        <button type="submit">Save</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: '',
        description: ''
      }
    };
  },
  methods: {
    submitForm() {
      this.$inertia.post(route('applications.store'), this.form);
    }
  }
}
</script>
