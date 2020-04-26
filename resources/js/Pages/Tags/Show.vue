<template>
  <layout>
    <panel>
      <template #header>
        <horizontal-spacer>
          <h4-title>
            Tag detail
          </h4-title>
          <div class="space-x-1">
            <x-link :href="route('admin.books.tags.edit', tag.id)">
              Edit
            </x-link>
            <delete-tag-link :tag="tag" />
          </div>
        </horizontal-spacer>
      </template>

      <data-grid>
        <data-grid-item title="Id">
          {{ tag.id }}
        </data-grid-item>

        <data-grid-item title="Name">
          {{ tag.name }}
        </data-grid-item>
      </data-grid>
    </panel>
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { XLink } from '@/Shared/Link'
import DeleteTagLink from './Components/DeleteTagLink'
import { H4Title } from '@/Shared/Title'
import { DataGrid, DataGridItem } from '@/Shared/DataGrid'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    Panel,
    H4Title,
    XLink,
    DeleteTagLink,
    DataGrid,
    DataGridItem,
  },
  props: {
    tag: {
      type: Object,
      required: true,
    },
  },
}
</script>
