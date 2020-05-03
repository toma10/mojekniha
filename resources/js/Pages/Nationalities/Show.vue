<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>
          {{ __('shared.nationality') }}
        </h4-title>
      </template>

      <data-grid>
        <data-grid-item :title="__('shared.id')">
          {{ nationality.id }}
        </data-grid-item>

        <data-grid-item :title="__('shared.name')">
          {{ nationality.name }}
        </data-grid-item>
      </data-grid>
    </panel>

    <div class="mt-8">
      <H5Title>{{ __('shared.authors') }}</H5Title>
      <x-table class="mt-5">
        <thead>
          <x-tr>
            <x-th>{{ __('shared.id') }}</x-th>
            <x-th>{{ __('shared.name') }}</x-th>
            <x-th>{{ __('shared.portrait') }}</x-th>
            <x-th />
          </x-tr>
        </thead>
        <tbody>
          <x-tr
            v-for="author in nationality.authors"
            :key="author.id"
            striped
          >
            <x-td>{{ author.id }}</x-td>
            <x-td>{{ author.name }}</x-td>
            <x-td>
              <avatar :url="author.portrait_url" />
            </x-td>
            <x-td links>
              <x-link :href="route('admin.books.authors.show', author.id)">
                {{ __('shared.show') }}
              </x-link>
              <x-link :href="route('admin.books.authors.edit', author.id)">
                {{ __('shared.edit') }}
              </x-link>
              <delete-author-link :author="author" />
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
import Avatar from '@/Shared/Avatar'
import { XLink } from '@/Shared/Link'
import DeleteAuthorLink from '@/Pages/Authors/Components/DeleteAuthorLink'

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
    Avatar,
    DeleteAuthorLink,
  },
  props: {
    nationality: {
      type: Object,
      required: true,
    },
  },
}
</script>
