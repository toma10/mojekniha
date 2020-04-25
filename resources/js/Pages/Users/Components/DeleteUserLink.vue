<template>
  <span>
    <link-button @click="modalOpen = true">
      Delete
    </link-button>
    <delete-modal
      :show="modalOpen"
      @confirm="confirm"
      @close="modalOpen = false"
    >
      <template #title>
        Delete user
      </template>
      <template>
        Are you sure you want to delete the user? This action cannot be undone.
      </template>
    </delete-modal>
  </span>
</template>

<script>
import { LinkButton } from '@/Shared/Button'
import DeleteModal from '@/Shared/DeleteModal'

export default {
  components: {
    LinkButton,
    DeleteModal,
  },
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      modalOpen: false,
    }
  },
  methods: {
    confirm() {
      this.$inertia.delete(this.route('admin.users.destroy', this.user.id))
    },
  },
}
</script>
