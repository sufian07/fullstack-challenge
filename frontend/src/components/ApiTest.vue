<script>
export default {
  data: () => ({
    users: [],
    isModalVisible: false,
    wether: {},
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
    async fetchWatherData(userId, userName) {
      const url = `http://localhost:8081/${userId}`;
      const apiResponse = await (await fetch(url)).json();
      this.wether = { ...apiResponse, userName };
      this.isModalVisible = true;
    },
    onToggle() {
      this.isModalVisible = !this.isModalVisible;
    },
  },
};
</script>

<template>
  <transition name="fade">
    <div v-if="isModalVisible">
      <div
        @click="onToggle"
        class="fixed overflow-hidden bg-black opacity-70 inset-0 z-0"
      ></div>
      <div
        class="w-full max-w-lg p-3 fixed mx-auto my-auto rounded-xl shadow-lg bg-white"
        style="top: 25vh; left: 25vw"
      >
        <div>
          <div class="text-center p-3 flex-auto justify-center leading-6">
            <font-awesome-icon icon="fa-solid fa-cloud" />
            <h2 class="text-2xl font-bold py-4">
              Wether for {{ wether.userName }}
            </h2>
            <div v-if="wether.detailedForecast">
              <p class="text-md text-gray-500 px-8">
                {{ wether.detailedForecast }}
              </p>
            </div>
            <div v-else>
              <p class="text-md text-gray-500 px-8">
                No weather data available !!
              </p>
            </div>
          </div>
          <div class="p-3 mt-2 text-center space-x-4 md:block">
            <button
              @click="onToggle"
              class="mb-2 md:mb-0 bg-purple-500 border border-purple-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-md hover:shadow-lg hover:bg-purple-600"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </transition>
  <div class="bg-green-200">
    <div v-if="users.length < 1">Pinging the api...</div>
    <div class="container m-auto" v-else>
      <ul class="max-w-md m-auto divide-y divide-gray-200 dark:divide-gray-700">
        <li :key="user.id" v-for="user in users" class="pb-3 sm:pb-4">
          <div class="flex items-center space-x-4">
            <div class="flex-shrink-0 text-white">
              <font-awesome-icon icon="fa-solid fa-user" />
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
              v-bind:style="{ cursor: 'pointer' }"
              class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white text-white"
              @click="fetchWatherData(user.id, user.name)"
            >
              <font-awesome-icon icon="fa-solid fa-cloud" />
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>
