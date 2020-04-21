<template>
  <transition leave-active-class="duration-300">
    <div
      v-show="open"
      class="md:hidden"
    >
      <transition
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <div
          v-show="open"
          class="fixed inset-0 z-30 transition-opacity ease-linear duration-300"
          @click="$emit('close')"
        >
          <div class="absolute inset-0 bg-gray-600 opacity-75" />
        </div>
      </transition>

      <div class="fixed inset-0 flex z-40">
        <transition
          enter-class="-translate-x-full"
          enter-to-class="translate-x-0"
          leave-class="translate-x-0"
          leave-to-class="-translate-x-full"
        >
          <div
            v-show="open"
            class="flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-indigo-800 transform ease-in-out duration-300"
          >
            <div class="absolute top-0 right-0 -mr-14 p-1">
              <button
                v-show="open"
                class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600"
                @click="$emit('close')"
              >
                <svg
                  class="h-6 w-6 text-white"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
            <div class="flex-shrink-0 flex items-center px-4">
              <h1 class="text-xl text-white font-semibold">
                MojeKniha
              </h1>
            </div>
            <div class="mt-5 flex-1 h-0 overflow-y-auto">
              <navigation class="px-2" />
            </div>
          </div>
        </transition>
        <div class="flex-shrink-0 w-14" />
      </div>
    </div>
  </transition>
</template>

<script>
import Navigation from './Navigation'

export default {
  components: {
    Navigation,
  },
  props: {
    open: {
      type: Boolean,
      required: true,
    },
  },
}
</script>
