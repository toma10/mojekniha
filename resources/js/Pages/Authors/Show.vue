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
              {{ __('shared.edit') }}
            </x-link>
            <delete-author-link :author="author" />
          </div>
        </horizontal-spacer>
      </template>

      <data-grid>
        <data-grid-item :title="__('shared.id')">
          {{ author.id }}
        </data-grid-item>

        <data-grid-item :title="__('shared.nationality')">
          <x-link :href="route('admin.books.nationalities.show', author.nationality.id)">
            {{ author.nationality.name }}
          </x-link>
        </data-grid-item>

        <data-grid-item :title="__('shared.birthDate')">
          {{ formatDate(author.birth_date) }}
        </data-grid-item>

        <data-grid-item :title="__('shared.deathDate')">
          {{ formatDate(author.death_date) || '-' }}
        </data-grid-item>

        <data-grid-item
          :title="__('shared.biography')"
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

    <div class="mt-8">
      <H5Title>{{ __('shared.books') }}</H5Title>
      <x-table class="mt-5">
        <thead>
          <x-tr>
            <x-th>{{ __('shared.id') }}</x-th>
            <x-th>{{ __('shared.name') }}</x-th>
            <x-th>{{ __('shared.originalName') }}</x-th>
            <x-th>{{ __('shared.releaseYear') }}</x-th>
            <x-th />
          </x-tr>
        </thead>
        <tbody>
          <x-tr
            v-for="book in author.books"
            :key="book.id"
            striped
          >
            <x-td>{{ book.id }}</x-td>
            <x-td>{{ book.name }}</x-td>
            <x-td>{{ book.original_name }}</x-td>
            <x-td>{{ book.release_year }}</x-td>
            <x-td links>
              <x-link :href="route('admin.books.books.show', book.id)">
                {{ __('shared.show') }}
              </x-link>
              <x-link :href="route('admin.books.books.edit', book.id)">
                {{ __('shared.edit') }}
              </x-link>
              <delete-book-link :book="book" />
            </x-td>
          </x-tr>
        </tbody>
      </x-table>
    </div>

    <div class="mt-8">
      <H5Title>{{ __('shared.series') }}</H5Title>
      <x-table class="mt-5">
        <thead>
          <x-tr>
            <x-th>{{ __('shared.id') }}</x-th>
            <x-th>{{ __('shared.name') }}</x-th>
            <x-th />
          </x-tr>
        </thead>
        <tbody>
          <x-tr
            v-for="series in author.series"
            :key="series.id"
            striped
          >
            <x-td>{{ series.id }}</x-td>
            <x-td>{{ series.name }}</x-td>
            <x-td links>
              <x-link :href="route('admin.books.series.show', series.id)">
                {{ __('shared.show') }}
              </x-link>
              <x-link :href="route('admin.books.series.edit', series.id)">
                {{ __('shared.edit') }}
              </x-link>
              <delete-series-link :series="series" />
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
import DeleteAuthorLink from './Components/DeleteAuthorLink'
import { DataGrid, DataGridItem } from '@/Shared/DataGrid'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import DeleteBookLink from '@/Pages/Books/Components/DeleteBookLink'
import DeleteSeriesLink from '@/Pages/Series/Components/DeleteSeriesLink'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    Panel,
    H4Title,
    H5Title,
    Avatar,
    XLink,
    DeleteAuthorLink,
    DataGrid,
    DataGridItem,
    XTable,
    XTr,
    XTh,
    XTd,
    DeleteBookLink,
    DeleteSeriesLink,
  },
  props: {
    author: {
      type: Object,
      required: true,
    },
  },
}
</script>
