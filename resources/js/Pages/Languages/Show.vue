<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>
          Language data
        </h4-title>
      </template>

      <data-grid>
        <data-grid-item title="Id">
          {{ language.id }}
        </data-grid-item>

        <data-grid-item title="Name">
          {{ language.name }}
        </data-grid-item>
      </data-grid>
    </panel>
  </layout>
</template>

<script>
import Layout from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { H4Title } from '@/Shared/Title'
import { DataGrid, DataGridItem } from '@/Shared/DataGrid'

export default {
  components: {
    Layout,
    Panel,
    H4Title,
    DataGrid,
    DataGridItem,
  },
  props: {
    language: {
      type: Object,
      required: true,
    },
  },
}
</script>
