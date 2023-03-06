<script>
import { UserCircleIcon, CloudIcon } from "@heroicons/vue/24/outline";
export default {
  data: () => ({
    users: [],
  }),

  created() {
    this.fetchData();
  },

  methods: {
    async fetchData() {
      const url = "http://localhost:8081/";
      const apiResponse = await (await fetch(url)).json();
      this.users = apiResponse?.users ?? [];
    },
  },
};
</script>

<template>
  <div v-if="users.length < 1">Pinging the api...</div>

  <div class="container m-auto" v-else>
    <ul class="max-w-md m-auto divide-y divide-gray-200 dark:divide-gray-700">
      <li :key="user.id" v-for="user in users" class="pb-3 sm:pb-4">
        <div class="flex items-center space-x-4">
          <div class="flex-shrink-0">
            <UserCircleIcon class="h-6 w-6 text-blue-500" />
          </div>
          <div class="flex-1 min-w-0">
            <p
              class="text-sm font-medium text-gray-900 truncate dark:text-white"
            >
              {{ user.name }}
            </p>
            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
              {{ user.email }}
            </p>
          </div>
          <div
            class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"
          >
            <CloudIcon class="h-6 w-6 text-blue-500" />
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>
