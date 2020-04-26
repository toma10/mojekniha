<template>
  <delete-link :url="route('admin.users.destroy', user.id)">
    <template #title>
      Delete user
    </template>
    <template>
      Are you sure you want to delete the user? This action cannot be undone.
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
