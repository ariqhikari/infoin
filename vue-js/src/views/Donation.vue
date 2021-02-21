<template>
  <div class="page-donasi">
    <Navbar v-on:setDataUser="getDataUser" />
    <!-- Jumbotron -->
    <div class="jumbotron bg-transparent">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mt-lg-5" v-lazy-container="{ selector: 'img' }">
            <img data-src="/assets/icons/dolar.svg" alt="dolar" />
            <h1 class="display-4 font-weight-bolder">
              Ayo <br />
              Golong Dana
            </h1>
            <p>
              Walau hanya seribu dari uangmu, nominal itu sangat berharga <br />
              bagi orang lain.
            </p>
            <br />
            <a
              v-if="user.token"
              :href="`https://dashboard.infoin.auroraweb.id?u=${user.token}`"
              target="_blank"
              class="btn-main text-center text-white py-2 px-5 rounded-pill text-decoration-none"
              style="border-radius: 25px"
            >
              Galang Dana Sekarang
            </a>
            <router-link
              v-else
              :to="{
                name: 'Login',
              }"
              class="btn-main text-center text-white py-2 px-5 rounded-pill text-decoration-none"
              style="border-radius: 25px"
            >
              Galang Dana Sekarang
            </router-link>
          </div>
          <div
            class="col-lg-6 d-none d-lg-block mt-5"
            v-lazy-container="{ selector: 'img' }"
          >
            <img
              data-src="https://pilogon.miraistudio.id/storage/assets/summernote/OdXE0SYxzDEjfilXRVURb1frWpsGzSVr5mROXcFL.png"
              alt="donasi"
              class="img-fluid"
            />
          </div>
        </div>
      </div>
    </div>

    <!-- Carousel -->
    <div class="container carousel-donasi mb-5">
      <div class="row justify-content-center">
        <div class="col-md-12 hero-title">
          <span class="rounded-pill"></span>
          <h3>Donation Mendesak</h3>
        </div>
      </div>
      <VueSlickCarousel
        v-bind="settings"
        v-if="dangerDonations.length > 0"
        class="row justify-content-center vue-carousel"
      >
        <div
          class="col-12 my-3"
          v-for="donation in dangerDonations"
          :key="donation.id"
        >
          <div
            class="card px-2 card-donation"
            :style="`background: url(https://dashboard.infoin.auroraweb.id/storage/${donation.thumbnail});
                background-size: cover;
                background-position: center;`"
          >
            <div
              class="card-body d-flex flex-column justify-content-between mt-5"
            >
              <div>
                <h5 class="card-title" v-if="donation.title.length > 50">
                  {{ strippedContent(donation.title, 50) }}..
                </h5>
                <h5 class="card-title" v-else>
                  {{ strippedContent(donation.title, 50) }}
                </h5>
                <div
                  class="row justify-content-between align-items-center mb-3"
                >
                  <div class="col-lg-7 my-2">
                    <div class="tag-donasi">
                      <router-link
                        :to="{
                          name: 'Category',
                          params: { slug: category.slug },
                        }"
                        v-for="category in donation.categories"
                        :key="category.id"
                        class="rounded-pill text-decoration-none mx-1"
                        >{{ category.name }}</router-link
                      >
                    </div>
                  </div>
                </div>
                <b-progress
                  :value="getDanaTerkumpul(donation.donation_details)"
                  :max="donation.max_dana"
                  class="mb-3"
                ></b-progress>
                <div class="d-flex justify-content-between mt-2 mb-4">
                  <span>Target : Rp {{ formatPrice(donation.max_dana) }}</span>
                  <span
                    class="text-right"
                    v-if="
                      donation.max_dana >=
                      getDanaTerkumpul(donation.donation_details)
                    "
                  >
                    Remaining : Rp
                    {{
                      formatPrice(
                        donation.max_dana -
                          getDanaTerkumpul(donation.donation_details)
                      )
                    }}</span
                  >
                  <span class="text-right" v-else> Remaining : Terpenuhi </span>
                </div>
                <p>{{ strippedContent(donation.content, 150) }}..</p>
              </div>
              <div>
                <hr />
                <router-link
                  :to="{
                    name: 'DonationDetail',
                    params: { slug: donation.slug },
                  }"
                  class="btn-main btn-block text-center text-white py-2 rounded-pill text-decoration-none"
                  style="border-radius: 25px"
                >
                  DONASI SEKARANG
                </router-link>
              </div>
            </div>
          </div>
        </div>
        <template #prevArrow="arrowOption">
          <div class="custom-arrow prevArrow d-none d-md-block">
            {{ arrowOption.currentSlide }}/{{ arrowOption.slideCount }}
          </div>
        </template>
        <template #nextArrow="arrowOption">
          <div class="custom-arrow nextArrow d-none d-md-block">
            {{ arrowOption.currentSlide }}/{{ arrowOption.slideCount }}
          </div>
        </template>
      </VueSlickCarousel>
      <div v-else class="row justify-content-center">
        <div class="col-12 my-3 card card-skeleton px-4 py-3">
          <b-skeleton-img height="300px" no-aspect="true"></b-skeleton-img>
          <b-skeleton animation="wave" width="85%" class="mt-3"></b-skeleton>
          <b-skeleton animation="wave" width="55%"></b-skeleton>
          <b-skeleton animation="wave" width="70%"></b-skeleton>
          <div>
            <hr />
            <b-skeleton type="button" class="btn-block"></b-skeleton>
          </div>
        </div>
      </div>
    </div>

    <div class="donations mt-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 hero-title">
            <span class="rounded-pill"></span>
            <h3>All Donation</h3>
          </div>
        </div>
        <div class="row" v-if="donations.data.length > 0">
          <div
            class="col-md-6 my-3"
            v-for="donation in donations.data"
            :key="donation.id"
          >
            <div class="card donasi-item border-0 p-3">
              <router-link
                :to="{
                  name: 'DonationDetail',
                  params: { slug: donation.slug },
                }"
              >
                <img
                  v-lazy="
                    `https://dashboard.infoin.auroraweb.id/storage/${donation.thumbnail}`
                  "
                  :alt="donation.title"
                  class="card-img-top img-fluid"
                />
              </router-link>
              <div
                class="card-body d-flex flex-column justify-content-between p-0 mt-3"
              >
                <div>
                  <div
                    class="row justify-content-between align-items-center mb-3"
                  >
                    <div
                      class="col-lg-7 my-2"
                      v-if="donation.categories.length > 0"
                    >
                      <div class="tag-donasi">
                        <router-link
                          :to="{
                            name: 'Category',
                            params: { slug: category.slug },
                          }"
                          class="rounded-pill text-decoration-none mx-1"
                          v-for="category in donation.categories"
                          :key="category.id"
                          >{{ category.name }}</router-link
                        >
                      </div>
                    </div>
                    <div
                      class="col-lg d-flex justify-content-lg-end"
                      v-bind:class="[
                        donation.categories.length == 0 ? 'my-lg-2' : '',
                      ]"
                    >
                      <div
                        class="time-donasi d-flex align-items-center ml-2 mt-2 ml-lg-0 mt-lg-0"
                        v-lazy-container="{ selector: 'img' }"
                      >
                        <img
                          data-src="/assets/icons/time.svg"
                          alt="time"
                          class="mr-2"
                        />
                        <countdown
                          :time="donation.timeLeft"
                          v-if="donation.timeLeft > 0"
                        >
                          <template slot-scope="props"
                            >{{ props.days }} Days Left
                          </template>
                        </countdown>
                        <span v-else>Hari Ini</span>
                      </div>
                    </div>
                  </div>
                  <router-link
                    :to="{
                      name: 'DonationDetail',
                      params: { slug: donation.slug },
                    }"
                    class="text-decoration-none"
                  >
                    <h5 v-if="donation.title.length > 50">
                      {{ strippedContent(donation.title, 50) }}..
                    </h5>
                    <h5 v-else>
                      {{ strippedContent(donation.title, 50) }}
                    </h5>
                  </router-link>
                  <b-progress
                    :value="getDanaTerkumpul(donation.donation_details)"
                    :max="donation.max_dana"
                    class="mb-3"
                  ></b-progress>
                  <div class="d-flex justify-content-between mt-2 mb-4">
                    <span
                      >Target : Rp {{ formatPrice(donation.max_dana) }}</span
                    >
                    <span
                      class="text-right"
                      v-if="
                        donation.max_dana >
                        getDanaTerkumpul(donation.donation_details)
                      "
                    >
                      Remaining : Rp
                      {{
                        formatPrice(
                          donation.max_dana -
                            getDanaTerkumpul(donation.donation_details)
                        )
                      }}</span
                    >
                    <span class="text-right" v-else>
                      Remaining : Terpenuhi
                    </span>
                  </div>
                  <p>{{ strippedContent(donation.content, 150) }}..</p>
                </div>
                <div>
                  <hr />
                  <router-link
                    :to="{
                      name: 'DonationDetail',
                      params: { slug: donation.slug },
                    }"
                    class="btn-main btn-block text-center text-white py-2 px-3 rounded-pill text-decoration-none"
                    style="border-radius: 25px"
                  >
                    DONASI SEKARANG
                  </router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-between" v-else>
          <div class="col-md-6 my-3">
            <div class="card border-0 p-3">
              <b-skeleton-img></b-skeleton-img>
              <div class="card-body p-0 mt-3">
                <div class="donasi-item">
                  <div class="main-donasi">
                    <b-skeleton animation="wave" width="85%"></b-skeleton>
                    <b-skeleton animation="wave" width="55%"></b-skeleton>
                    <b-skeleton animation="wave" width="70%"></b-skeleton>
                  </div>
                  <div>
                    <hr />
                    <b-skeleton type="button" class="btn-block"></b-skeleton>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div
          class="row justify-content-center"
          v-if="donations.data.length > 0"
        >
          <pagination
            :data="donations"
            :align="'center'"
            @pagination-change-page="getDonations"
          >
          </pagination>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script>
// @ is an alias to /data-src
import Navbar from "@/components/Navbar.vue";
import Footer from "@/components/Footer.vue";

import VueSlickCarousel from "vue-slick-carousel";
import "vue-slick-carousel/dist/vue-slick-carousel.css";
import "vue-slick-carousel/dist/vue-slick-carousel-theme.css";

import axios from "axios";

export default {
  name: "Donation",
  head: {
    title: function () {
      return { inner: "Donation", separator: "-", complement: "Info.In" };
    },
  },
  components: {
    Navbar,
    Footer,
    VueSlickCarousel,
  },
  data() {
    return {
      user: {},
      donations: { data: [] },
      dangerDonations: [],
      settings: {
        arrows: true,
        infinite: true,
        speed: 1000,
        autoplaySpeed: 4000,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
      },
    };
  },
  methods: {
    getDataUser(user) {
      this.user = user;
    },
    setDonations(data) {
      var now = new Date();

      this.donations = data;
      this.donations.data.map((data) => {
        data.donation_end = new Date(data.donation_end);
        data.timeLeft = data.donation_end - now;
        data.categories = data.categories.filter(
          (category, index) => index <= 1
        );
        return data;
      });
    },
    setDangerDonations(data) {
      var now = new Date();

      this.dangerDonations = data;
      this.dangerDonations.map((data) => {
        data.donation_end = new Date(data.donation_end);
        data.timeLeft = data.donation_end - now;
        data.categories = data.categories.filter(
          (category, index) => index <= 1
        );
        return data;
      });
    },
    strippedContent(content, length) {
      let regex = /(<([^>]+)>)/gi;
      return content.replace(regex, "").substring(0, length);
    },
    formatPrice(value) {
      let val = (value / 1).toFixed(2).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },
    getDanaTerkumpul(data) {
      var hasil = data.reduce(
        (acc, current) => acc + parseInt(current.donasi),
        0
      );
      return hasil;
    },
    getDonations(page = 1) {
      axios
        .get(`https://dashboard.infoin.auroraweb.id/api/donation?page=${page}`)
        .then((response) => this.setDonations(response.data.data))
        .catch((error) => console.error(error));
    },
  },
  mounted() {
    axios
      .get("https://dashboard.infoin.auroraweb.id/api/donation/danger")
      .then((response) => {
        this.setDangerDonations(response.data.data);
        this.getDonations();
      })
      .catch((error) => console.error(error));
  },
};
</script>
