<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>Create series</h4-title>
      </template>

      <form @submit.prevent="submit">
        <form-content>
          <text-input
            id="name"
            v-model="form.name"
            :errors="errors.name"
            label="Name"
            required
            autofocus
          />

          <select-input
            id="author_id"
            v-model="form.author_id"
            :errors="errors.author_id"
            :options="options"
            label="Author"
            required
          />
        </form-content>

        <button-group>
          <button-link
            :href="route('admin.books.series.index')"
            color="plain"
          >
            Cancel
          </button-link>
          <loading-button
            type="submit"
            :loading="sending"
          >
            Create
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
import { FormContent, TextInput, SelectInput, ButtonGroup } from '@/Shared/Form'
import { ButtonLink } from '@/Shared/Link'
import { LoadingButton } from '@/Shared/Button'

export default {
  components: {
    Layout,
    Panel,
    H4Title,
    FormContent,
    TextInput,
    SelectInput,
    ButtonGroup,
    ButtonLink,
    LoadingButton,
  },
  props: {
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
        name: '',
        author_id: '',
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
      const response = await this.$inertia.post(this.route('admin.books.series.store'), this.form)
      this.sending = false
    },
  },
}
</script>
