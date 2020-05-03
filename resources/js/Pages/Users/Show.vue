<template>
  <layout>
    <panel>
      <template #header>
        <horizontal-spacer>
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <avatar :url="user.avatar_url" />
            </div>
            <div class="ml-4">
              <h4-title>
                {{ user.name }}
              </h4-title>
              <div class="text-sm leading-5 text-gray-500">
                {{ user.username }}
              </div>
            </div>
          </div>
          <div class="space-x-1">
            <x-link :href="route('admin.users.edit', user.id)">
              {{ __('shared.edit') }}
            </x-link>
            <delete-user-link :user="user" />
          </div>
        </horizontal-spacer>
      </template>

      <data-grid>
        <data-grid-item :title="__('shared.email')">
          {{ user.email }}
        </data-grid-item>

        <data-grid-item :title="__('shared.status')">
          <verified-tag :is-verified="user.is_verified" />
        </data-grid-item>

        <data-grid-item :title="__('shared.role')">
          <user-role :user="user" />
        </data-grid-item>
      </data-grid>
    </panel>
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { H4Title } from '@/Shared/Title'
import Avatar from '@/Shared/Avatar'
import { XLink } from '@/Shared/Link'
import DeleteUserLink from './Components/DeleteUserLink'
import { DataGrid, DataGridItem } from '@/Shared/DataGrid'
import VerifiedTag from './Components/VerifiedTag'
import UserRole from './Components/UserRole'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    Panel,
    H4Title,
    Avatar,
    XLink,
    DeleteUserLink,
    DataGrid,
    DataGridItem,
    VerifiedTag,
    UserRole,
  },
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
}
</script>
