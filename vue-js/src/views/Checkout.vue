<template>
  <div class="page-checkout" v-lazy-container="{ selector: 'img' }">
    <div class="checkout" data-aos="zoom-in">
      <div class="container">
        <div class="row align-items-center row-login justify-content-center">
          <div class="col-lg-8 text-center" data-aos="zoom-in">
            <img
              data-src="https://pilogon.miraistudio.id/storage/assets/summernote/XWFFlZUkWZypblAhgYiMG7oLSDgymh8WnkNOmubn.png"
              alt="checkout"
              class="img-fluid"
            />
            <h2 class="mt-4" style="font-weight: 600">Transaksi Berhasil</h2>
            <p>
              Terimakasih telah membantu saudara kita di <br />
              <strong v-if="Object.keys(donation).length > 0">
                " {{ donation.title }} "
              </strong>
              <br />
              Terkadang hal-hal sederhana bisa demikian berarti. Kamu membuat
              <br />
              kami tersenyum kembali 😊
            </p>
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
  name: "Checkout",
  head: {
    title: function () {
      return { inner: "Checkout", separator: "-", complement: "Info.In" };
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