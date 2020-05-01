<template>
  <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5">
    <label
      :for="id"
      class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2"
    >
      {{ label }}
    </label>
    <div class="mt-2 sm:mt-0 sm:col-span-2">
      <div class="max-w-xs rounded-md shadow-sm">
        <select
          :id="id"
          class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
          :class="{'text-gray-500 cursor-not-allowed': 'disabled' in $attrs}"
          v-bind="$attrs"
          @change="$emit('input', [...value, parseInt($event.target.value)])"
        >
          <option />
          <option
            v-for="option in availableOptions"
            :key="option.key"
            :value="option.key"
          >
            {{ option.value }}
          </option>
        </select>
        <p
          v-if="errors.length"
          class="mt-1 text-red-500 text-xs italic"
        >
          {{ errors[0] }}
        </p>
      </div>
      <div
        v-if="selectedOptions.length > 0"
        class="mt-3 max-w-xs grid justify-items-start gap-3"
      >
        <tag
          v-for="option in selectedOptions"
          :key="option.key"
          type="accent"
          size="md"
        >
          <span v-text="option.value" />
          <button
            type="button"
            class="flex-shrink-0 ml-1.5 inline-flex text-indigo-500 focus:outline-none focus:text-indigo-700"
            @click="remove(option)"
          >
            <svg
              class="h-2 w-2"
              stroke="currentColor"
              fill="none"
              viewBox="0 0 8 8"
            >
              <path
                stroke-linecap="round"
                stroke-width="1.5"
                d="M1 1l6 6m0-6L1 7"
              />
            </svg>
          </button>
        </tag>
      </div>
    </div>
  </div>
</template>

<script>
import Tag from '@/Shared/Tag'

export default {
  components: {
    Tag,
  },
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
      type: Array,
      required: false,
      default: null,
    },
    options: {
      type: Array,
      required: true,
    },
    errors: {
      type: Array,
      required: false,
      default: () => [],
    },
  },
  computed: {
    availableOptions() {
      return this.options.filter(option => !this.value.includes(option.key))
    },
    selectedOptions() {
      return this.value.map(key => this.options.find(option => option.key === key))
    },
  },
  methods: {
    remove(option) {
      this.$emit('input', this.value.filter(key => key !== option.key))
    },
  },
}
</script>
