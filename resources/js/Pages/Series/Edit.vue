<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>{{ __('series.edit') }}</h4-title>
      </template>

      <form @submit.prevent="submit">
        <form-content>
          <id-input :id="series.id" />

          <text-input
            id="name"
            v-model="form.name"
            :errors="errors.name"
            :label="__('shared.name')"
            required
            autofocus
          />

          <select-input
            id="author_id"
            v-model="form.author_id"
            :errors="errors.author_id"
            :options="options"
            :label="__('shared.author')"
            required
          />
        </form-content>

        <button-group>
          <button-link
            :href="route('admin.books.series.show', series.id)"
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
import { FormContent, IdInput, TextInput, SelectInput, ButtonGroup } from '@/Shared/Form'
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
    SelectInput,
    ButtonGroup,
    ButtonLink,
    LoadingButton,
  },
  props: {
    series: {
      type: Object,
      required: true,
    },
    authors: {
      type: Array,
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
        name: this.series.name,
        author_id: this.series.author_id,
      },
    }
  },
  computed: {
    options() {
      return this.authors.map(author => ({
        key: author.id,
        value: author.name,
      }))
    },
  },
  remember: 'form',
  methods: {
    async submit() {
      this.sending = true
      const response = await this.$inertia.put(this.route('admin.books.series.update', this.series.id), this.form)
      this.sending = false
    },
  },
}
</script>
