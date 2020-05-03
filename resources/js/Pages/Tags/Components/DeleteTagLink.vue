<template>
  <delete-link :url="route('admin.books.tags.destroy', tag.id)">
    <template #title>
      {{ __('tags.delete') }}
    </template>
    <template>
      {{ __('tags.deleteText') }}
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
    tag: {
      type: Object,
      required: true,
    },
  },
}
</script>
