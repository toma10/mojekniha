<template>
  <layout>
    <panel>
      <template #header>
        <horizontal-spacer>
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <avatar :url="edition.cover_url" />
            </div>
            <div class="ml-4">
              <h4-title>
                {{ edition.book.name }}
              </h4-title>
              <div class="text-sm leading-5 text-gray-500">
                {{ edition.isbn }}
              </div>
            </div>
          </div>
          <div class="space-x-1">
            <x-link :href="route('admin.books.editions.edit', edition.id)">
              Edit
            </x-link>
            <delete-edition-link :edition="edition" />
          </div>
        </horizontal-spacer>
      </template>

      <data-grid>
        <data-grid-item title="Id">
          {{ edition.id }}
        </data-grid-item>

        <data-grid-item title="Book">
          <x-link :href="route('admin.books.books.edit', edition.book.id)">
            {{ edition.book.name }}
          </x-link>
        </data-grid-item>

        <data-grid-item title="Release year">
          {{ edition.release_year }}
        </data-grid-item>

        <data-grid-item title="Language">
          <x-link :href="route('admin.books.languages.show', edition.language.id)">
            {{ edition.language.name }}
          </x-link>
        </data-grid-item>

        <data-grid-item title="Number of pages">
          {{ edition.number_of_pages }}
        </data-grid-item>

        <data-grid-item title="Book binding">
          <x-link :href="route('admin.books.bookBindings.show', edition.book_binding.id)">
            {{ edition.book_binding.name }}
          </x-link>
        </data-grid-item>

        <data-grid-item title="Number of copies">
          {{ edition.number_of_copies }}
        </data-grid-item>
      </data-grid>
    </panel>

    <div class="mt-8">
      <H5Title>Genres</H5Title>
      <x-table class="mt-5">
        <thead>
          <x-tr>
            <x-th>Id</x-th>
            <x-th>Name</x-th>
            <x-th />
          </x-tr>
        </thead>
        <tbody>
          <x-tr
            v-for="genre in edition.book.genres"
            :key="genre.id"
            striped
          >
            <x-td>{{ genre.id }}</x-td>
            <x-td>{{ genre.name }}</x-td>
            <x-td links>
              <x-link :href="route('admin.books.genres.show', genre.id)">
                Show
              </x-link>
              <x-link :href="route('admin.books.genres.edit', genre.id)">
                Edit
              </x-link>
              <delete-genre-link :genre="genre" />
            </x-td>
          </x-tr>
        </tbody>
      </x-table>
    </div>

    <div class="mt-8">
      <H5Title>Tags</H5Title>
      <x-table class="mt-5">
        <thead>
          <x-tr>
            <x-th>Id</x-th>
            <x-th>Name</x-th>
            <x-th />
          </x-tr>
        </thead>
        <tbody>
          <x-tr
            v-for="tag in edition.book.tags"
            :key="tag.id"
            striped
          >
            <x-td>{{ tag.id }}</x-td>
            <x-td>{{ tag.name }}</x-td>
            <x-td links>
              <x-link :href="route('admin.books.tags.show', tag.id)">
                Show
              </x-link>
              <x-link :href="route('admin.books.tags.edit', tag.id)">
                Edit
              </x-link>
              <delete-tag-link :tag="tag" />
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
import { H4Title, H5Title } from '@/Shared/Title'
import Avatar from '@/Shared/Avatar'
import { XLink } from '@/Shared/Link'
import DeleteEditionLink from './Components/DeleteEditionLink'
import { DataGrid, DataGridItem } from '@/Shared/DataGrid'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import DeleteGenreLink from '@/Pages/Genres/Components/DeleteGenreLink'
import DeleteTagLink from '@/Pages/Tags/Components/DeleteTagLink'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    Panel,
    H4Title,
    H5Title,
    Avatar,
    XLink,
    DeleteEditionLink,
    DataGrid,
    DataGridItem,
    XTable,
    XTr,
    XTh,
    XTd,
    DeleteGenreLink,
    DeleteTagLink,
  },
  props: {
    edition: {
      type: Object,
      required: true,
    },
  },
}
</script>
