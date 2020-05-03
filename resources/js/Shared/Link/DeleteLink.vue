<template>
  <span>
    <link-button @click="modalOpen = true">
      {{ __('shared.delete') }}
    </link-button>
    <delete-modal
      :show="modalOpen"
      @confirm="confirm"
      @close="modalOpen = false"
    >
      <template #title>
        <slot name="title" />
      </template>
      <slot />
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
    url: {
      type: String,
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
      this.$inertia.delete(this.url)
    },
  },
}
</script>
