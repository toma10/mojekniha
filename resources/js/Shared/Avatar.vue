<template>
  <img
    class="h-10 w-10 rounded-full"
    :src="url"
    alt="Avatar image"
  >
</template>

<script>
export default {
  props: {
    url: {
      type: String,
      required: true,
    },
  },
}
</script>
