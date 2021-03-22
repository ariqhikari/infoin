<template>
  <!-- Navbar -->
  <b-navbar
    toggleable="lg"
    class="navbar navbar-expand-lg navbar-light bg-transparent shadow-none"
  >
    <div class="container">
      <b-navbar-brand href="#" class="font-weight-bold">
        <router-link
          class="text-dark text-decoration-none"
          :to="{ name: 'Home' }"
          v-lazy-container="{ selector: 'img' }"
        >
          <img
            data-src="/assets/logo.png"
            alt="Info.In"
            width="50"
            height="50"
          />
        </router-link>
      </b-navbar-brand>

      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto align-items-lg-center">
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'Home' }"
              >Home</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'Article' }"
              >Article</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'Donation' }"
              >Donation</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'Event' }"
              >Event</router-link
            >
          </li>
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'About' }"
              >About</router-link
            >
          </li>
          <li v-if="loggedIn">
            <b-nav-item-dropdown v-if="user.name">
              <template #button-content>
                <img
                  v-lazy="user.avatar"
                  :alt="user.name"
                  v-if="user.google_id"
                  class="rounded-circle mr-2"
                  width="40"
                  height="40"
                />
                <img
                  v-lazy="
                    `https://dashboard.infoin.auroraweb.id/storage/${user.avatar}`
                  "
                  :alt="user.name"
                  v-else
                  class="rounded-circle mr-2"
                  width="40"
                  height="40"
                />
                {{ user.name }}
              </template>
              <b-dropdown-item
                :href="`https://dashboard.infoin.auroraweb.id?u=${user.token}`"
                target="_blank"
              >
                Dashboard
              </b-dropdown-item>
              <div class="dropdown-divider"></div>
              <b-dropdown-item @click.prevent="logout">
                Logout
              </b-dropdown-item>
            </b-nav-item-dropdown>
            <div v-else class="d-flex">
              <b-skeleton type="avatar"></b-skeleton>
            </div>
          </li>
          <li class="nav-item d-flex align-items-center" v-else>
            <router-link
              class="nav-link my-auto btn-main btn-block rounded-pill text-center text-white px-3"
              :to="{ name: 'Login' }"
              >Login</router-link
            >
          </li>
        </b-navbar-nav>
      </b-collapse>
    </div>
  </b-navbar>
</template>

<script>
import axios from "axios";

export default {
  name: "Navbar",

  data() {
    return {
      loggedIn: null,
      //state token
      token: localStorage.getItem("token"),
      //state user logged In
      user: [],
    };
  },

  created() {
    if (localStorage.getItem("loggedIn")) {
      axios
        .get("https://dashboard.infoin.auroraweb.id/api/user", {
          headers: { Authorization: "Bearer " + this.token },
        })
        .then((response) => {
          this.user = response.data; // assign response to state user
          this.$emit("setDataUser", this.user);
        });
    }
  },

  methods: {
    logout() {
      axios
        .post("https://dashboard.infoin.auroraweb.id/api/logout", {
          id: this.user.id,
        })
        .then(() => {
          localStorage.removeItem("loggedIn");
          localStorage.removeItem("token");
          this.user = [];
          this.getLoggedIn();
        });
    },
    getLoggedIn() {
      this.loggedIn = localStorage.getItem("loggedIn");
    },
  },

  watch: {
    $route: {
      immediate: true,
      handler() {
        this.getLoggedIn();
      },
    },
  },
};
</script>

<style>
</style>