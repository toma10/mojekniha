<template>
  <layout>
    <horizontal-spacer>
      <h2-title>Authors</h2-title>

      <button-link :href="route('admin.books.authors.create')">
        Create author
      </button-link>
    </horizontal-spacer>

    <x-table class="mt-5">
      <thead>
        <x-tr>
          <x-th>Id</x-th>
          <x-th>Name</x-th>
          <x-th>Nationality</x-th>
          <x-th>Portrait</x-th>
          <x-th />
        </x-tr>
      </thead>
      <tbody>
        <x-tr
          v-for="author in authors.data"
          :key="author.id"
          striped
        >
          <x-td>{{ author.id }}</x-td>
          <x-td>{{ author.name }}</x-td>
          <x-td>{{ author.nationality.name }}</x-td>
          <x-td>
            <avatar :url="author.portrait_url" />
          </x-td>
          <x-td links>
            <x-link :href="route('admin.books.authors.show', author.id)">
              Show
            </x-link>
            <x-link :href="route('admin.books.authors.edit', author.id)">
              Edit
            </x-link>
            <delete-author-link :author="author" />
          </x-td>
        </x-tr>
      </tbody>
    </x-table>

    <pagination
      class="mt-6"
      :links="authors.links"
    />
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import { H2Title } from '@/Shared/Title'
import { ButtonLink } from '@/Shared/Link'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import Avatar from '@/Shared/Avatar'
import { XLink } from '@/Shared/Link'
import DeleteAuthorLink from './Components/DeleteAuthorLink'
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
    Avatar,
    XLink,
    DeleteAuthorLink,
    Pagination,
  },
  props: {
    authors: {
      type: Object,
      required: true,
    },
  },
}
</script>
