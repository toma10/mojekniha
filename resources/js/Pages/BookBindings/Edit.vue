<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>{{ __('bookBindings.edit') }}</h4-title>
      </template>

      <form @submit.prevent="submit">
        <form-content>
          <id-input :id="bookBinding.id" />

          <text-input
            id="name"
            v-model="form.name"
            :errors="errors.name"
            :label="__('shared.name')"
            required
            autofocus
          />
        </form-content>

        <button-group>
          <button-link
            :href="route('admin.books.bookBindings.show', bookBinding.id)"
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
import { FormContent, IdInput, TextInput, ButtonGroup } from '@/Shared/Form'
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
    ButtonGroup,
    ButtonLink,
    LoadingButton,
  },
  props: {
    bookBinding: {
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
        name: this.bookBinding.name,
      },
    }
  },
  remember: 'form',
  methods: {
    async submit() {
      this.sending = true
      const response = await this.$inertia.put(this.route('admin.books.bookBindings.update', this.bookBinding.id), this.form)
      this.sending = false
    },
  },
}
</script>
