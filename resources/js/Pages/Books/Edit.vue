<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>{{ __('books.edit') }}</h4-title>
      </template>

      <form @submit.prevent="submit">
        <form-content>
          <id-input :id="book.id" />

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

          <avatar-input
            :label="__('shared.cover')"
            :url="book.cover_url"
          />

          <image-input
            id="cover_image"
            v-model="form.cover_image"
            :errors="errors.cover_image"
            :label="__('shared.newCover')"
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
            :href="route('admin.books.books.show', book.id)"
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
import {
  FormContent,
  IdInput,
  TextInput,
  TextareaInput,
  SelectInput,
  AvatarInput,
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
    IdInput,
    TextInput,
    TextareaInput,
    SelectInput,
    AvatarInput,
    ImageInput,
    MultiselectInput,
    ButtonGroup,
    ButtonLink,
    LoadingButton,
  },
  props: {
    book: {
      type: Object,
      required: true,
    },
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
        name: this.book.name,
        original_name: this.book.original_name,
        description: this.book.description,
        release_year: String(this.book.release_year),
        author_id: this.book.author_id,
        series_id: this.book.series_id,
        cover_image: null,
        genres: this.book.genres.map(genre => genre.id),
        tags: this.book.tags.map(tag => tag.id),
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
      return this.genres.map(tag => ({
        key: tag.id,
        value: tag.name,
      }))
    },
    tagOptions() {
      return this.tags.map(tag => ({
        key: tag.id,
        value: tag.name,
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

      // https://github.com/laravel/framework/issues/13457#issuecomment-239451567
      data.append('_method', 'PUT')
      const response = await this.$inertia.post(this.route('admin.books.books.update', this.book.id), data)
      this.sending = false
    },
  },
}
</script>
