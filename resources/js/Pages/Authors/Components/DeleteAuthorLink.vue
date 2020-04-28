<template>
  <delete-link :url="route('admin.books.authors.destroy', author.id)">
    <template #title>
      Delete author
    </template>
    <template>
      Are you sure you want to delete the author? This action cannot be undone.
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
    author: {
      type: Object,
      required: true,
    },
  },
}
</script>
