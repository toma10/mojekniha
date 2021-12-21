<template>
  <div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 bg-indigo-800 pt-5 pb-4">
      <div class="flex items-center flex-shrink-0 px-4">
        <inertia-link :href="route('admin.dashboard')">
          <h1 class="text-xl text-white font-semibold">
            MojeKniha
          </h1>
        </inertia-link>
      </div>
      <div class="mt-5 h-0 flex-1 flex flex-col overflow-y-auto">
        <navigation class="flex-1 px-2 bg-indigo-800" />
      </div>
    </div>
  </div>
</template>

<script>
import Navigation from './Navigation'

export default {
  components: {
    Navigation,
  },
}
</script>
