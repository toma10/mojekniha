<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>Edit author</h4-title>
      </template>

      <form @submit.prevent="submit">
        <form-content>
          <id-input :id="author.id" />

          <text-input
            id="name"
            v-model="form.name"
            :errors="errors.name"
            label="Name"
            required
            autofocus
          />

          <date-input
            id="birth_date"
            v-model="form.birth_date"
            :errors="errors.birth_date"
            label="Date of birth"
            required
          />

          <date-input
            id="death_date"
            v-model="form.death_date"
            :errors="errors.death_date"
            label="Date of death"
          />

          <avatar-input
            label="Portrait"
            :url="author.portrait_url"
          />

          <image-input
            id="portrait_image"
            v-model="form.portrait_image"
            :errors="errors.portrait_image"
            label="New Portrait"
          />

          <textarea-input
            id="biography"
            v-model="form.biography"
            :errors="errors.biography"
            label="Biography"
          />

          <select-input
            id="nationality_id"
            v-model="form.nationality_id"
            :errors="errors.nationality_id"
            :options="options"
            label="Nationality"
            required
          />
        </form-content>

        <button-group>
          <button-link
            :href="route('admin.books.authors.show', author.id)"
            color="plain"
          >
            Cancel
          </button-link>
          <loading-button
            type="submit"
            :loading="sending"
          >
            Save
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
  DateInput,
  AvatarInput,
  ImageInput,
  TextareaInput,
  SelectInput,
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
    DateInput,
    AvatarInput,
    ImageInput,
    TextareaInput,
    SelectInput,
    ButtonGroup,
    ButtonLink,
    LoadingButton,
  },
  props: {
    author: {
      type: Object,
      required: true,
    },
    nationalities: {
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
        name: this.author.name,
        birth_date: this.author.birth_date,
        death_date: this.author.death_date,
        portrait_image: null,
        biography: this.author.biography || '',
        nationality_id: this.author.nationality_id,
      },
    }
  },
  remember: 'form',
  computed: {
    options() {
      return this.nationalities.map(nationality => ({
        key: nationality.id,
        value: nationality.name,
      }))
    }
  },
  methods: {
    async submit() {
      this.sending = true
      const data = new FormData()

      Object.entries(this.form).forEach(([name, value]) => {
        data.append(name, value || '')
      })

      // https://github.com/laravel/framework/issues/13457#issuecomment-239451567
      data.append('_method', 'PUT')
      const response = await this.$inertia.post(this.route('admin.books.authors.update', this.author.id), data)
      this.sending = false
    },
  },
}
</script>
