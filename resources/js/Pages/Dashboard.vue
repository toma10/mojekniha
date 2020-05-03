<template>
  <layout>
    <h2-title class="text-2xl font-semibold text-gray-900">
      {{ __('shared.dashboard') }}
    </h2-title>
  </layout>
</template>

<script>
import Layout from '@/Shared/Layout'
import { H2Title } from '@/Shared/Title'

export default {
  components: {
    Layout,
    H2Title,
  },
}
</script>
