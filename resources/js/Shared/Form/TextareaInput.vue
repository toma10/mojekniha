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
    <div class="mt-2 sm:mt-0 sm:col-span-2">
      <div
        class="max-w-lg rounded-md shadow-sm"
      >
        <textarea-autosize
          :id="id"
          class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
          :class="{'text-gray-500 cursor-not-allowed': 'disabled' in $attrs}"
          v-bind="$attrs"
          :value="value"
          :rows="rows"
          @input="$emit('input', $event)"
        />
      </div>
      <p
        v-if="errors.length"
        class="mt-1 text-red-500 text-xs italic"
      >
        {{ errors[0] }}
      </p>
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
    rows: {
      type: Number,
      required: false,
      default: 5,
    },
  },
  computed: {
    required() {
      return 'required' in this.$attrs
    },
  },
}
</script>
