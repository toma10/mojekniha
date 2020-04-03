<template>
  <button
    :type="type"
    class="w-full relative flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md focus:outline-none transition duration-150 ease-in-out"
    :class="classes"
  >
    <slot />
  </button>
</template>

<script>
const COLORS = {
  primary: 'text-white bg-indigo-600 hover:bg-indigo-500 focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700,',
}

export default {
  props: {
    type: {
      type: String,
      required: false,
      default: 'button',
    },
    color: {
      type: String,
      validator: value => Object.keys(COLORS).includes(value),
      required: false,
      default: 'primary',
    },
  },
  computed: {
    classes() {
      return COLORS[this.color]
    },
  },
}
</script>
