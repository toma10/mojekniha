<template>
  <x-button
    ref="button"
    :class="{'pointer-events-none': loading}"
    :disabled="loading"
    v-bind="$attrs"
    v-on="$listeners"
  >
    <span
      v-if="loading"
      class="mr-2"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="w-5 h-5 fill-current"
        viewBox="0 0 50 50"
      >
        <path d="M43.935 25.145c0-10.318-8.364-18.683-18.683-18.683-10.318 0-18.683 8.365-18.683 18.683h4.068c0-8.071 6.543-14.615 14.615-14.615s14.615 6.543 14.615 14.615h4.068z">
          <animateTransform
            attributeType="xml"
            attributeName="transform"
            type="rotate"
            from="0 25 25"
            to="360 25 25"
            dur="0.6s"
            repeatCount="indefinite"
          />
        </path>
      </svg>
    </span>
    <slot />
  </x-button>
</template>

<script>
import XButton from './XButton'

export default {
  components: {
    XButton,
  },
  inheritAttrs: false,
  props: {
    loading: {
      type: Boolean,
      required: true,
      default: false,
    },
  },
  methods: {
    focus() {
      this.$refs.button.focus()
    },
  },
}
</script>
