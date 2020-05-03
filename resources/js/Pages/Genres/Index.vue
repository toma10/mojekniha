<template>
  <layout>
    <horizontal-spacer>
      <h2-title>{{ __('shared.genres') }}</h2-title>

      <button-link :href="route('admin.books.genres.create')">
        {{ __('genres.create') }}
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
          v-for="genre in genres.data"
          :key="genre.id"
          striped
        >
          <x-td>{{ genre.id }}</x-td>
          <x-td>{{ genre.name }}</x-td>
          <x-td links>
            <x-link :href="route('admin.books.genres.show', genre.id)">
              {{ __('shared.show') }}
            </x-link>
            <x-link :href="route('admin.books.genres.edit', genre.id)">
              {{ __('shared.edit') }}
            </x-link>
            <delete-genre-link :genre="genre" />
          </x-td>
        </x-tr>
      </tbody>
    </x-table>

    <pagination
      class="mt-6"
      :links="genres.links"
    />
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import { H2Title } from '@/Shared/Title'
import { ButtonLink } from '@/Shared/Link'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import { XLink } from '@/Shared/Link'
import DeleteGenreLink from './Components/DeleteGenreLink'
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
    DeleteGenreLink,
    Pagination,
  },
  props: {
    genres: {
      type: Object,
      required: true,
    },
  },
}
</script>
