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
          :errors="$page.errors.email"
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
        <primary-link :href="route('admin.auth.password.forgot')">
          Forgot your password?
        </primary-link>
      </form-group>

      <form-group>
        <primary-button type="submit">
          Sign in
        </primary-button>
      </form-group>
    </form>
  </form-layout>
</template>

<script>
import FormLayout from '@/Shared/FormLayout'
import Logo from '@/Shared/Logo'
import { H3Title } from '@/Shared/Title'
import { FormGroup, TextInput, CheckboxInput } from '@/Shared/Form'
import { PrimaryButton } from '@/Shared/Button'
import { PrimaryLink } from '@/Shared/Link'

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
    PrimaryButton,
    PrimaryLink,
  },
  data() {
    return {
      form: {
        email: '',
        password: '',
        remember: false,
      },
    }
  },
  methods: {
    submit() {
      this.$inertia.post(this.route('admin.auth.login'), this.form)
    },
  },
}
</script>
