<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>Edit tag</h4-title>
      </template>

      <form @submit.prevent="submit">
        <form-content>
          <id-input :id="tag.id" />

          <text-input
            id="name"
            v-model="form.name"
            :errors="errors.name"
            label="Name"
            required
            autofocus
          />
        </form-content>

        <button-group>
          <button-link
            :href="route('admin.books.tags.show', tag.id)"
            color="plain"
          >
            Cancel
          </button-link>
          <loading-button
            type="submit"
            :loading="sending"
          >
            Save
          </loading-button>
        </button-group>
      </form>
    </panel>
  </layout>
</template>

<script>
import Layout from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { H4Title } from '@/Shared/Title'
import { FormContent, IdInput, TextInput, ButtonGroup } from '@/Shared/Form'
import { ButtonLink } from '@/Shared/Link'
import { LoadingButton } from '@/Shared/Button'

export default {
  components: {
    Layout,
    Panel,
    H4Title,
    FormContent,
    IdInput,
    TextInput,
    ButtonGroup,
    ButtonLink,
    LoadingButton,
  },
  props: {
    tag: {
      type: Object,
      required: true,
    },
    errors: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      sending: false,
      form: {
        name: this.tag.name,
      },
    }
  },
  remember: 'form',
  methods: {
    async submit() {
      this.sending = true
      const response = await this.$inertia.put(this.route('admin.books.tags.update', this.tag.id), this.form)
      this.sending = false
    },
  },
}
</script>
