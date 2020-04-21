<template>
  <layout>
    <x-content>
      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
          <div class="flex justify-between items-center">
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
              <x-link href="#">
                Edit
              </x-link>
              <x-link href="#">
                Delete
              </x-link>
            </div>
          </div>
        </div>
        <div class="px-4 py-5 sm:p-6">
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
              <role
                :user="user"
                class="text-gray-500"
              >
                {{ user.email }}
              </role>
            </div>
          </div>
        </div>
      </div>
    </x-content>
  </layout>
</template>

<script>
import Layout, { XContent } from '@/Shared/Layout'
import { H4Title } from '@/Shared/Title'
import VerifiedTag from './Components/VerifiedTag'
import Role from './Components/Role'
import XLink from '@/Shared/XLink'
import Avatar from '@/Shared/Avatar'

export default {
  components: {
    Layout,
    XContent,
    H4Title,
    VerifiedTag,
    Role,
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
