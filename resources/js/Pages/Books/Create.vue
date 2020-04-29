<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>Create book</h4-title>
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

          <text-input
            id="original_name"
            v-model="form.original_name"
            :errors="errors.original_name"
            label="Original name"
            required
          />

          <textarea-input
            id="description"
            v-model="form.description"
            :errors="errors.description"
            label="Description"
            required
          />

          <text-input
            id="release_year"
            type="number"
            :min="0"
            :step="1"
            v-model="form.release_year"
            :errors="errors.release_year"
            label="Release year"
            required
          />

          <select-input
            id="author_id"
            v-model="form.author_id"
            :errors="errors.author_id"
            :options="authorOptions"
            label="Author"
            required
          />

          <select-input
            id="series_id"
            v-model="form.series_id"
            :errors="errors.series_id"
            :options="seriesOptions"
            label="Series"
          />

          <image-input
            id="cover_image"
            v-model="form.cover_image"
            :errors="errors.cover_image"
            label="Cover"
          />
        </form-content>

        <button-group>
          <button-link
            :href="route('admin.books.books.index')"
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
import {
  FormContent,
  TextInput,
  TextareaInput,
  SelectInput,
  ImageInput,
  ButtonGroup
} from '@/Shared/Form'
import { ButtonLink } from '@/Shared/Link'
import { LoadingButton } from '@/Shared/Button'

export default {
  components: {
    Layout,
    Panel,
    H4Title,
    FormContent,
    TextInput,
    TextareaInput,
    SelectInput,
    ImageInput,
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
        description: '',
        original_name: '',
        release_year: '0',
        author_id: null,
        series_id: null,
        cover_image: null,
      },
    }
  },
  watch: {
    'form.author_id'() {
      this.form.series_id = null
    },
  },
  computed: {
    authorOptions() {
      return this.authors.map(author => ({
        key: author.id,
        value: author.name
      }))
    },
    seriesOptions() {
      if (this.form.author_id === null) {
        return []
      }

      const author = this.authors.find(author => author.id === parseInt(this.form.author_id)) || null

      if (author === null) {
        return []
      }

      return author.series.map(series => ({
        key: series.id,
        value: series.name,
      }))
    },
  },
  remember: 'form',
  methods: {
    async submit() {
      this.sending = true
      const data = new FormData()

      Object.entries(this.form).forEach(([name, value]) => {
        data.append(name, value || '')
      })

      const response = await this.$inertia.post(this.route('admin.books.books.store'), data)
      this.sending = false
    },
  },
}
</script>
