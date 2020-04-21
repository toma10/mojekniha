<template>
  <layout>
    <x-content>
      <h2-title class="text-2xl font-semibold text-gray-900">
        Dashboard
      </h2-title>
    </x-content>
  </layout>
</template>

<script>
import Layout, { XContent } from '@/Shared/Layout'
import { H2Title } from '@/Shared/Title'

export default {
  components: {
    Layout,
    XContent,
    H2Title,
  },
}
</script>
