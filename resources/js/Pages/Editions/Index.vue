<template>
  <layout>
    <horizontal-spacer>
      <h2-title>Editions</h2-title>

      <button-link :href="route('admin.books.editions.create')">
        Create edition
      </button-link>
    </horizontal-spacer>

    <x-table class="mt-5">
      <thead>
        <x-tr>
          <x-th>Id</x-th>
          <x-th>ISBN</x-th>
          <x-th>Book</x-th>
          <x-th>Language</x-th>
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
