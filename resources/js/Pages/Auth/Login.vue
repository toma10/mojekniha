<template>
  <layout>
    <template #header>
      <logo />
      <h3-title class="mt-3">
        {{ __('auth.signIn') }}
      </h3-title>
    </template>

    <form @submit.prevent="submit">
      <form-group>
        <text-input
          id="email"
          v-model="form.email"
          :errors="errors.email"
          type="email"
          :label="__('shared.email')"
          required
          autofocus
        />
      </form-group>

      <form-group>
        <text-input
          id="password"
          v-model="form.password"
          type="password"
          :label="__('shared.password')"
          required
        />
      </form-group>

      <form-group center>
        <checkbox-input
          id="remember"
          v-model="form.remember"
          :label="__('auth.rememberMe')"
        />
        <x-link :href="route('admin.auth.password.forgot')">
          {{ __('auth.forgotYourPassword') }}
        </x-link>
      </form-group>

      <form-group>
        <loading-button type="submit" :loading="sending" full-width>
          {{ __('auth.signIn') }}
        </loading-button>
      </form-group>
    </form>
  </layout>
</template>

<script>
import Layout from './Components/Layout'
import Logo from '@/Shared/Logo'
import { H3Title } from '@/Shared/Title'
import { FormGroup, TextInput, CheckboxInput } from './Components/Form'
import { LoadingButton } from '@/Shared/Button'
import { XLink } from '@/Shared/Link'

export default {
  metaInfo: {
    title: 'Login',
  },
  components: {
    Layout,
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
