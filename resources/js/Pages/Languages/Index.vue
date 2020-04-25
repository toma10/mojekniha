<template>
  <layout>
    <h2-title>Languages</h2-title>

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
          v-for="language in languages.data"
          :key="language.id"
          striped
        >
          <x-td> {{ language.id }}</x-td>
          <x-td> {{ language.name }}</x-td>
          <x-td links>
            <x-link :href="route('admin.books.languages.show', language.id)">
              Show
            </x-link>
          </x-td>
        </x-tr>
      </tbody>
    </x-table>

    <pagination
      class="mt-6"
      :links="languages.links"
    />
  </layout>
</template>

<script>
import Layout from '@/Shared/Layout'
import { H2Title } from '@/Shared/Title'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import { XLink } from '@/Shared/Link'
import Pagination from '@/Shared/Pagination'

export default {
  components: {
    Layout,
    H2Title,
    XTable,
    XTr,
    XTh,
    XTd,
    XLink,
    Pagination,
  },
  props: {
    languages: {
      type: Object,
      required: true,
    },
  },
}
</script>
