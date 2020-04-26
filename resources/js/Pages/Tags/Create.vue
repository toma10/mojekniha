<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>Create tag</h4-title>
      </template>

      <form @submit.prevent="submit">
        <form-content>
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
            :href="route('admin.books.tags.index')"
            color="plain"
          >
            Cancel
          </button-link>
          <loading-button
            type="submit"
            :loading="sending"
          >
            Create
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
import { FormContent, TextInput, ButtonGroup } from '@/Shared/Form'
import { ButtonLink } from '@/Shared/Link'
import { LoadingButton } from '@/Shared/Button'

export default {
  components: {
    Layout,
    Panel,
    H4Title,
    FormContent,
    TextInput,
    ButtonGroup,
    ButtonLink,
    LoadingButton,
  },
  props: {
    errors: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      sending: false,
      form: {
        name: '',
      },
    }
  },
  remember: 'form',
  methods: {
    async submit() {
      this.sending = true
      const response = await this.$inertia.post(this.route('admin.books.tags.store'), this.form)
      this.sending = false
    },
  },
}
</script>
