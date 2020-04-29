<template>
  <delete-link :url="route('admin.books.books.destroy', book.id)">
    <template #title>
      Delete book
    </template>
    <template>
      Are you sure you want to delete the book? This action cannot be undone.
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
    book: {
      type: Object,
      required: true,
    },
  },
}
</script>
