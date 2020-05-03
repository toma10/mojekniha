<template>
  <delete-link :url="route('admin.books.books.destroy', book.id)">
    <template #title>
      {{ __('books.delete') }}
    </template>
    <template>
      {{ __('books.deleteText') }}
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
