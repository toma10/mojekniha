<template>
  <div
    v-if="hasPages"
    class="border-t border-gray-200 px-4 flex items-center justify-between sm:px-0"
  >
    <div class="w-0 flex-1 flex">
      <inertia-link
        v-if="links.previous.url !== null"
        :href="links.previous.url"
        class="-mt-px border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm leading-5 font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-400 transition ease-in-out duration-150"
      >
        <svg
          class="mr-3 h-5 w-5 text-gray-400"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            fill-rule="evenodd"
            d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
            clip-rule="evenodd"
          />
        </svg>
        {{ links.previous.label }}
      </inertia-link>
      <span
        v-else
        class="-mt-px border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm leading-5 font-medium text-gray-500"
      >
        <svg
          class="mr-3 h-5 w-5 text-gray-400"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            fill-rule="evenodd"
            d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
            clip-rule="evenodd"
          />
        </svg>
        {{ links.previous.label }}
      </span>
    </div>
    <div class="hidden md:flex">
      <template v-for="(link, index) in links.pages">
        <inertia-link
          v-if="link.url"
          :key="index"
          :href="link.url"
          class="-mt-px border-t-2 pt-4 px-4 inline-flex items-center text-sm leading-5 font-medium focus:outline-none transition ease-in-out duration-150"
          :class="link.active ? 'border-indigo-500 text-indigo-600 focus:text-indigo-800 focus:border-indigo-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-400'"
        >
          {{ link.label }}
        </inertia-link>
        <span
          v-else
          :key="index"
          class="-mt-px border-t-2 border-transparent pt-4 px-4 inline-flex items-center text-sm leading-5 font-medium text-gray-500"
        >
          {{ link.label }}
        </span>
      </template>
    </div>
    <div class="w-0 flex-1 flex justify-end">
      <inertia-link
        v-if="links.next.url !== null"
        :href="links.next.url"
        class="-mt-px border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm leading-5 font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-400 transition ease-in-out duration-150"
      >
        {{ links.next.label }}
        <svg
          class="ml-3 h-5 w-5 text-gray-400"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            fill-rule="evenodd"
            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
            clip-rule="evenodd"
          />
        </svg>
      </inertia-link>
      <span
        v-else
        class="-mt-px border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm leading-5 font-medium text-gray-500"
      >
        {{ links.next.label }}
        <svg
          class="ml-3 h-5 w-5 text-gray-400"
          fill="currentColor"
          viewBox="0 0 20 20"
        >
          <path
            fill-rule="evenodd"
            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
            clip-rule="evenodd"
          />
        </svg>
      </span>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    links: {
      type: Object,
      required: true,
    },
  },
  computed: {
    hasPages() {
      return this.links.pages.length > 1
    },
  },
}
</script>
