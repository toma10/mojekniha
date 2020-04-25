<template>
  <tr :class="{'even:bg-gray-50': striped}">
    <slot />
  </tr>
</template>

<script>

export default {
  props: {
    striped: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
}
</script>
