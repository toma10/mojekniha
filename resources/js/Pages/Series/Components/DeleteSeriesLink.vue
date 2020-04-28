<template>
  <delete-link :url="route('admin.books.series.destroy', series.id)">
    <template #title>
      Delete series
    </template>
    <template>
      Are you sure you want to delete the series? This action cannot be undone.
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
