<template>
  <layout>
    <panel>
      <template #header>
        <horizontal-spacer>
          <h4-title>
            {{ __('shared.series') }}
          </h4-title>
          <div class="space-x-1">
            <x-link :href="route('admin.books.series.edit', series.id)">
              {{ __('shared.edit') }}
            </x-link>
            <delete-series-link :series="series" />
          </div>
        </horizontal-spacer>
      </template>

      <data-grid>
        <data-grid-item :title="__('shared.id')">
          {{ series.id }}
        </data-grid-item>

        <data-grid-item :title="__('shared.name')">
          {{ series.name }}
        </data-grid-item>

        <data-grid-item :title="__('shared.author')">
          <x-link :href="route('admin.books.authors.show', series.author.id)">
            {{ series.author.name }}
          </x-link>
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
            v-for="book in series.books"
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
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { XLink } from '@/Shared/Link'
import DeleteSeriesLink from './Components/DeleteSeriesLink'
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
    DeleteSeriesLink,
    DataGrid,
    DataGridItem,
    XTable,
    XTr,
    XTh,
    XTd,
    DeleteBookLink,
  },
  props: {
    series: {
      type: Object,
      required: true,
    },
  },
}
</script>
