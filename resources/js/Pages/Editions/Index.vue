<template>
  <layout>
    <horizontal-spacer>
      <h2-title>{{ __('shared.editions') }}</h2-title>

      <button-link :href="route('admin.books.editions.create')">
        {{ __('editions.create') }}
      </button-link>
    </horizontal-spacer>

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
          v-for="edition in editions.data"
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

    <pagination
      class="mt-6"
      :links="editions.links"
    />
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import { H2Title } from '@/Shared/Title'
import { ButtonLink } from '@/Shared/Link'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import { XLink } from '@/Shared/Link'
import DeleteEditionLink from './Components/DeleteEditionLink'
import Pagination from '@/Shared/Pagination'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    H2Title,
    ButtonLink,
    XTable,
    XTr,
    XTh,
    XTd,
    XLink,
    DeleteEditionLink,
    Pagination,
  },
  props: {
    editions: {
      type: Object,
      required: true,
    },
  },
}
</script>
