<template>
  <layout>
    <panel>
      <template #header>
        <horizontal-spacer>
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <avatar :url="book.cover_url" />
            </div>
            <div class="ml-4">
              <h4-title>
                {{ book.name }}
              </h4-title>
              <div class="text-sm leading-5 text-gray-500">
                {{ book.original_name }}
              </div>
            </div>
          </div>
          <div class="space-x-1">
            <x-link :href="route('admin.books.books.edit', book.id)">
              Edit
            </x-link>
            <delete-book-link :book="book" />
          </div>
        </horizontal-spacer>
      </template>

      <data-grid>
        <data-grid-item title="Id">
          {{ book.id }}
        </data-grid-item>

        <data-grid-item title="Author">
          <x-link :href="route('admin.books.authors.show', book.author.id)">
            {{ book.author.name }}
          </x-link>
        </data-grid-item>

        <data-grid-item title="Release year">
          {{ book.release_year }}
        </data-grid-item>

        <data-grid-item title="Series">
          <x-link
            v-if="book.series"
            :href="route('admin.books.series.show', book.series.id)"
          >
            {{ book.series.name }}
          </x-link>
          <template v-else>
            -
          </template>
        </data-grid-item>

        <data-grid-item
          title="Biography"
          full-width
        >
          <div class="max-w-2xl">
            <p
              class="whitespace-pre-line"
              v-text="book.description"
            />
          </div>
        </data-grid-item>
      </data-grid>
    </panel>
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { H4Title } from '@/Shared/Title'
import Avatar from '@/Shared/Avatar'
import { XLink } from '@/Shared/Link'
import DeleteBookLink from './Components/DeleteBookLink'
import { DataGrid, DataGridItem } from '@/Shared/DataGrid'
import Tag from '@/Shared/Tag'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    Panel,
    H4Title,
    Avatar,
    XLink,
    DeleteBookLink,
    DataGrid,
    DataGridItem,
    Tag,
  },
  props: {
    book: {
      type: Object,
      required: true,
    },
  },
}
</script>
