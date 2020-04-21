<template>
  <span>{{ label }}</span>
</template>

<script>
export default {
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  computed: {
    label() {
      return this.user.is_admin ? 'Admin' : 'User'
    },
  },
}
</script>
