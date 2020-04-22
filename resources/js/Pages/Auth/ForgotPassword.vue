<template>
  <layout>
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
          autofocus
        />
      </form-group>

      <form-group>
        <loading-button type="submit" :loading="sending" full-width>
          Send Password Reset Link
        </loading-button>
      </form-group>
    </form>
  </layout>
</template>

<script>
import Layout from './Components/Layout'
import Logo from '@/Shared/Logo'
import { H3Title } from '@/Shared/Title'
import { FormGroup, TextInput } from './Components/Form'
import { LoadingButton } from '@/Shared/Button'

export default {
  metaInfo: {
    title: 'Reset Password',
  },
  components: {
    Layout,
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
  },
  data() {
    return {
      sending: false,
      form: {
        email: '',
      },
    }
  },
  methods: {
    async submit() {
      this.sending = true
      await this.$inertia.post(this.route('admin.auth.password.email'), this.form)
      this.sending = false
      this.form = {
        email: ''
      }
    },
  },
}
</script>
