<template>
  <delete-link :url="route('admin.books.genres.destroy', genre.id)">
    <template #title>
      {{ __('genres.delete') }}
    </template>
    <template>
      {{ __('genres.deleteText') }}
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
