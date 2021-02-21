<template>
  <div>
    <h1>Login with Google, please wait!</h1>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "LoginGoogle",
  head: {
    title: function () {
      return { inner: "Google", separator: "-", complement: "Info.In" };
    },
  },
  data() {
    return {
      //state loggedIn with localStorage
      loggedIn: localStorage.getItem("loggedIn"),
      //state token
      token: localStorage.getItem("token"),
      //state user
      user: [],
    };
  },
  methods: {
    loginUser() {
      axios
        .get(
          `https://dashboard.infoin.auroraweb.id/api/authorize/google/callback`,
          {
            params: {
              code: this.$route.query.code,
            },
          }
        )
        .then((response) => {
          if (response.data.user.blacklist == 0) {
            //set localStorage
            localStorage.setItem("loggedIn", "true");

            //set localStorage Token
            localStorage.setItem("token", response.data.token);

            //change state
            this.loggedIn = true;

            //redirect home
            return this.$router.push({ name: "Home" });
          } else {
            return this.$router.push({ name: "Blacklist" });
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.loginUser();
  },
};
</script>

<style>
</style>