<template>
  <delete-link :url="route('admin.books.bookBindings.destroy', bookBinding.id)">
    <template #title>
      Delete book binding
    </template>
    <template>
      Are you sure you want to delete the book binding? This action cannot be undone.
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
    bookBinding: {
      type: Object,
      required: true,
    },
  },
}
</script>
