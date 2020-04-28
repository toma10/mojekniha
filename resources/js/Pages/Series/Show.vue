<template>
  <layout>
    <panel>
      <template #header>
        <horizontal-spacer>
          <h4-title>
            Series detail
          </h4-title>
          <div class="space-x-1">
            <x-link :href="route('admin.books.series.edit', series.id)">
              Edit
            </x-link>
            <delete-series-link :series="series" />
          </div>
        </horizontal-spacer>
      </template>

      <data-grid>
        <data-grid-item title="Id">
          {{ series.id }}
        </data-grid-item>

        <data-grid-item title="Name">
          {{ series.name }}
        </data-grid-item>

        <data-grid-item title="Author">
          <x-link :href="route('admin.books.authors.show', series.author.id)">
            {{ series.author.name }}
          </x-link>
        </data-grid-item>
      </data-grid>
    </panel>
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { XLink } from '@/Shared/Link'
import DeleteSeriesLink from './Components/DeleteSeriesLink'
import { H4Title } from '@/Shared/Title'
import { DataGrid, DataGridItem } from '@/Shared/DataGrid'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    Panel,
    H4Title,
    XLink,
    DeleteSeriesLink,
    DataGrid,
    DataGridItem,
  },
  props: {
    series: {
      type: Object,
      required: true,
    },
  },
}
</script>
