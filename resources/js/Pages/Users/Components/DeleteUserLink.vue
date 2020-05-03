<template>
  <delete-link :url="route('admin.users.destroy', user.id)">
    <template #title>
      {{ __('users.delete') }}
    </template>
    <template>
      {{ __('users.deleteText') }}
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
    user: {
      type: Object,
      required: true,
    },
  },
}
</script>
