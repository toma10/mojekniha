<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>Create author</h4-title>
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

          <image-input
            id="portrait_image"
            v-model="form.portrait_image"
            :errors="errors.portrait_image"
            label="Portrait"
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
            :href="route('admin.books.authors.index')"
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
  IdInput,
  TextInput,
  DateInput,
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
    TextInput,
    DateInput,
    ImageInput,
    TextareaInput,
    SelectInput,
    ButtonGroup,
    ButtonLink,
    LoadingButton,
  },
  props: {
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
        name: '',
        birth_date: null,
        death_date: null,
        portrait_image: null,
        biography: '',
        nationality_id: null,
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
    },
  },
  methods: {
    async submit() {
      this.sending = true
      const data = new FormData()

      Object.entries(this.form).forEach(([name, value]) => {
        data.append(name, value || '')
      })

      const response = await this.$inertia.post(this.route('admin.books.authors.store'), data)
      this.sending = false
    },
  },
}
</script>
