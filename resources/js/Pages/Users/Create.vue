<template>
  <layout>
    <panel>
      <template v-slot:header>
        <h4-title>Create user</h4-title>
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
            :href="route('admin.users.index')"
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
        username: '',
        email: '',
      },
    }
  },
  remember: 'form',
  methods: {
    async submit() {
      this.sending = true
      const response = await this.$inertia.post(this.route('admin.users.store'), this.form)
      this.sending = false
    },
  },
}
</script>
