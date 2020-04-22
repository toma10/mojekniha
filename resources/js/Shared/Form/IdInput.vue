<template>
  <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:pt-5">
    <span class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
      Id
    </span>
    <div class="mt-1 sm:mt-0 sm:col-span-2">
      <span class="sm:text-sm text-gray-500">{{ id }}</span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
}
</script>
