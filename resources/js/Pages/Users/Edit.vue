<template>
  <layout>
    <panel>
      <template v-slot:header>
        <h4-title>Edit user</h4-title>
      </template>

      <form @submit.prevent="submit">
        <form-content>
          <id-input :id="user.id" />

          <text-input
            id="name"
            v-model="form.name"
            :errors="errors.name"
            label="Name"
            required
            autofocus
          />

          <avatar-input :url="user.avatar_url" />

          <text-input
            id="username"
            v-model="form.username"
            :errors="errors.username"
            label="Username"
            required
          />

          <text-input
            id="email"
            v-model="form.email"
            :errors="errors.email"
            type="email"
            label="Email"
            wider
            required
          />
        </form-content>

        <button-group>
          <button-link
            :href="route('admin.users.show', user.id)"
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
import { FormContent, IdInput, TextInput, AvatarInput, ButtonGroup } from '@/Shared/Form'
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
    AvatarInput,
    ButtonGroup,
    ButtonLink,
    LoadingButton,
  },
  props: {
    user: {
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
        name: this.user.name,
        username: this.user.username,
        email: this.user.email,
      },
    }
  },
  methods: {
    async submit() {
      this.sending = true
      await this.$inertia.put(this.route('admin.users.update', this.user.id), this.form)
      this.sending = false
    },
  },
}
</script>
