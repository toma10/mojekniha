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
      <label :for="id">
        <div
          class="relative max-w-lg flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md cursor-pointer hover:border-blue-300 focus:border-blue-300"
          :class="draggedOver ? 'border-blue-300' : 'border-gray-300'"
          tabindex="0"
          @dragover.prevent="enter"
          @dragenter.prevent="enter"
          @dragleave.prevent="leave"
          @dragend.prevent="leave"
          @drop.prevent="drop"
          @keyup.enter="click"
          @keyup.space="click"
        >
          <div class="text-center">
            <svg
              class="mx-auto h-12 w-12 text-gray-400"
              stroke="currentColor"
              fill="none"
              viewBox="0 0 48 48"
            >
              <path
                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
            <div class="mt-1 text-sm text-gray-600">
              <span v-if="!file">Upload a file or drag and drop</span>
              <div v-else>
                <span>{{ file.name }}</span>
                <button
                  type="button"
                  class="absolute top-1 right-1 text-gray-400 p-1 hover:text-gray-600"
                  @click.prevent="clear"
                >
                  <svg
                    class="h-6 w-6"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd"
                      fill-rule="evenodd"
                    />
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </label>
      <input
        :id="id"
        ref="input"
        type="file"
        accept="image/jpeg"
        class="hidden"
        v-bind="$attrs"
        @change="change($event.target.files)"
      >
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
      type: File,
      required: false,
      default: null,
    },
    errors: {
      type: Array,
      required: false,
      default: () => [],
    },
  },
  data() {
    return {
      draggedOver: false,
      file: null,
    }
  },
  computed: {
    required() {
      return 'required' in this.$attrs
    },
  },
  methods: {
    change(files) {
      if (files.length) {
        this.file = files[0]
        this.$emit('input', this.file)
      } else {
        this.clear()
      }
    },
    clear() {
      this.file = null
      this.$emit('input', null)
    },
    enter() {
      this.draggedOver = true
    },
    leave() {
      this.draggedOver = false
    },
    drop(event) {
      this.change(event.dataTransfer.files)
      this.draggedOver = false
    },
    click() {
      this.$refs.input.click()
    },
  },
}
</script>
