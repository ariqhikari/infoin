<template>
  <div class="page-checkout" v-lazy-container="{ selector: 'img' }">
    <div class="checkout" data-aos="zoom-in">
      <div class="container">
        <div class="row align-items-center row-login justify-content-center">
          <div class="col-lg-8 text-center" data-aos="zoom-in">
            <img
              data-src="https://pilogon.miraistudio.id/storage/assets/summernote/n1K9GjTqtSWfj4hyDKgRNMXGknT0blC5tqpn4gAX.png"
              alt="blacklist"
              class="img-fluid"
            />
            <h2 class="mt-4" style="font-weight: 600">Blacklist User</h2>
            <p>User yang anda gunakan, telah terdaftar sebagai blacklist!</p>
            <router-link
              :to="{ name: 'Home' }"
              class="btn btn-main rounded-pill px-4 py-2 mt-3"
              >Back to Home</router-link
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Blacklist",
  head: {
    title: function () {
      return { inner: "Blacklist", separator: "-", complement: "Info.In" };
    },
  },
  data() {
    return {
      donation: {},
    };
  },
  methods: {
    setDonation(data) {
      this.donation = data;
    },
  },
  mounted() {
    axios
      .get(
        `https://dashboard.infoin.auroraweb.id/api/donation/${this.$route.params.slug}`
      )
      .then((response) => {
        this.setDonation(response.data.data);
      })
      .catch((error) => console.error(error));
  },
};
</script>

<style>
</style>