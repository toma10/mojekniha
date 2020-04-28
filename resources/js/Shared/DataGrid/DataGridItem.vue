<template>
  <div :class="{'col-span-2' : fullWidth}">
    <h6 class="text-sm">
      {{ title }}
    </h6>
    <div class="text-sm text-gray-500">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
      required: true,
    },
    fullWidth: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
}
</script>
