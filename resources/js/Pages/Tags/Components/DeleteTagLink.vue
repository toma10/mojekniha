<template>
  <delete-link :url="route('admin.books.tags.destroy', tag.id)">
    <template #title>
      Delete tag
    </template>
    <template>
      Are you sure you want to delete the tag? This action cannot be undone.
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
