<template>
  <div class="h-screen flex overflow-hidden bg-gray-100">
    <transition leave-active-class="duration-300">
      <div
        v-show="sidebarOpen"
        class="md:hidden"
      >
        <transition
          enter-class="opacity-0"
          enter-to-class="opacity-100"
          leave-class="opacity-100"
          leave-to-class="opacity-0"
        >
          <div
            v-show="sidebarOpen"
            class="fixed inset-0 z-30 transition-opacity ease-linear duration-300"
            @click="sidebarOpen = false"
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
              v-show="sidebarOpen"
              class="flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-indigo-800 transform ease-in-out duration-300"
            >
              <div class="absolute top-0 right-0 -mr-14 p-1">
                <button
                  v-show="sidebarOpen"
                  class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600"
                  @click="sidebarOpen = false"
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
                <nav class="px-2">
                  <a
                    href="#"
                    class="group flex items-center px-2 py-2 text-base leading-6 font-medium rounded-md text-white bg-indigo-900 focus:outline-none focus:bg-indigo-700 transition ease-in-out duration-150"
                  >
                    <svg
                      class="mr-4 h-6 w-6 text-indigo-400 group-hover:text-indigo-300 group-focus:text-indigo-300 transition ease-in-out duration-150"
                      stroke="currentColor"
                      fill="none"
                      viewBox="0 0 24 24"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6"
                      />
                    </svg>
                    Dashboard
                  </a>
                </nav>
              </div>
            </div>
          </transition>
          <div class="flex-shrink-0 w-14" />
        </div>
      </div>
    </transition>

    <div class="hidden md:flex md:flex-shrink-0">
      <div class="flex flex-col w-64 bg-indigo-800 pt-5 pb-4">
        <div class="flex items-center flex-shrink-0 px-4">
          <h1 class="text-xl text-white font-semibold">
            MojeKniha
          </h1>
        </div>
        <div class="mt-5 h-0 flex-1 flex flex-col overflow-y-auto">
          <nav class="flex-1 px-2 bg-indigo-800">
            <a
              href="#"
              class="group flex items-center px-2 py-2 text-sm leading-5 font-medium text-white rounded-md bg-indigo-900 focus:outline-none focus:bg-indigo-700 transition ease-in-out duration-150"
            >
              <svg
                class="mr-3 h-6 w-6 text-indigo-400 group-focus:text-indigo-300 transition ease-in-out duration-150"
                stroke="currentColor"
                fill="none"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M3 12l9-9 9 9M5 10v10a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V10M9 21h6"
                />
              </svg>
              Dashboard
            </a>
          </nav>
        </div>
      </div>
    </div>
    <div class="flex flex-col w-0 flex-1 overflow-hidden">
      <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
        <button
          class="px-4 border-r border-gray-200 text-gray-500 focus:outline-none focus:bg-gray-100 focus:text-gray-600 md:hidden"
          @click.stop="sidebarOpen = true"
        >
          <svg
            class="h-6 w-6"
            stroke="currentColor"
            fill="none"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h7"
            />
          </svg>
        </button>
        <div class="flex-1 px-4 flex justify-between">
          <div class="flex-1 flex" />
          <div class="ml-4 flex items-center md:ml-6">
            <on-click-outside :do="() => dropdownOpen = false">
              <div class="ml-3 relative">
                <div>
                  <button
                    class="max-w-xs flex items-center text-sm rounded-full focus:outline-none focus:shadow-outline"
                    @click="dropdownOpen = !dropdownOpen"
                  >
                    <img
                      class="h-8 w-8 rounded-full"
                      :src="$page.auth.user.avatar_url"
                      alt="Avatar"
                    >
                  </button>
                </div>
                <transition
                  enter-active-class="transition ease-out duration-100"
                  enter-class="transform opacity-0 scale-95"
                  enter-to-class="transform opacity-100 scale-100"
                  leave-active-class="transition ease-in duration-75"
                  leave-class="transform opacity-100 scale-100"
                  leave-to-class="transform opacity-0 scale-95"
                >
                  <div
                    v-show="dropdownOpen"
                    class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg"
                  >
                    <div class="py-1 rounded-md bg-white shadow-xs">
                      <a
                        href="#"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150"
                      >Your Profile</a>
                      <a
                        :href="route('admin.auth.logout')"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150"
                        @click.prevent="logout"
                      >Sign out</a>
                    </div>
                  </div>
                </transition>
              </div>
            </on-click-outside>
          </div>
        </div>
      </div>
      <main class="flex-1 relative z-0 overflow-y-auto py-6 focus:outline-none">
        <slot />
      </main>
    </div>
  </div>
</template>

<script>
import OnClickOutside from '@/Shared/OnClickOutside'

export default {
  components: {
    OnClickOutside,
  },
  data() {
    return {
      sidebarOpen: false,
      dropdownOpen: false,
    }
  },
  methods: {
    logout() {
      this.$inertia.post(this.route('admin.auth.logout'))
    },
  },
}
</script>
