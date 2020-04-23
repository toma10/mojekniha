<template>
  <button
    type="button"
    class="font-medium text-indigo-600 text-sm leading-5 hover:text-indigo-500 focus:outline-none focus:underline transition ease-in-out duration-150"
    @click="$emit('click')"
  >
    <slot />
  </button>
</template>
