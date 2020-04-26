<template>
  <delete-link :url="route('admin.books.genres.destroy', genre.id)">
    <template #title>
      Delete genre
    </template>
    <template>
      Are you sure you want to delete the genre? This action cannot be undone.
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
    genre: {
      type: Object,
      required: true,
    },
  },
}
</script>
