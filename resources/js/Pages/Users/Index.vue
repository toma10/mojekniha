<template>
  <layout>
    <horizontal-spacer>
      <h2-title class="text-2xl font-semibold text-gray-900">
        Users
      </h2-title>

      <button-link :href="route('admin.users.create')">
        Create user
      </button-link>
    </horizontal-spacer>

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
                    <div class="flex-shrink-0">
                      <avatar :url="user.avatar_url" />
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
                  <verified-tag :is-verified="user.is_verified" />
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                  <role :user="user" />
                </td>
                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium space-x-1">
                  <x-link :href="route('admin.users.show', user.id)">
                    Show
                  </x-link>
                  <x-link :href="route('admin.users.edit', user.id)">
                    Edit
                  </x-link>
                  <x-link href="#">
                    Delete
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
      :links="users.links"
    />
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import { H2Title } from '@/Shared/Title'
import ButtonLink from '@/Shared/ButtonLink'
import XLink from '@/Shared/XLink'
import Avatar from '@/Shared/Avatar'
import VerifiedTag from './Components/VerifiedTag'
import Role from './Components/Role'
import Pagination from '@/Shared/Pagination'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    H2Title,
    ButtonLink,
    XLink,
    Avatar,
    VerifiedTag,
    Role,
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
