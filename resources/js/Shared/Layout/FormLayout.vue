<template>
  <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
      <slot name="header" />

      <div :class="{'mt-4': $page.flash}">
        <flash-message />
      </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
import FlashMessage from '@/Shared/FlashMessage'

export default {
  components: {
    FlashMessage,
  },
}
</script>
