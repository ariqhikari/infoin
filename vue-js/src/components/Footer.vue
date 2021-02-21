<template>
  <!-- Footer -->
  <footer class="mt-5 text-center text-md-left">
    <div class="container py-5">
      <div class="row">
        <div class="col">
          <h1>Info.In</h1>
        </div>
      </div>
      <div class="row mt-5 justify-content-end">
        <div class="col-md-6 col-lg-4 mt-5 mt-md-3">
          <div class="row">
            <div class="col-md-6 d-flex flex-column">
              <h4 class="mb-4 text-white">Page</h4>
              <router-link class="mb-3" :to="{ name: 'Home' }"
                >Home</router-link
              >
              <router-link class="mb-3" :to="{ name: 'Article' }"
                >Article</router-link
              >
              <router-link class="mb-3" :to="{ name: 'Donation' }"
                >Donation</router-link
              >
              <router-link class="mb-3" :to="{ name: 'Event' }"
                >Event</router-link
              >
              <router-link :to="{ name: 'About' }" class="mb-3"
                >About</router-link
              >
            </div>
            <div class="col-md-6 d-flex flex-column">
              <h4 class="mb-4 text-white">Company</h4>
              <router-link :to="{ name: 'About' }" class="mb-3"
                >About</router-link
              >
              <router-link :to="{ name: 'About' }" class="mb-3"
                >Team</router-link
              >
              <router-link :to="{ name: 'About' }" class="mb-3"
                >Contact</router-link
              >
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <p class="copyright">© 2020 Info.In All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: "Footer",
};
</script>

<style>
</style>