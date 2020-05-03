<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>{{ __('books.create') }}</h4-title>
      </template>

      <form @submit.prevent="submit">
        <form-content>
          <text-input
            id="name"
            v-model="form.name"
            :errors="errors.name"
            :label="__('shared.name')"
            required
            autofocus
          />

          <text-input
            id="original_name"
            v-model="form.original_name"
            :errors="errors.original_name"
            :label="__('shared.originalName')"
            required
          />

          <textarea-input
            id="description"
            v-model="form.description"
            :errors="errors.description"
            :label="__('shared.description')"
            required
          />

          <text-input
            id="release_year"
            type="number"
            :min="0"
            :step="1"
            v-model="form.release_year"
            :errors="errors.release_year"
            :label="__('shared.releaseYear')"
            required
          />

          <select-input
            id="author_id"
            v-model="form.author_id"
            :errors="errors.author_id"
            :options="authorOptions"
            :label="__('shared.author')"
            required
          />

          <select-input
            id="series_id"
            v-model="form.series_id"
            :errors="errors.series_id"
            :options="seriesOptions"
            :label="__('shared.series')"
          />

          <image-input
            id="cover_image"
            v-model="form.cover_image"
            :errors="errors.cover_image"
            :label="__('shared.cover')"
          />

          <multiselect-input
            id="genres"
            v-model="form.genres"
            :options="genreOptions"
            :errors="errors.genres"
            :label="__('shared.genres')"
          />

          <multiselect-input
            id="tags"
            v-model="form.tags"
            :options="tagOptions"
            :errors="errors.tags"
            :label="__('shared.tags')"
          />
        </form-content>

        <button-group>
          <button-link
            :href="route('admin.books.books.index')"
            color="plain"
          >
            {{ __('shared.cancel') }}
          </button-link>
          <loading-button
            type="submit"
            :loading="sending"
          >
            {{ __('shared.create') }}
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
  MultiselectInput,
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
    MultiselectInput,
    ButtonGroup,
    ButtonLink,
    LoadingButton,
  },
  props: {
    authors: {
      type: Array,
      required: true,
    },
    genres: {
      type: Array,
      required: true,
    },
    tags: {
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
        genres: [],
        tags: [],
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

      const author = this.authors.find(author => author.id === this.form.author_id) || null

      if (author === null) {
        return []
      }

      return author.series.map(series => ({
        key: series.id,
        value: series.name,
      }))
    },
    genreOptions() {
      return this.genres.map(genre => ({
        key: genre.id,
        value: genre.name
      }))
    },
    tagOptions() {
      return this.tags.map(tag => ({
        key: tag.id,
        value: tag.name
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
