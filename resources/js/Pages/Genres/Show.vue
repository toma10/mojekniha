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

    <div class="mt-8">
      <H5Title>Books</H5Title>
      <x-table class="mt-5">
        <thead>
          <x-tr>
            <x-th>Id</x-th>
            <x-th>Name</x-th>
            <x-th>Original name</x-th>
            <x-th>Author</x-th>
            <x-th>Release year</x-th>
            <x-th />
          </x-tr>
        </thead>
        <tbody>
          <x-tr
            v-for="book in genre.books"
            :key="book.id"
            striped
          >
            <x-td>{{ book.id }}</x-td>
            <x-td>{{ book.name }}</x-td>
            <x-td>{{ book.original_name }}</x-td>
            <x-td>
              <x-link :href="route('admin.books.authors.show', book.author.id)">
                {{ book.author.name }}
              </x-link>
            </x-td>
            <x-td>{{ book.release_year }}</x-td>
            <x-td links>
              <x-link :href="route('admin.books.books.show', book.id)">
                Show
              </x-link>
              <x-link :href="route('admin.books.books.edit', book.id)">
                Edit
              </x-link>
              <delete-book-link :book="book" />
            </x-td>
          </x-tr>
        </tbody>
      </x-table>
    </div>
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { XLink } from '@/Shared/Link'
import DeleteGenreLink from './Components/DeleteGenreLink'
import { H4Title, H5Title } from '@/Shared/Title'
import { DataGrid, DataGridItem } from '@/Shared/DataGrid'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import DeleteBookLink from '@/Pages/Books/Components/DeleteBookLink'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    Panel,
    H4Title,
    H5Title,
    XLink,
    DeleteGenreLink,
    DataGrid,
    DataGridItem,
    XTable,
    XTr,
    XTh,
    XTd,
    DeleteBookLink,
  },
  props: {
    genre: {
      type: Object,
      required: true,
    },
  },
}
</script>
