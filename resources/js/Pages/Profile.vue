<template>
  <layout>
    <div class="space-y-8">
      <panel>
        <template #header>
          <h4-title>{{ __('profile.edit') }}</h4-title>
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
            <loading-button
              type="submit"
              :loading="sending"
            >
              {{ __('shared.save') }}
            </loading-button>
          </button-group>
        </form>
      </panel>

      <panel>
        <template #header>
          <h4-title>{{ __('profile.changePassword') }}</h4-title>
        </template>

        <form @submit.prevent="submitChangePassword">
          <input
            :value="form.email"
            type="text"
            autocomplete="email"
            hidden
          />

          <form-content>
            <text-input
              id="password"
              v-model="formChangePassword.password"
              :errors="errors.password"
              type="password"
              :label="__('profile.currentPassword')"
              autocomplete="current-password"
              required
            />

            <text-input
              id="new_password"
              v-model="formChangePassword.new_password"
              :errors="errors.new_password"
              type="password"
              :label="__('profile.newPassword')"
              autocomplete="new-password"
              required
            />

            <text-input
              id="new_password_confirmation"
              v-model="formChangePassword.new_password_confirmation"
              :errors="errors.new_password_confirmation"
              type="password"
              :label="__('profile.confirmNewPassword')"
              autocomplete="new-password"
              required
            />
          </form-content>

          <button-group>
            <loading-button
              type="submit"
              :loading="sendingChangePassword"
            >
              {{ __('shared.save') }}
            </loading-button>
          </button-group>
        </form>
      </panel>
    </div>
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
      sendingChangePassword: false,
      form: {
        name: this.user.name,
        username: this.user.username,
        email: this.user.email,
      },
      formChangePassword: {
        password: '',
        new_password: '',
        new_password_confirmation: '',
      },
    }
  },
  methods: {
    async submit() {
      this.sending = true
      await this.$inertia.post(this.route('admin.profile'), this.form)
      this.sending = false
    },
    async submitChangePassword() {
      this.sendingChangePassword = true
      await this.$inertia.post(this.route('admin.password'), this.formChangePassword)
      this.sendingChangePassword = false
    },
  },
}
</script>
