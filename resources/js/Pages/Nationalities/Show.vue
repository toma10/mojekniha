<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>
          Nationality detail
        </h4-title>
      </template>

      <div class="grid gap-4 grid-cols-1 md:grid-cols-2">
        <div>
          <div>Id</div>
          <div class="text-gray-500">
            {{ nationality.id }}
          </div>
        </div>
        <div>
          <div>Name</div>
          <div class="text-gray-500">
            {{ nationality.name }}
          </div>
        </div>
      </div>
    </panel>
  </layout>
</template>

<script>
import Layout from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { H4Title } from '@/Shared/Title'

export default {
  components: {
    Layout,
    Panel,
    H4Title,
  },
  props: {
    nationality: {
      type: Object,
      required: true,
    },
  },
}
</script>
