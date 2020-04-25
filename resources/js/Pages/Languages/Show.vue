<template>
  <layout>
    <panel>
      <template #header>
        <h4-title>
          Language detail
        </h4-title>
      </template>

      <div class="grid gap-4 grid-cols-1 md:grid-cols-2">
        <div>
          <div>Id</div>
          <div class="text-gray-500">
            {{ language.id }}
          </div>
        </div>
        <div>
          <div>Name</div>
          <div class="text-gray-500">
            {{ language.name }}
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
    language: {
      type: Object,
      required: true,
    },
  },
}
</script>
