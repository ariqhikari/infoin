<template>
  <div>
    <h1>Email Verify, please wait!</h1>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "ConfirmEmail",
  head: {
    title: function () {
      return { inner: "Confirm Email", separator: "-", complement: "Info.In" };
    },
  },
  mounted() {
    axios
      .get(
        `https://dashboard.infoin.auroraweb.id/api/verify/${this.$route.params.token}`
      )
      .then((response) => {
        //set localStorage
        localStorage.setItem("loggedIn", "true");

        //set localStorage Token
        localStorage.setItem("token", response.data.token);

        // Redirect Home
        return this.$router.push({ name: "Home" });
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>

<style>
</style>