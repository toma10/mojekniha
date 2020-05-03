<template>
  <layout>
    <horizontal-spacer>
      <h2-title>{{ __('shared.series') }}</h2-title>

      <button-link :href="route('admin.books.series.create')">
        {{ __('series.create') }}
      </button-link>
    </horizontal-spacer>

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
          v-for="item in series.data"
          :key="item.id"
          striped
        >
          <x-td>{{ item.id }}</x-td>
          <x-td>{{ item.name }}</x-td>
          <x-td links>
            <x-link :href="route('admin.books.series.show', item.id)">
              {{ __('shared.show') }}
            </x-link>
            <x-link :href="route('admin.books.series.edit', item.id)">
              {{ __('shared.edit') }}
            </x-link>
            <delete-series-link :series="item" />
          </x-td>
        </x-tr>
      </tbody>
    </x-table>

    <pagination
      class="mt-6"
      :links="series.links"
    />
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import { H2Title } from '@/Shared/Title'
import { ButtonLink } from '@/Shared/Link'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import { XLink } from '@/Shared/Link'
import DeleteSeriesLink from './Components/DeleteSeriesLink'
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
    DeleteSeriesLink,
    Pagination,
  },
  props: {
    series: {
      type: Object,
      required: true,
    },
  },
}
</script>
