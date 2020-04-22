<template>
  <form-layout>
    <template v-slot:header>
      <logo />
      <h3-title class="mt-3">
        Sign in
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
          autofocus
        />
      </form-group>

      <form-group>
        <text-input
          id="password"
          v-model="form.password"
          type="password"
          label="Password"
          required
        />
      </form-group>

      <form-group center>
        <checkbox-input
          id="remember"
          v-model="form.remember"
          label="Remember Me"
        />
        <x-link :href="route('admin.auth.password.forgot')">
          Forgot your password?
        </x-link>
      </form-group>

      <form-group>
        <loading-button type="submit" :loading="sending" full-width>
          Sign in
        </loading-button>
      </form-group>
    </form>
  </form-layout>
</template>

<script>
import { FormLayout } from '@/Shared/Layout'
import Logo from '@/Shared/Logo'
import { H3Title } from '@/Shared/Title'

import { FormGroup, TextInput, CheckboxInput } from '@/Shared/Form'
import { LoadingButton } from '@/Shared/Button'
import XLink from '@/Shared/XLink'

export default {
  metaInfo: {
    title: 'Login',
  },
  components: {
    FormLayout,
    Logo,
    H3Title,
    FormGroup,
    TextInput,
    CheckboxInput,
    LoadingButton,
    XLink,
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
        email: '',
        password: '',
        remember: false,
      },
    }
  },
  methods: {
    async submit() {
      this.sending = true
      await this.$inertia.post(this.route('admin.auth.login'), this.form)
      this.sending = false
    },
  },
}
</script>
