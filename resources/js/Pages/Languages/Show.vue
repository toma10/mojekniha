<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>{{ __('shared.language') }}</h4-title>
      </template>

      <data-grid>
        <data-grid-item :title="__('shared.id')">
          {{ language.id }}
        </data-grid-item>

        <data-grid-item :title="__('shared.name')">
          {{ language.name }}
        </data-grid-item>
      </data-grid>
    </panel>

    <div class="mt-8">
      <H5Title>{{ __('shared.editions') }}</H5Title>
      <x-table class="mt-5">
        <thead>
          <x-tr>
            <x-th>{{ __('shared.id') }}</x-th>
            <x-th>{{ __('shared.isbn') }}</x-th>
            <x-th>{{ __('shared.book') }}</x-th>
            <x-th>{{ __('shared.releaseYear') }}</x-th>
            <x-th />
          </x-tr>
        </thead>
        <tbody>
          <x-tr
            v-for="edition in language.editions"
            :key="edition.id"
            striped
          >
            <x-td>{{ edition.id }}</x-td>
            <x-td>{{ edition.isbn }}</x-td>
            <x-td>
              <x-link :href="route('admin.books.books.show', edition.book.id)">
                {{ edition.book.name }}
              </x-link>
            </x-td>
            <x-td>{{ edition.release_year }}</x-td>
            <x-td links>
              <x-link :href="route('admin.books.editions.show', edition.id)">
                Show
              </x-link>
              <x-link :href="route('admin.books.editions.edit', edition.id)">
                Edit
              </x-link>
              <delete-edition-link :edition="edition" />
            </x-td>
          </x-tr>
        </tbody>
      </x-table>
    </div>
  </layout>
</template>

<script>
import Layout from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { H4Title, H5Title } from '@/Shared/Title'
import { DataGrid, DataGridItem } from '@/Shared/DataGrid'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import { XLink } from '@/Shared/Link'
import DeleteEditionLink from '@/Pages/Editions/Components/DeleteEditionLink'

export default {
  components: {
    Layout,
    Panel,
    H4Title,
    H5Title,
    DataGrid,
    DataGridItem,
    XTable,
    XTr,
    XTh,
    XTd,
    XLink,
    DeleteEditionLink,
  },
  props: {
    language: {
      type: Object,
      required: true,
    },
  },
}
</script>
