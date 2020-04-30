<template>
  <delete-link :url="route('admin.books.editions.destroy', edition.id)">
    <template #title>
      Delete edition
    </template>
    <template>
      Are you sure you want to delete the edition? This action cannot be undone.
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
    edition: {
      type: Object,
      required: true,
    },
  },
}
</script>
