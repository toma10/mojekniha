<template>
  <layout>
    <horizontal-spacer>
      <h2-title>{{ __('shared.bookBindings') }}</h2-title>

      <button-link :href="route('admin.books.bookBindings.create')">
        {{ __('bookBindings.create') }}
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
          v-for="bookBinding in bookBindings.data"
          :key="bookBinding.id"
          striped
        >
          <x-td>{{ bookBinding.id }}</x-td>
          <x-td>{{ bookBinding.name }}</x-td>
          <x-td links>
            <x-link :href="route('admin.books.bookBindings.show', bookBinding.id)">
              {{ __('shared.show') }}
            </x-link>
            <x-link :href="route('admin.books.bookBindings.edit', bookBinding.id)">
              {{ __('shared.edit') }}
            </x-link>
            <delete-book-binding-link :book-binding="bookBinding" />
          </x-td>
        </x-tr>
      </tbody>
    </x-table>

    <pagination
      class="mt-6"
      :links="bookBindings.links"
    />
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import { H2Title } from '@/Shared/Title'
import { ButtonLink } from '@/Shared/Link'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import { XLink } from '@/Shared/Link'
import DeleteBookBindingLink from './Components/DeleteBookBindingLink'
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
    DeleteBookBindingLink,
    Pagination,
  },
  props: {
    bookBindings: {
      type: Object,
      required: true,
    },
  },
}
</script>
