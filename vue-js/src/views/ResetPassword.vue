<template>
  <div class="page-login">
    <div class="container-fluid">
      <div class="row justify-content-center" style="height: 100vh">
        <SideLogin />
        <div class="col-md-12 col-lg-6 d-flex align-items-center">
          <div class="container">
            <div class="row py-5 justify-content-center">
              <div class="col-md-12 col-lg-10">
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <h2>Reset Password</h2>
                  </div>
                  <div class="col-md-12">
                    <form @submit.prevent="resetPassword">
                      <div class="form-group">
                        <input
                          type="email"
                          class="form-control"
                          name="email"
                          placeholder="Email Address"
                          v-model="email"
                          readonly
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
                              v-model="password"
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
                              v-model="password_confirmation"
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
                          <button
                            type="submit"
                            class="btn btn-lg btn-main rounded-pill my-auto rounded-pill px-4"
                            v-if="!resetClick"
                          >
                            <span> Change Password </span>
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
  name: "ResetPassword",
  head: {
    title: function () {
      return { inner: "Reset Password", separator: "-", complement: "Info.In" };
    },
  },
  components: {
    SideLogin,
  },

  data() {
    return {
      token: null,
      email: null,
      password: "",
      password_confirmation: null,
      //state validation
      validation: [],
      resetClick: false,
    };
  },
  methods: {
    resetPassword() {
      if (
        this.email &&
        this.password.length >= 8 &&
        this.password == this.password_confirmation
      ) {
        this.resetClick = true;

        axios
          .post("https://dashboard.infoin.auroraweb.id/api/reset/password", {
            token: this.$route.params.token,
            email: this.email,
            password: this.password,
            password_confirmation: this.password_confirmation,
          })
          .then(() => {
            //debug user login
            this.resetClick = false;
            this.$router.push({ name: "Login" });
          })
          .catch((error) => {
            console.log(error);
          });
      }

      this.validation = [];

      if (!this.email) {
        this.validation.email = true;
      }

      if (this.password.length < 8) {
        this.validation.password = true;
      }

      if (this.password != this.password_confirmation) {
        this.validation.password_confirmation = true;
      }
    },
  },
  mounted() {
    axios
      .get(
        `https://dashboard.infoin.auroraweb.id/api/reset/${this.$route.params.token}`
      )
      .then((response) => {
        //debug user login
        this.email = response.data.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>

<style>
</style>