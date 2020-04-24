<template>
  <div class="flex items-center md:ml-6">
    <on-click-outside :do="() => open = false">
      <div class="ml-3 relative">
        <div>
          <button
            class="max-w-xs flex items-center text-sm rounded-full focus:outline-none focus:shadow-outline"
            :aria-expanded="open"
            @click="open = !open"
            @keydown.esc.exact="open = false"
            @keydown.tab.shift="open = false"
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
            v-show="open"
            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg"
          >
            <div class="py-1 rounded-md bg-white shadow-xs">
              <a
                :href="route('admin.profile')"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition ease-in-out duration-150"
                @keydown.esc.exact="open = false"
              >Your Profile</a>
              <a
                :href="route('admin.auth.logout')"
                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:bg-gray-100 transition ease-in-out duration-150"
                @click.prevent="logout"
                @keydown.esc.exact="open = false"
                @keydown.tab.exact="open = false"
              >Sign out</a>
            </div>
          </div>
        </transition>
      </div>
    </on-click-outside>
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
      open: false,
      highlig: 0,
    }
  },
  methods: {
    logout() {
      this.$inertia.post(this.route('admin.auth.logout'))
    },
  },
}
</script>
