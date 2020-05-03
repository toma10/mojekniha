<template>
  <delete-link :url="route('admin.books.bookBindings.destroy', bookBinding.id)">
    <template #title>
      {{ __('bookBindings.delete') }}
    </template>
    <template>
      {{ __('bookBindings.deleteText') }}
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
