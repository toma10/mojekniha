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
        <loading-button type="submit" :loading="sending">
          Send Password Reset Link
        </loading-button>
      </form-group>
    </form>
  </form-layout>
</template>

<script>
import FormLayout from '@/Shared/FormLayout'
import Logo from '@/Shared/Logo'
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
