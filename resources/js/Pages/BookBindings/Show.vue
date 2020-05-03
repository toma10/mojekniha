<template>
  <layout>
    <panel>
      <template #header>
        <horizontal-spacer>
          <h4-title>
            {{ __('shared.bookBinding') }}
          </h4-title>

          <div class="space-x-1">
            <x-link :href="route('admin.books.bookBindings.edit', bookBinding.id)">
              {{ __('shared.edit') }}
            </x-link>
            <delete-book-binding-link :book-binding="bookBinding" />
          </div>
        </horizontal-spacer>
      </template>

      <data-grid>
        <data-grid-item :title="__('shared.id')">
          {{ bookBinding.id }}
        </data-grid-item>

        <data-grid-item :title="__('shared.name')">
          {{ bookBinding.name }}
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
            <x-th>{{ __('shared.language') }}</x-th>
            <x-th>{{ __('shared.releaseYear') }}</x-th>
            <x-th />
          </x-tr>
        </thead>
        <tbody>
          <x-tr
            v-for="edition in bookBinding.editions"
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
            <x-td>
              <x-link :href="route('admin.books.languages.show', edition.language.id)">
                {{ edition.language.name }}
              </x-link>
            </x-td>
            <x-td>{{ edition.release_year }}</x-td>
            <x-td links>
              <x-link :href="route('admin.books.editions.show', edition.id)">
                {{ __('shared.show') }}
              </x-link>
              <x-link :href="route('admin.books.editions.edit', edition.id)">
                {{ __('shared.edit') }}
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
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { XLink } from '@/Shared/Link'
import DeleteBookBindingLink from './Components/DeleteBookBindingLink'
import { H4Title, H5Title } from '@/Shared/Title'
import { DataGrid, DataGridItem } from '@/Shared/DataGrid'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import DeleteEditionLink from '@/Pages/Editions/Components/DeleteEditionLink'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    Panel,
    H4Title,
    H5Title,
    XLink,
    DeleteBookBindingLink,
    DataGrid,
    DataGridItem,
    XTable,
    XTr,
    XTh,
    XTd,
    DeleteEditionLink,
  },
  props: {
    bookBinding: {
      type: Object,
      required: true,
    },
  },
}
</script>
