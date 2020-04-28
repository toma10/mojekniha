<template>
  <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5">
    <label
      :for="id"
      class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2"
    >
      {{ label }}
      <span
        v-if="required"
        class="text-red-500"
      >*</span>
    </label>
    <div class="mt-1 sm:mt-0 sm:col-span-2">
      <div
        class="rounded-md shadow-sm"
        :class="wider ? 'max-w-lg' : 'max-w-xs'"
      >
        <input
          :id="id"
          :type="type"
          class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
          :class="{'text-gray-500 cursor-not-allowed': 'disabled' in $attrs}"
          v-bind="$attrs"
          :value="value"
          @change="$emit('input', $event.target.value)"
        >
        <p
          v-if="errors.length"
          class="mt-1 text-red-500 text-xs italic"
        >
          {{ errors[0] }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      required: true,
    },
    type: {
      type: String,
      required: false,
      default: 'text',
    },
    label: {
      type: String,
      required: false,
    },
    value: {
      type: String,
      required: true,
    },
    errors: {
      type: Array,
      required: false,
      default: () => [],
    },
    wider: {
      type: Boolean,
      required: false,
      default: false,
    },
  },
  computed: {
    required() {
      return 'required' in this.$attrs
    },
  },
}
</script>
