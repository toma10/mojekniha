<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>Create edition</h4-title>
      </template>

      <form @submit.prevent="submit">
        <form-content>
          <select-input
            id="book_id"
            v-model="form.book_id"
            :errors="errors.book_id"
            :options="bookOptions"
            label="Book"
            required
            autofocus
          />

          <text-input
            id="isbn"
            v-model="form.isbn"
            :errors="errors.isbn"
            label="ISBN"
            required
          />

          <select-input
            id="language_id"
            v-model="form.language_id"
            :errors="errors.language_id"
            :options="languageOptions"
            label="Language"
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

          <text-input
            id="number_of_pages"
            type="number"
            :min="0"
            :step="1"
            v-model="form.number_of_pages"
            :errors="errors.number_of_pages"
            label="Number of pages"
            required
          />

          <text-input
            id="number_of_copies"
            type="number"
            :min="0"
            :step="1"
            v-model="form.number_of_copies"
            :errors="errors.number_of_copies"
            label="Number of copies"
            required
          />

          <select-input
            id="book_binding_id"
            v-model="form.book_binding_id"
            :errors="errors.book_binding_id"
            :options="bookBindingOptions"
            label="Book Binding"
            required
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
            :href="route('admin.books.editions.index')"
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
    SelectInput,
    ImageInput,
    ButtonGroup,
    ButtonLink,
    LoadingButton,
  },
  props: {
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
        book_id: null,
        isbn: '',
        language_id: null,
        release_year: '0',
        number_of_pages: '0',
        number_of_copies: '0',
        book_binding_id: null,
        cover_image: null,
      },
    }
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

      const response = await this.$inertia.post(this.route('admin.books.editions.store'), data)
      this.sending = false
    },
  },
}
</script>
