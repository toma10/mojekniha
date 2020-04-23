<template>
  <span
    class="inline-flex rounded-md shadow-sm"
  >
    <inertia-link
      :href="href"
      class="inline-flex items-center px-4 py-2 border text-sm leading-5 font-medium rounded-md focus:outline-none transition ease-in-out duration-150"
      :class="classes"
    >
      <slot />
    </inertia-link>
  </span>
</template>

<script>
import COLORS from '@/Shared/Button/colors'

export default {
  props: {
    href: {
      type: String,
      required: true,
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
