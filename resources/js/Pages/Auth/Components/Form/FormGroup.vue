<template>
  <div
    class="mt-6 first:mt-0"
    :class="{ 'flex items-center justify-between': center }"
  >
    <slot />
  </div>
</template>

<script>
export default {
  props: {
    center: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
}
</script>
