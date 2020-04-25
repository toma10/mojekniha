<template>
  <td
    class="px-6 py-4 text-sm leading-5 whitespace-no-wrap border-b border-gray-200"
    :class="{
      'text-right space-x-1': links,
      'text-gray-500': muted,
      'text-gray-900': !muted
    }"
  >
    <slot />
  </td>
</template>

<script>
export default {
  props: {
    links: {
      type: Boolean,
      required: false,
      default: false,
    },
    muted: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
}
</script>
