<template>
  <span
    class="inline-flex leading-5 font-semibold rounded-full"
    :class="classes"
  >
    <slot />
  </span>
</template>

<script>
import cn from 'classnames'

const TYPES = {
  default: 'bg-gray-100 text-gray-700',
  success: 'bg-green-100 text-green-800',
  danger: 'bg-red-100 text-red-800',
  accent: 'bg-indigo-100 text-indigo-700',
}

const SIZES = {
  sm: 'px-2 text-xs',
  md: 'px-3 py-1 text-sm',
}

export default {
  props: {
    type: {
      type: String,
      validator: value => Object.keys(TYPES).includes(value),
      required: false,
      default: 'default',
    },
    size: {
      type: String,
      validator: value => Object.keys(SIZES).includes(value),
      required: false,
      default: 'sm',
    },
  },
  computed: {
    classes() {
      return cn(TYPES[this.type], SIZES[this.size])
    },
  },
}
</script>
