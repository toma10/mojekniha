<template>
  <div class="h-screen flex overflow-hidden bg-gray-100">
    <mobile-menu
      :open="sidebarOpen"
      @close="sidebarOpen = false"
    />
    <desktop-menu />
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
          <div class="flex-1" />
          <user-dropdown class="ml-4" />
        </div>
      </div>
      <main class="flex-1 relative z-0 overflow-y-auto py-6 focus:outline-none">
        <x-content>
          <flash-message />

          <div :class="{'mt-4': $page.flash}">
            <slot />
          </div>
        </x-content>
      </main>
    </div>
  </div>
</template>

<script>
import MobileMenu from './MobileMenu'
import DesktopMenu from './DesktopMenu'
import UserDropdown from './UserDropdown'
import XContent from './XContent'
import FlashMessage from '@/Shared/FlashMessage'

export default {
  components: {
    MobileMenu,
    DesktopMenu,
    UserDropdown,
    XContent,
    FlashMessage,
  },
  data() {
    return {
      sidebarOpen: false,
    }
  },
  mounted () {
    const closeSidebarListener = (e) => {
      if (this.sidebarOpen & e.keyCode === 27) {
        this.sidebarOpen = false
      }
    }

    document.addEventListener('keydown', closeSidebarListener)
    this.$once('hook:beforeDestroy', () => {
      document.removeEventListener('keydown', closeSidebarListener)
    })
  },
}
</script>
