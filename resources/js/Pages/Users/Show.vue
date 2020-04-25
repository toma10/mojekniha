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
              Edit
            </x-link>
            <delete-user-link :user="user" />
          </div>
        </horizontal-spacer>
      </template>

      <div class="grid gap-4 grid-cols-1 md:grid-cols-2">
        <div>
          <div>Email</div>
          <div class="text-gray-500">
            {{ user.email }}
          </div>
        </div>
        <div>
          <div>Status</div>
          <div>
            <verified-tag :is-verified="user.is_verified" />
          </div>
        </div>
        <div>
          <div>Role</div>
          <user-role
            :user="user"
            class="text-gray-500"
          />
        </div>
      </div>
    </panel>
  </layout>
</template>

<script>
import Layout, { HorizontalSpacer } from '@/Shared/Layout'
import Panel from '@/Shared/Panel'
import { H4Title } from '@/Shared/Title'
import VerifiedTag from './Components/VerifiedTag'
import UserRole from './Components/UserRole'
import DeleteUserLink from './Components/DeleteUserLink'
import { XLink } from '@/Shared/Link'
import Avatar from '@/Shared/Avatar'

export default {
  components: {
    Layout,
    HorizontalSpacer,
    Panel,
    H4Title,
    VerifiedTag,
    UserRole,
    DeleteUserLink,
    XLink,
    Avatar,
  },
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
}
</script>
