<template>
  <layout>
    <h2-title class="text-2xl font-semibold text-gray-900">
      Languages
    </h2-title>

    <div class="mt-5 flex flex-col">
      <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
          <table class="min-w-full">
            <thead>
              <tr>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Id
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  Name
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider" />
              </tr>
            </thead>
            <tbody class="bg-white">
              <tr
                v-for="language in languages.data"
                :key="language.id"
                class="even:bg-gray-50"
              >
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="text-sm leading-5 text-gray-900">
                    {{ language.id }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                  <div class="text-sm leading-5 text-gray-900">
                    {{ language.name }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium space-x-1">
                  <x-link :href="route('admin.books.languages.show', language.id)">
                    Show
                  </x-link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <pagination
      class="mt-6"
      :links="languages.links"
    />
  </layout>
</template>

<script>
import Layout from '@/Shared/Layout'
import { H2Title } from '@/Shared/Title'
import { XLink } from '@/Shared/Link'
import Pagination from '@/Shared/Pagination'

export default {
  components: {
    Layout,
    H2Title,
    XLink,
    Pagination,
  },
  props: {
    languages: {
      type: Object,
      required: true,
    },
  },
}
</script>
