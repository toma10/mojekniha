<template>
  <span
    class="inline-flex rounded-md shadow-sm"
    :class="{'w-full': fullWidth}"
  >
    <button
      ref="button"
      :type="type"
      class="inline-flex items-center px-4 py-2 border text-sm leading-5 font-medium rounded-md focus:outline-none transition ease-in-out duration-150"
      :class="classes"
      v-bind="$attrs"
      v-on="$listeners"
    >
      <slot />
    </button>
  </span>
</template>

<script>
import cn from 'classnames'
import COLORS from './colors'

export default {
  inheritAttrs: false,
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
    fullWidth: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
  computed: {
    classes() {
      return cn(COLORS[this.color], { 'w-full justify-center': this.fullWidth })
    },
  },
  methods: {
    focus() {
      this.$refs.button.focus()
    },
  },
}
</script>
