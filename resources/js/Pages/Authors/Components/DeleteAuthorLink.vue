<template>
  <delete-link :url="route('admin.books.authors.destroy', author.id)">
    <template #title>
      {{ __('authors.delete') }}
    </template>
    <template>
      {{ __('authors.deleteText') }}
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
