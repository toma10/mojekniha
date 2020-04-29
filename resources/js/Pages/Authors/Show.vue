<template>
  <layout>
    <panel>
      <template #header>
        <horizontal-spacer>
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <avatar :url="author.portrait_url" />
            </div>
            <div class="ml-4">
              <h4-title>
                {{ author.name }}
              </h4-title>
            </div>
          </div>
          <div class="space-x-1">
            <x-link :href="route('admin.books.authors.edit', author.id)">
              Edit
            </x-link>
            <delete-author-link :author="author" />
          </div>
        </horizontal-spacer>
      </template>

      <data-grid>
        <data-grid-item title="Id">
          {{ author.id }}
        </data-grid-item>

        <data-grid-item title="Nationality">
          <x-link :href="route('admin.books.nationalities.show', author.nationality.id)">
            {{ author.nationality.name }}
          </x-link>
        </data-grid-item>

        <data-grid-item title="Date of birth">
          {{ formatDate(author.birth_date) }}
        </data-grid-item>

        <data-grid-item title="Date of death">
          {{ formatDate(author.death_date) || '-' }}
        </data-grid-item>

        <data-grid-item
          title="Biography"
          full-width
        >
          <div class="max-w-2xl">
            <p
              class="whitespace-pre-line"
              v-text="author.biography"
            />
          </div>
        </data-grid-item>
      </data-grid>
    </panel>
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { H4Title } from '@/Shared/Title'
import Avatar from '@/Shared/Avatar'
import { XLink } from '@/Shared/Link'
import DeleteAuthorLink from './Components/DeleteAuthorLink'
import { DataGrid, DataGridItem } from '@/Shared/DataGrid'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    Panel,
    H4Title,
    Avatar,
    XLink,
    DeleteAuthorLink,
    DataGrid,
    DataGridItem,
  },
  props: {
    author: {
      type: Object,
      required: true,
    },
  },
}
</script>
