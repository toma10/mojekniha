<template>
  <form-layout>
    <template v-slot:header>
      <logo />
      <h3-title class="mt-3">
        Reset Password
      </h3-title>
    </template>

    <form @submit.prevent="submit">
      <form-group>
        <text-input
          id="email"
          v-model="form.email"
          :errors="errors.email"
          type="email"
          label="Email"
          required
        />
      </form-group>

      <form-group>
        <text-input
          id="password"
          v-model="form.password"
          :errors="errors.password"
          type="password"
          label="Password"
          required
        />
      </form-group>

      <form-group>
        <text-input
          id="password-confirm"
          v-model="form.password_confirmation"
          :errors="errors.password_confirmation"
          type="password"
          label="Confirm Password"
          required
        />
      </form-group>

      <form-group>
        <loading-button type="submit" :loading="sending" full-width>
          Reset Password
        </loading-button>
      </form-group>
    </form>
  </form-layout>
</template>

<script>
import { FormLayout } from '@/Shared/Layout'

import { H3Title } from '@/Shared/Title'
import { FormGroup, TextInput } from '@/Shared/Form'
import { LoadingButton } from '@/Shared/Button'

export default {
  metaInfo: {
    title: 'Reset Password',
  },
  components: {
    FormLayout,
    Logo,
    H3Title,
    FormGroup,
    TextInput,
    LoadingButton,
  },
  props: {
    errors: {
      type: Object,
      required: true,
    },
    token: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      sending: false,
      form: {
        email: '',
        password: '',
        password_confirmation: '',
      },
    }
  },
  methods: {
    async submit() {
      this.sending = true
      await this.$inertia.post(this.route('admin.auth.password.update'), {
        token: this.token,
        ...this.form,
      })
      this.sending = false
    },
  },
}
</script>
