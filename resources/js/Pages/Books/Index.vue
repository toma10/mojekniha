<template>
  <layout>
    <horizontal-spacer>
      <h2-title>Books</h2-title>

      <button-link :href="route('admin.books.books.create')">
        Create book
      </button-link>
    </horizontal-spacer>

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
          v-for="book in books.data"
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

    <pagination
      class="mt-6"
      :links="books.links"
    />
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import { H2Title } from '@/Shared/Title'
import { ButtonLink } from '@/Shared/Link'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import { XLink } from '@/Shared/Link'
import DeleteBookLink from './Components/DeleteBookLink'
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
    DeleteBookLink,
    Pagination,
  },
  props: {
    books: {
      type: Object,
      required: true,
    },
  },
}
</script>
