<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>{{ __('users.edit') }}</h4-title>
      </template>

      <form @submit.prevent="submit">
        <form-content>
          <id-input :id="user.id" />

          <text-input
            id="name"
            v-model="form.name"
            :errors="errors.name"
            :label="__('shared.name')"
            required
            autofocus
          />

          <avatar-input :url="user.avatar_url" />

          <text-input
            id="username"
            v-model="form.username"
            :errors="errors.username"
            :label="__('shared.username')"
            required
          />

          <text-input
            id="email"
            v-model="form.email"
            :errors="errors.email"
            type="email"
            :label="__('shared.email')"
            wider
            disabled
          />
        </form-content>

        <button-group>
          <button-link
            :href="route('admin.users.show', user.id)"
            color="plain"
          >
            {{ __('shared.cancel') }}
          </button-link>
          <loading-button
            type="submit"
            :loading="sending"
          >
            {{ __('shared.save') }}
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
