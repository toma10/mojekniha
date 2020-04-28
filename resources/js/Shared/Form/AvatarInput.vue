<template>
  <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:pt-5">
    <span class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
      {{ label }}
    </span>
    <div class="mt-2 sm:mt-0 sm:col-span-2">
      <avatar :url="url" />
    </div>
  </div>
</template>

<script>
import Avatar from '@/Shared/Avatar'

export default {
  components: {
    Avatar,
  },
  props: {
    label: {
      type: String,
      default: 'Avatar',
    },
    url: {
      type: String,
      required: true,
    },
  },
}
</script>
