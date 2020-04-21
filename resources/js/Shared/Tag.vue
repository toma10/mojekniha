<template>
  <span
    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
    :class="classes"
  >
    <slot />
  </span>
</template>

<script>
const TYPES = {
  default: 'bg-gray-100 text-gray-700',
  success: 'bg-green-100 text-green-800',
  danger: 'bg-red-100 text-red-800',
}

export default {
  props: {
    type: {
      type: String,
      required: false,
      default: 'default',
    },
  },
  computed: {
    classes() {
      return TYPES[this.type]
    },
  },
}
</script>
