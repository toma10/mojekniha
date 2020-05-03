<template>
  <layout>
    <horizontal-spacer>
      <h2-title>{{ __('shared.tags') }}</h2-title>

      <button-link :href="route('admin.books.tags.create')">
        {{ __('tags.create') }}
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
          v-for="tag in tags.data"
          :key="tag.id"
          striped
        >
          <x-td>{{ tag.id }}</x-td>
          <x-td>{{ tag.name }}</x-td>
          <x-td links>
            <x-link :href="route('admin.books.tags.show', tag.id)">
              {{ __('shared.show') }}
            </x-link>
            <x-link :href="route('admin.books.tags.edit', tag.id)">
              {{ __('shared.edit') }}
            </x-link>
            <delete-tag-link :tag="tag" />
          </x-td>
        </x-tr>
      </tbody>
    </x-table>

    <pagination
      class="mt-6"
      :links="tags.links"
    />
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import { H2Title } from '@/Shared/Title'
import { ButtonLink } from '@/Shared/Link'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import { XLink } from '@/Shared/Link'
import DeleteTagLink from './Components/DeleteTagLink'
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
    DeleteTagLink,
    Pagination,
  },
  props: {
    tags: {
      type: Object,
      required: true,
    },
  },
}
</script>
