<template>
  <layout>
    <h2-title class="text-2xl font-semibold text-gray-900">
      Nationalities
    </h2-title>

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
          v-for="nationality in nationalities.data"
          :key="nationality.id"
          striped
        >
          <x-td> {{ nationality.id }}</x-td>
          <x-td> {{ nationality.name }}</x-td>
          <x-td links>
            <x-link :href="route('admin.books.nationalities.show', nationality.id)">
              Show
            </x-link>
          </x-td>
        </x-tr>
      </tbody>
    </x-table>

    <pagination
      class="mt-6"
      :links="nationalities.links"
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
    nationalities: {
      type: Object,
      required: true,
    },
  },
}
</script>
