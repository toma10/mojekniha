<template>
  <layout>
    <horizontal-spacer>
      <h2-title>{{ __('shared.users') }}</h2-title>

      <button-link :href="route('admin.users.create')">
        {{ __('users.create') }}
      </button-link>
    </horizontal-spacer>

    <x-table class="mt-5">
      <thead>
        <x-tr>
          <x-th>{{ __('shared.name') }}</x-th>
          <x-th>{{ __('shared.email') }}</x-th>
          <x-th>{{ __('shared.status') }}</x-th>
          <x-th>{{ __('shared.role') }}</x-th>
          <x-th />
        </x-tr>
      </thead>
      <tbody>
        <x-tr
          v-for="user in users.data"
          :key="user.id"
        >
          <x-td>
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
          </x-td>
          <x-td>{{ user.email }}</x-td>
          <x-td>
            <verified-tag :is-verified="user.is_verified" />
          </x-td>
          <x-td muted>
            <user-role :user="user" />
          </x-td>
          <x-td links>
            <x-link :href="route('admin.users.show', user.id)">
              {{ __('shared.show') }}
            </x-link>
            <x-link :href="route('admin.users.edit', user.id)">
              {{ __('shared.edit') }}
            </x-link>
            <delete-user-link :user="user" />
          </x-td>
        </x-tr>
      </tbody>
    </x-table>

    <pagination
      class="mt-6"
      :links="users.links"
    />
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import { H2Title } from '@/Shared/Title'
import { ButtonLink } from '@/Shared/Link'
import { XLink } from '@/Shared/Link'
import Avatar from '@/Shared/Avatar'
import { XTable, XTr, XTh, XTd } from '@/Shared/Table'
import VerifiedTag from './Components/VerifiedTag'
import UserRole from './Components/UserRole'
import DeleteUserLink from './Components/DeleteUserLink'
import Pagination from '@/Shared/Pagination'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    H2Title,
    ButtonLink,
    XLink,
    Avatar,
    XTable,
    XTr,
    XTh,
    XTd,
    VerifiedTag,
    UserRole,
    DeleteUserLink,
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
