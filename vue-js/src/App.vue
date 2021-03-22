<template>
  <div id="app">
    <vue-page-transition name="overlay-right">
      <router-view />
    </vue-page-transition>
  </div>
</template>

<script>
export default {};
</script>

<style>
:root {
  --overlay-bg: #fe6665 !important;
  --transition-duration: 0.35s;
}
</style>
