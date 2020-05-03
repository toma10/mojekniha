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
      return this.user.is_admin ? this.__('shared.admin') : this.__('shared.user')
    },
  },
}
</script>
