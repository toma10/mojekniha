<template>
  <delete-link :url="route('admin.books.editions.destroy', edition.id)">
    <template #title>
      {{ __('editions.delete') }}
    </template>
    <template>
      {{ __('editions.deleteText') }}
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
