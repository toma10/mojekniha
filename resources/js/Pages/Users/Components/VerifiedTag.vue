<template>
  <tag :type="type">
    {{ label }}
  </tag>
</template>

<script>
import Tag from '@/Shared/Tag'

export default {
  components: {
    Tag,
  },
  props: {
    isVerified: {
      type: Boolean,
      required: true,
    },
  },
  computed: {
    type() {
      return this.isVerified ? 'success' : 'danger'
    },
    label() {
      return this.isVerified ? this.__('shared.verified') : this.__('shared.unverified')
    },
  },
}
</script>
