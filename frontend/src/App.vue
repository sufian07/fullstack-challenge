<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <header>
    <div class="wrapper text-center bg-green-300">
      <nav>
        <h2>
          <RouterLink to="/">Home</RouterLink>
        </h2>
      </nav>
    </div>
  </header>
  <RouterView />
</template>

<style scoped>

</style>
