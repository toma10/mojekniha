<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>
          Nationality detail
        </h4-title>
      </template>

      <data-grid>
        <data-grid-item title="Id">
          {{ nationality.id }}
        </data-grid-item>

        <data-grid-item title="Name">
          {{ nationality.name }}
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
    nationality: {
      type: Object,
      required: true,
    },
  },
}
</script>
