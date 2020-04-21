<template>
  <layout>
    <x-content>
      <h2-title class="text-2xl font-semibold text-gray-900">
        Users
      </h2-title>

      <div class="mt-5 flex flex-col">
        <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
          <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
              <thead>
                <tr>
                  <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Name
                  </th>
                  <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Email
                  </th>
                  <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Status
                  </th>
                  <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                    Role
                  </th>
                  <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider" />
                </tr>
              </thead>
              <tbody class="bg-white">
                <tr
                  v-for="user in users.data"
                  :key="user.id"
                >
                  <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <img
                          class="h-10 w-10 rounded-full"
                          :src="user.avatar_url"
                          alt="Avatar image"
                        >
                      </div>
                      <div class="ml-4">
                        <div class="text-sm leading-5 font-medium text-gray-900">
                          {{ user.name }}
                        </div>
                        <div class="text-sm leading-5 text-gray-500">
                          {{ user.username }}
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-900">
                      {{ user.email }}
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <span
                      v-if="user.is_verified"
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
                    >
                      Verified
                    </span>
                    <span
                      v-else
                      class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
                    >
                      Unverified
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                    <span v-if="user.is_admin">Admin</span>
                    <span v-else>User</span>
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium space-x-1">
                    <a
                      href="#"
                      class="text-indigo-600 hover:text-indigo-900"
                    >
                      Show
                    </a>
                    <a
                      href="#"
                      class="text-indigo-600 hover:text-indigo-900"
                    >
                      Edit
                    </a>
                    <a
                      href="#"
                      class="text-indigo-600 hover:text-indigo-900"
                    >
                      Delete
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <pagination
        class="mt-6"
        :links="users.links"
      />
    </x-content>
  </layout>
</template>

<script>
import Layout, { XContent } from '@/Shared/Layout'
import { H2Title } from '@/Shared/Title'
import Pagination from '@/Shared/Pagination'

export default {
  components: {
    Layout,
    XContent,
    H2Title,
    Pagination,
  },
  props: {
    users: {
      type: Object,
      required: true,
    },
  },
}
</script>
