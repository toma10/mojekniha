<template>
  <div
    v-if="$page.flash"
    class="px-4 py-3 rounded relative"
    :class="$page.flash.class"
    role="alert"
  >
    <span>{{ $page.flash.message }}</span>
  </div>
</template>
