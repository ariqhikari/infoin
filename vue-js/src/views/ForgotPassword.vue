<template>
  <div class="page-login">
    <div class="container-fluid">
      <div class="row justify-content-center" style="height: 100vh">
        <SideLogin />
        <div class="col-md-12 col-lg-6 d-flex align-items-center">
          <div class="container">
            <div class="row py-5 justify-content-center text-center">
              <div class="col-md-12 col-lg-10">
                <div class="row justify-content-center">
                  <div class="col-md-8 mb-3">
                    <h2>Forgot Password</h2>
                  </div>
                  <div class="col-md-8">
                    <form @submit.prevent="requestResetPassword">
                      <div class="form-group">
                        <input
                          type="email"
                          class="form-control"
                          name="email"
                          placeholder="Email Address"
                          v-model="email"
                          required
                        />
                      </div>
                      <div
                        class="forgot-password d-flex flex-column align-items-center mt-3"
                      >
                        <div>
                          <button
                            type="submit"
                            class="btn btn-lg btn-main rounded-pill my-auto rounded-pill px-4"
                            v-if="!forgotClick"
                          >
                            <span> Send Password Reset </span>
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
                        <div class="mt-5 text-center">
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
  name: "ForgotPassword",
  head: {
    title: function () {
      return {
        inner: "Forgot Password",
        separator: "-",
        complement: "Info.In",
      };
    },
  },
  components: {
    SideLogin,
  },
  data() {
    return {
      email: null,
      forgotClick: false,
    };
  },
  methods: {
    requestResetPassword() {
      this.forgotClick = true;

      axios
        .post("https://dashboard.infoin.auroraweb.id/api/reset-password", {
          email: this.email,
        })
        .then(() => {
          //debug user login
          this.email = null;
          this.forgotClick = false;
          this.$toasted.success("Password reset email sent.", {
            position: "top-right",
            className: "rounded",
            duration: 5000,
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style>
</style>