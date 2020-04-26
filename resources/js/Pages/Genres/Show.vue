<template>
  <layout>
    <panel>
      <template #header>
        <horizontal-spacer>
          <h4-title>
            Genre detail
          </h4-title>
          <div class="space-x-1">
            <x-link :href="route('admin.books.genres.edit', genre.id)">
              Edit
            </x-link>
            <delete-genre-link :genre="genre" />
          </div>
        </horizontal-spacer>
      </template>

      <data-grid>
        <data-grid-item title="Id">
          {{ genre.id }}
        </data-grid-item>

        <data-grid-item title="Name">
          {{ genre.name }}
        </data-grid-item>
      </data-grid>
    </panel>
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { XLink } from '@/Shared/Link'
import DeleteGenreLink from './Components/DeleteGenreLink'
import { H4Title } from '@/Shared/Title'
import { DataGrid, DataGridItem } from '@/Shared/DataGrid'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    Panel,
    H4Title,
    XLink,
    DeleteGenreLink,
    DataGrid,
    DataGridItem,
  },
  props: {
    genre: {
      type: Object,
      required: true,
    },
  },
}
</script>
