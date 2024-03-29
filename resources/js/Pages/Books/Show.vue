<template>
  <layout>
    <panel>
      <template #header>
        <horizontal-spacer>
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <avatar :url="book.cover_url" />
            </div>
            <div class="ml-4">
              <h4-title>
                {{ book.name }}
              </h4-title>
              <div class="text-sm leading-5 text-gray-500">
                {{ book.original_name }}
              </div>
            </div>
          </div>

          <div class="space-x-1">
            <x-link :href="route('admin.books.books.edit', book.id)">
              {{ __("shared.edit") }}
            </x-link>
            <delete-book-link :book="book" />
          </div>
        </horizontal-spacer>
      </template>

      <data-grid>
        <data-grid-item :title="__('shared.id')">
          {{ book.id }}
        </data-grid-item>

        <data-grid-item :title="__('shared.author')">
          <x-link :href="route('admin.books.authors.show', book.author.id)">
            {{ book.author.name }}
          </x-link>
        </data-grid-item>

        <data-grid-item :title="__('shared.releaseYear')">
          {{ book.release_year }}
        </data-grid-item>

        <data-grid-item :title="__('shared.series')">
          <x-link
            v-if="book.series"
            :href="route('admin.books.series.show', book.series.id)"
          >
            {{ book.series.name }}
          </x-link>
          <template v-else>
            -
          </template>
        </data-grid-item>

        <data-grid-item
          :title="__('shared.biography')"
          full-width
        >
          <div class="max-w-2xl">
            <p
              class="whitespace-pre-line"
              v-text="book.description"
            />
          </div>
        </data-grid-item>
      </data-grid>
    </panel>

    <div class="mt-8">
      <h5-title>Editions</h5-title>
      <x-table class="mt-5">
        <thead>
          <x-tr>
            <x-th>{{ __("shared.id") }}</x-th>
            <x-th>ISBN</x-th>
            <x-th>{{ __("shared.language") }}</x-th>
            <x-th>{{ __("shared.releaseYear") }}</x-th>
            <x-th />
          </x-tr>
        </thead>
        <tbody>
          <x-tr
            v-for="edition in book.editions"
            :key="edition.id"
            striped
          >
            <x-td>{{ edition.id }}</x-td>
            <x-td>{{ edition.isbn }}</x-td>
            <x-td>
              <x-link :href="route('admin.books.languages.show', edition.language.id)">
                {{ edition.language.name }}
              </x-link>
            </x-td>
            <x-td>{{ edition.release_year }}</x-td>
            <x-td links>
              <x-link :href="route('admin.books.editions.show', edition.id)">
                {{ __("shared.show") }}
              </x-link>
              <x-link :href="route('admin.books.editions.edit', edition.id)">
                {{ __("shared.edit") }}
              </x-link>
              <delete-edition-link :edition="edition" />
            </x-td>
          </x-tr>
        </tbody>
      </x-table>
    </div>

    <div class="mt-8">
      <h5-title>{{ __("shared.genres") }}</h5-title>
      <x-table class="mt-5">
        <thead>
          <x-tr>
            <x-th>{{ __("shared.id") }}</x-th>
            <x-th>{{ __("shared.name") }}</x-th>
            <x-th />
          </x-tr>
        </thead>
        <tbody>
          <x-tr
            v-for="genre in book.genres"
            :key="genre.id"
            striped
          >
            <x-td>{{ genre.id }}</x-td>
            <x-td>{{ genre.name }}</x-td>
            <x-td links>
              <x-link :href="route('admin.books.genres.show', genre.id)">
                {{ __("shared.show") }}
              </x-link>
              <x-link :href="route('admin.books.genres.edit', genre.id)">
                {{ __("shared.edit") }}
              </x-link>
              <delete-genre-link :genre="genre" />
            </x-td>
          </x-tr>
        </tbody>
      </x-table>
    </div>

    <div class="mt-8">
      <h5-title>{{ __("shared.tags") }}</h5-title>
      <x-table class="mt-5">
        <thead>
          <x-tr>
            <x-th>{{ __("shared.id") }}</x-th>
            <x-th>{{ __("shared.name") }}</x-th>
            <x-th />
          </x-tr>
        </thead>
        <tbody>
          <x-tr
            v-for="tag in book.tags"
            :key="tag.id"
            striped
          >
            <x-td>{{ tag.id }}</x-td>
            <x-td>{{ tag.name }}</x-td>
            <x-td links>
              <x-link :href="route('admin.books.tags.show', tag.id)">
                {{ __("shared.show") }}
              </x-link>
              <x-link :href="route('admin.books.tags.edit', tag.id)">
                {{ __("shared.edit") }}
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
import DeleteBookLink from './Components/DeleteBookLink'
import { DataGrid, DataGridItem } from '@/Shared/DataGrid'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import DeleteEditionLink from '@/Pages/Editions/Components/DeleteEditionLink'
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
    DeleteBookLink,
    DataGrid,
    DataGridItem,
    XTable,
    XTr,
    XTh,
    XTd,
    DeleteEditionLink,
    DeleteGenreLink,
    DeleteTagLink,
  },
  props: {
    book: {
      type: Object,
      required: true,
    },
  },
}
</script>
