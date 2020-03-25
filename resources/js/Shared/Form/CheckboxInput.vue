<template>
  <div class="flex items-center">
    <input
      :id="id"
      type="checkbox"
      class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
      v-bind="$attrs"
      :checked="checked"
      @change="$emit('change', $event.target.checked)"
    >
    <label
      :for="id"
      class="ml-2 block text-sm leading-5 text-gray-900"
    >
      {{ label }}
    </label>
  </div>
</template>

<script>
export default {
  inheritAttrs: false,
  model: {
    prop: 'checked',
    event: 'change',
  },
  props: {
    id: {
      type: String,
      required: true,
    },
    label: {
      type: String,
      required: true,
    },
    checked: {
      type: Boolean,
      required: true,
    },
  },
}
</script>
