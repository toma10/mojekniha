<template>
  <div>
    <label
      v-if="hasLabel"
      :for="id"
      class="block text-sm font-medium leading-5 text-gray-700"
    >
      {{ label }}
    </label>
    <div
      class="rounded-md shadow-sm"
      :class="{ 'mt-1': hasLabel }"
    >
      <input
        :id="id"
        :type="type"
        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
        v-bind="$attrs"
        :value="value"
        @change="$emit('input', $event.target.value)"
      >
    </div>
    <p
      v-if="errors.length"
      class="mt-1 text-red-500 text-xs italic"
    >
      {{ errors[0] }}
    </p>
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
  },
  computed: {
    hasLabel() {
      return !! this.label
    },
  },
}
</script>
