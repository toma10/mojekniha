<template>
  <div class="bg-white overflow-hidden shadow rounded-lg">
    <div
      v-if="hasHeader"
      class="border-b border-gray-200 px-4 py-5 sm:px-6"
    >
      <slot name="header" />
    </div>
    <div class="px-4 py-5 sm:p-6">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  computed: {
    hasHeader() {
      return !!this.$slots['header']
    },
  },
}
</script>
