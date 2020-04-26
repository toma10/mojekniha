<template>
  <layout>
    <panel>
      <template #header>
        <horizontal-spacer>
          <h4-title>
            Book binding detail
          </h4-title>
          <div class="space-x-1">
            <x-link :href="route('admin.books.bookBindings.edit', bookBinding.id)">
              Edit
            </x-link>
            <delete-book-binding-link :book-binding="bookBinding" />
          </div>
        </horizontal-spacer>
      </template>

      <data-grid>
        <data-grid-item title="Id">
          {{ bookBinding.id }}
        </data-grid-item>

        <data-grid-item title="Name">
          {{ bookBinding.name }}
        </data-grid-item>
      </data-grid>
    </panel>
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { XLink } from '@/Shared/Link'
import DeleteBookBindingLink from './Components/DeleteBookBindingLink'
import { H4Title } from '@/Shared/Title'
import { DataGrid, DataGridItem } from '@/Shared/DataGrid'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    Panel,
    H4Title,
    XLink,
    DeleteBookBindingLink,
    DataGrid,
    DataGridItem,
  },
  props: {
    bookBinding: {
      type: Object,
      required: true,
    },
  },
}
</script>
