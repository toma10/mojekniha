<template>
  <portal
    v-if="show"
    to="modals"
  >
    <div
      class="z-50 fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center"
    >
      <transition
        enter-active-class="ease-out duration-300"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="ease-in duration-200"
        leave-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <div
          v-if="show"
          class="fixed inset-0 transition-opacity"
          @click="close"
        >
          <div class="absolute inset-0 bg-gray-700 opacity-75" />
        </div>
      </transition>
      <transition
        enter-active-class="ease-out duration-300"
        enter-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        enter-to-class="opacity-100 translate-y-0 sm:scale-100"
        leave-active-class="ease-in duration-200"
        leave-class="opacity-100 translate-y-0 sm:scale-100"
        leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
      >
        <div
          v-if="show"
          class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full"
        >
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg
                  class="h-6 w-6 text-red-600"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                  />
                </svg>
              </div>
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                  <slot name="title" />
                </h3>
                <div class="mt-2">
                  <p class="text-sm leading-5 text-gray-500">
                    <slot />
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse space-y-3 sm:space-y-0 sm:space-x-3 sm:space-x-reverse">
            <span class="flex w-full sm:w-auto">
              <loading-button
                ref="confirm"
                color="danger"
                full-width
                :loading="sending"
                @click="confirm"
              >
                Delete
              </loading-button>
            </span>
            <span class="flex w-full sm:w-auto">
              <x-button
                color="plain"
                full-width
                :disabled="sending"
                @click="close"
              >
                Cancel
              </x-button>
            </span>
          </div>
        </div>
      </transition>
    </div>
  </portal>
</template>

<script>
import { LoadingButton, XButton } from '@/Shared/Button'

export default {
  components: {
    LoadingButton,
    XButton,
  },
  props: {
    show: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      sending: false,
    }
  },
  watch: {
    show(show) {
      if (show) {
        this.$nextTick(() => {
          this.$refs.confirm.focus()
        })
      }
    },
  },
  created () {
    const escapeHandler = e => {
      if (e.keyCode === 27 && this.show) {
        this.close()
      }
    }
    document.addEventListener('keydown', escapeHandler)
    this.$once('hook:destroyed', () => {
      document.removeEventListener('keydown', escapeHandler)
    })
  },
  methods: {
    confirm() {
      this.sending = true
      this.$emit('confirm')
    },
    close() {
      this.$emit('close')
    },
  },
}
</script>
