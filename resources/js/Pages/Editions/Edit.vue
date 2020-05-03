<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>{{ __('editions.edit') }}</h4-title>
      </template>

      <form @submit.prevent="submit">
        <form-content>
          <id-input :id="edition.id" />

          <select-input
            id="book_id"
            v-model="form.book_id"
            :errors="errors.book_id"
            :options="bookOptions"
            :label="__('shared.book')"
            required
          />

          <text-input
            id="isbn"
            v-model="form.isbn"
            :errors="errors.isbn"
            :label="__('shared.isbn')"
            required
          />

          <select-input
            id="language_id"
            v-model="form.language_id"
            :errors="errors.language_id"
            :options="languageOptions"
            :label="__('shared.language')"
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

          <text-input
            id="number_of_pages"
            type="number"
            :min="0"
            :step="1"
            v-model="form.number_of_pages"
            :errors="errors.number_of_pages"
            :label="__('shared.numberOfPages')"
            required
          />

          <text-input
            id="number_of_copies"
            type="number"
            :min="0"
            :step="1"
            v-model="form.number_of_copies"
            :errors="errors.number_of_copies"
            :label="__('shared.numberOfCopies')"
            required
          />

          <select-input
            id="book_binding_id"
            v-model="form.book_binding_id"
            :errors="errors.book_binding_id"
            :options="bookBindingOptions"
            :label="__('shared.bookBinding')"
            required
          />

          <avatar-input
            :label="__('shared.cover')"
            :url="edition.cover_url"
          />

          <image-input
            id="cover_image"
            v-model="form.cover_image"
            :errors="errors.cover_image"
            :label="__('shared.newCover')"
          />
        </form-content>

        <button-group>
          <button-link
            :href="route('admin.books.editions.show', edition.id)"
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
  IdInput,
  TextInput,
  TextareaInput,
  SelectInput,
  AvatarInput,
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
    IdInput,
    TextInput,
    TextareaInput,
    SelectInput,
    AvatarInput,
    ImageInput,
    ButtonGroup,
    ButtonLink,
    LoadingButton,
  },
  props: {
    edition: {
      type: Object,
      required: true,
    },
    books: {
      type: Array,
      required: true,
    },
    languages: {
      type: Array,
      required: true,
    },
    bookBindings: {
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
        book_id: this.edition.book_id,
        isbn: this.edition.isbn,
        language_id: this.edition.language_id,
        release_year: String(this.edition.release_year),
        number_of_pages: String(this.edition.number_of_pages),
        number_of_copies: String(this.edition.number_of_copies),
        book_binding_id: this.edition.book_binding_id,
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
    bookOptions() {
      return this.books.map(book => ({
        key: book.id,
        value: book.name
      }))
    },
    languageOptions() {
      return this.languages.map(language => ({
        key: language.id,
        value: language.name
      }))
    },
    bookBindingOptions() {
      return this.bookBindings.map(bookBinding => ({
        key: bookBinding.id,
        value: bookBinding.name
      }))
    }
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
      const response = await this.$inertia.post(this.route('admin.books.editions.update', this.edition.id), data)
      this.sending = false
    },
  },
}
</script>
