<template>
  <div class="page-login" v-lazy-container="{ selector: 'img' }">
    <div class="container-fluid">
      <div class="row justify-content-center" style="height: 100vh">
        <SideLogin />
        <div class="col-md-12 col-lg-6 d-flex align-items-center">
          <div class="container">
            <div class="row py-5 justify-content-center">
              <div class="col-md-12 col-lg-10">
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <h2>Sign In</h2>
                  </div>
                  <div class="col-md-12">
                    <a
                      class="btn btn-primary btn-block text-white"
                      @click="loginGoogle"
                      v-if="!googleClick"
                    >
                      <span>
                        <img data-src="/assets/icons/google.svg" alt="google" />
                        Sign in with Google
                      </span>
                    </a>
                    <a
                      class="btn btn-primary btn-block text-white disabled"
                      v-else
                    >
                      <b-spinner
                        style="width: 1.4rem; height: 1.4rem"
                        class="mx-4 my-2"
                      ></b-spinner>
                    </a>
                  </div>
                  <div class="col-md-12 d-flex align-items-center mb-4">
                    <hr class="w-100" />
                    <span class="mx-2">or</span>
                    <hr class="w-100" />
                  </div>
                  <div class="col-md-12">
                    <form @submit.prevent="login">
                      <div class="form-group">
                        <input
                          type="email"
                          class="form-control"
                          name="email"
                          placeholder="Email Address"
                          v-model="user.email"
                        />
                        <span
                          class="invalid-feedback d-block"
                          role="alert"
                          v-if="validation.email"
                        >
                          <strong>Masukkan Email</strong>
                        </span>
                      </div>
                      <div class="form-group">
                        <input
                          type="password"
                          class="form-control"
                          name="password"
                          placeholder="Password"
                          v-model="user.password"
                        />
                        <span
                          class="invalid-feedback d-block"
                          role="alert"
                          v-if="validation.password"
                        >
                          <strong>Masukkan Password</strong>
                        </span>
                      </div>
                      <div
                        class="forgot-password d-flex flex-column align-items-center mt-3"
                      >
                        <div>
                          <button
                            v-if="!loginClick"
                            type="submit"
                            class="btn btn-lg btn-main rounded-pill my-auto rounded-pill px-4"
                          >
                            <span> Sign In </span>
                          </button>
                          <button
                            v-else
                            type="submit"
                            class="btn btn-lg btn-main rounded-pill my-auto rounded-pill px-4"
                            disabled
                          >
                            <b-spinner
                              style="width: 1.4rem; height: 1.4rem"
                              class="mx-4"
                            ></b-spinner>
                          </button>
                        </div>
                        <div class="mt-5 text-center">
                          <router-link
                            class="d-block mb-2"
                            :to="{ name: 'ForgotPassword' }"
                            >Lupa password?</router-link
                          >
                          <router-link
                            class="d-block"
                            :to="{ name: 'Register' }"
                            >Belum punya akun?</router-link
                          >
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SideLogin from "@/components/SideLogin.vue";

import axios from "axios";

export default {
  name: "Login",
  head: {
    title: function () {
      return { inner: "Sign In", separator: "-", complement: "Info.In" };
    },
  },
  components: {
    SideLogin,
  },

  data() {
    return {
      //state loggedIn with localStorage
      loggedIn: localStorage.getItem("loggedIn"),
      //state token
      token: localStorage.getItem("token"),
      //state user
      user: [],
      //state validation
      validation: [],
      googleClick: false,
      loginClick: false,
    };
  },
  methods: {
    login() {
      if (this.user.email && this.user.password) {
        this.loginClick = true;

        axios
          .get("https://dashboard.infoin.auroraweb.id/sanctum/csrf-cookie")
          .then(() => {
            axios
              .post("https://dashboard.infoin.auroraweb.id/api/login", {
                email: this.user.email,
                password: this.user.password,
              })
              .then((response) => {
                if (
                  response.data.user.blacklist == 0 &&
                  response.data.user.email_verified_at != null
                ) {
                  //set localStorage
                  localStorage.setItem("loggedIn", "true");

                  //set localStorage Token
                  localStorage.setItem("token", response.data.token);

                  //change state
                  this.loggedIn = true;

                  //redirect home
                  return this.$router.push({ name: "Home" });
                } else if (response.data.user.email_verified_at == null) {
                  //set localStorage Token
                  localStorage.setItem("token", response.data.token);

                  //redirect verify
                  return this.$router.push({ name: "VerifyEmail" });
                } else {
                  return this.$router.push({ name: "Blacklist" });
                }
              })
              .catch((error) => {
                this.loginClick = false;
                console.log(error);
                this.$toasted.error("Email / Password Salah!", {
                  position: "top-right",
                  className: "rounded",
                  duration: 5000,
                });
              });
          })
          .catch((error) => {
            console.log(error);
          });
      }

      this.validation = [];

      if (!this.user.email) {
        this.validation.email = true;
      }

      if (!this.user.password) {
        this.validation.password = true;
      }
    },

    loginGoogle() {
      this.googleClick = true;

      axios
        .get(
          "https://dashboard.infoin.auroraweb.id/api/authorize/google/redirect"
        )
        .then((response) => {
          if (response.data.url) {
            window.location.href = response.data.url;
          }
        })
        .catch((error) => {
          console.log(error);
          this.googleClick = false;
        });
    },
  },

  //check user already logged in
  mounted() {
    if (this.loggedIn) {
      return this.$router.push({ name: "Home" });
    }
  },
};
</script>

<style>
</style>