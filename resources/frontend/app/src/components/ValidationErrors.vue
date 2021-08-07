<template>
  <ul class="error-messages">
    <li v-for="errorMessage in errorMessages" :key="errorMessage">
      {{ errorMessage }}
    </li>
  </ul>
</template>

<script>
export default {
  name: 'McvValidationErrors',
  props: {
    validationErrors: {
      type: Object,
      required: true,
    },
  },
  computed: {
    errorMessages() {
      return Object.keys(this.validationErrors).map((name) => {
        const messages = this.validationErrors[name].join(', ')
        return `${messages}`
        // return `${name} ${messages}`
      })
    },
  },
}
</script>

<style>
.error-messages {
  color: #b85c5c !important;
  font-weight: bold;
}
</style>
