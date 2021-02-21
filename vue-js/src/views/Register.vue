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
                    <h2>Sign up</h2>
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
                    <form @submit.prevent="register">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          name="name"
                          placeholder="Name"
                          v-model="user.name"
                        />
                        <span
                          class="invalid-feedback d-block"
                          role="alert"
                          v-if="validation.name"
                        >
                          <strong>Masukkan Nama</strong>
                        </span>
                      </div>
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
                        <div class="row">
                          <div class="col">
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
                              <strong
                                >Masukkan Password (Minimal 8 karakter)</strong
                              >
                            </span>
                          </div>
                          <div class="col">
                            <input
                              type="password"
                              class="form-control"
                              name="password"
                              placeholder="Password Confirmation"
                              v-model="user.password_confirmation"
                            />
                            <span
                              class="invalid-feedback d-block"
                              role="alert"
                              v-if="validation.password_confirmation"
                            >
                              <strong>Password Konfirmasi tidak sama</strong>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div
                        class="forgot-password d-flex flex-column align-items-center mt-3 text-center"
                      >
                        <div>
                          <p>
                            By signing up, your confirm that you accept our
                            <br />
                            <a href="#">Terms of Use</a> and
                            <a href="#">privacy policy.</a>
                          </p>
                        </div>
                        <div>
                          <button
                            type="submit"
                            class="btn btn-lg btn-main rounded-pill my-auto rounded-pill px-4"
                            v-if="!registerClick"
                          >
                            <span> Sign Up </span>
                          </button>
                          <button
                            type="submit"
                            class="btn btn-lg btn-main rounded-pill my-auto rounded-pill px-4"
                            disabled
                            v-else
                          >
                            <b-spinner
                              style="width: 1.4rem; height: 1.4rem"
                              class="mx-4"
                            ></b-spinner>
                          </button>
                        </div>
                        <div class="mt-5">
                          <router-link
                            class="d-block mb-2"
                            :to="{ name: 'ForgotPassword' }"
                            >Lupa password?</router-link
                          >
                          <router-link class="d-block" :to="{ name: 'Login' }"
                            >Sudah punya akun?</router-link
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
  name: "Register",
  head: {
    title: function () {
      return { inner: "Sign Up", separator: "-", complement: "Info.In" };
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
      user: {
        password: "",
      },
      //state validation
      validation: [],
      googleClick: false,
      registerClick: false,
    };
  },
  methods: {
    register() {
      if (
        this.user.name &&
        this.user.email &&
        this.user.password.length >= 8 &&
        this.user.password == this.user.password_confirmation
      ) {
        this.registerClick = true;

        axios
          .get("https://dashboard.infoin.auroraweb.id/sanctum/csrf-cookie")
          .then(() => {
            axios
              .post("https://dashboard.infoin.auroraweb.id/api/register", {
                name: this.user.name,
                email: this.user.email,
                password: this.user.password,
                password_confirmation: this.user.password_confirmation,
              })
              .then(() => {
                this.$toasted.success(
                  "Register berhasil! Check email anda untuk verifikasi.",
                  {
                    position: "top-right",
                    className: "rounded",
                    duration: 5000,
                  }
                );

                //redirect dashboard
                return this.$router.push({ name: "VerifyEmail" });
              })
              .catch((error) => {
                this.loginClick = false;
                console.log(error);
                this.$toasted.error("Email telah terdaftar!", {
                  position: "top-right",
                  className: "rounded",
                  duration: 5000,
                });
              });
          });
      }

      this.validation = [];

      if (!this.user.name) {
        this.validation.name = true;
      }

      if (!this.user.email) {
        this.validation.email = true;
      }

      if (this.user.password.length < 8) {
        this.validation.password = true;
      }

      if (this.user.password != this.user.password_confirmation) {
        this.validation.password_confirmation = true;
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