<template>
  <delete-link :url="route('admin.books.series.destroy', series.id)">
    <template #title>
      {{ __('series.delete') }}
    </template>
    <template>
      {{ __('series.deleteText') }}
    </template>
  </delete-link>
</template>

<script>
import { DeleteLink } from '@/Shared/Link'

export default {
  components: {
    DeleteLink,
  },
  props: {
    series: {
      type: Object,
      required: true,
    },
  },
}
</script>
