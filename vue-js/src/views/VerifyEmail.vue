<template>
  <div class="page-login">
    <div class="container-fluid">
      <div class="row justify-content-center" style="height: 100vh">
        <SideLogin />
        <div class="col-md-12 col-lg-6 d-flex align-items-center text-center">
          <div class="container">
            <div class="row py-5 justify-content-center">
              <div class="col-md-12 col-lg-10">
                <div class="row">
                  <div class="col-md-12 mb-2">
                    <h2>Verify Your Email Address</h2>
                  </div>
                  <div class="col-md-12">
                    <form @submit.prevent="verifyEmail">
                      <div class="form-group" style="font-weight: 600">
                        <h5>
                          Before proceeding, please check your email for a
                          verification link. If you did not receive the email.
                        </h5>
                      </div>
                      <div
                        class="forgot-password d-flex flex-column align-items-center mt-4"
                      >
                        <div>
                          <button
                            type="submit"
                            class="btn btn-lg btn-main rounded-pill my-auto rounded-pill px-4"
                            v-if="!verifyClick"
                          >
                            <span> Click Here To Request Another </span>
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
  name: "VerifyEmail",
  head: {
    title: function () {
      return { inner: "Verify Email", separator: "-", complement: "Info.In" };
    },
  },
  components: {
    SideLogin,
  },

  data() {
    return {
      loggedIn: null,
      //state token
      token: localStorage.getItem("token"),
      //state user logged In
      user: [],
      verifyClick: false,
    };
  },

  created() {
    axios
      .get("https://dashboard.infoin.auroraweb.id/api/user", {
        headers: { Authorization: "Bearer " + this.token },
      })
      .then((response) => {
        console.log(response);
        this.user = response.data; // assign response to state user
        this.$emit("setDataUser", this.user.id);
      });
  },

  methods: {
    getLoggedIn() {
      this.loggedIn = localStorage.getItem("loggedIn");
    },
    verifyEmail() {
      this.verifyClick = true;

      axios
        .post(
          "https://dashboard.infoin.auroraweb.id/api/email-verification",
          this.user
        )
        .then(() => {
          this.verifyClick = false;

          this.$toasted.success("Email berhasil dikirim!", {
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

  //check user already logged in
  mounted() {
    if (this.loggedIn) {
      return this.$router.push({ name: "Login" });
    }
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