<template>
  <div class="page-profile">
    <Navbar />
    <div
      style="
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        width: 100%;
        height: 700px;
        background-image: url('/assets/img/eventbg.jpg');
        margin-top: -500px;
      "
    ></div>

    <div
      class="container mt-4"
      style="clear: both"
      v-if="Object.keys(user).length > 0"
    >
      <div class="row justify-content-center" style="margin-top: -100px">
        <div class="col-md-12">
          <div class="card box-profile border-0 shadow-sm">
            <div class="card-body">
              <div class="row text-center">
                <div class="col">
                  <img
                    v-lazy="user.avatar"
                    :alt="user.name"
                    v-if="user.google_id"
                    width="150px"
                    height="150px"
                    style="border-radius: 50%; margin-top: -100px"
                    class="rounded-circle"
                  />
                  <img
                    v-lazy="
                      `https://dashboard.infoin.auroraweb.id/storage/${user.avatar}`
                    "
                    :alt="user.name"
                    v-else
                    width="150px"
                    height="150px"
                    style="border-radius: 50%; margin-top: -100px"
                    class="rounded-circle"
                  />
                  <br /><br />
                  <h2 style="text-transform: capitalize; font-weight: 600">
                    {{ user.name }}
                  </h2>
                  <p>Bergabung Pada {{ setDate(user.created_at, "LL") }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center mt-5">
        <div class="col-md-12">
          <b-tabs
            active-nav-item-class="tab-active"
            active-tab-class="tab-active"
            content-class="mt-3"
            fill
            lazy
          >
            <b-tab title="Article" active v-if="articles.data.length > 0">
              <div class="row mt-4 post-wrap" v-if="articles.data.length > 0">
                <div
                  class="col-md-12 my-3"
                  v-for="article in articles.data"
                  :key="article.id"
                >
                  <div class="card">
                    <router-link
                      :to="{
                        name: 'ArticleDetail',
                        params: { slug: article.slug },
                      }"
                      class="text-decoration-none"
                    >
                      <img
                        v-lazy="
                          `https://dashboard.infoin.auroraweb.id/storage/${article.thumbnail}`
                        "
                        class="card-img-top"
                        :alt="article.title"
                        height="250px"
                      />
                    </router-link>
                    <div
                      class="card-body d-flex flex-column justify-content-between"
                    >
                      <router-link
                        :to="{
                          name: 'ArticleDetail',
                          params: { slug: article.slug },
                        }"
                        class="text-decoration-none"
                      >
                        <h5
                          class="card-title"
                          style="
                            font-family: 'Poppins', sans-serif;
                            font-weight: 500;
                          "
                          v-if="article.title.length > 100"
                        >
                          {{ strippedContent(article.title, 100) }}..
                        </h5>
                        <h5
                          class="card-title"
                          style="
                            font-family: 'Poppins', sans-serif;
                            font-weight: 500;
                          "
                          v-else
                        >
                          {{ strippedContent(article.title, 100) }}
                        </h5>
                      </router-link>
                      <p class="card-text">
                        {{ strippedContent(article.content, 100) }}..
                      </p>
                      <div class="author d-flex mt-4 align-items-center">
                        <div class="author-img">
                          <img
                            v-lazy="user.avatar"
                            alt="author"
                            v-if="user.google_id"
                            class="rounded-circle"
                            width="48px"
                            height="48px"
                          />
                          <img
                            v-lazy="
                              `https://dashboard.infoin.auroraweb.id/storage/${user.avatar}`
                            "
                            alt="author"
                            v-else
                            class="rounded-circle"
                            width="48px"
                            height="48px"
                          />
                        </div>
                        <div class="author-name ml-3">
                          <p class="m-0">
                            <a href="">{{ user.name }}</a> in
                            <a href="">{{ article.categori.name }}</a>
                          </p>
                          <p class="m-0">
                            {{ setDate(article.created_at, "LL") }} •
                            {{ article.min_read }}
                            min read
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row mt-4" v-else>
                <div class="col-md-12 my-3" v-for="n in 3" :key="n">
                  <div class="card">
                    <b-skeleton-img
                      no-aspect="true"
                      height="250px"
                    ></b-skeleton-img>
                    <div
                      class="card-body d-flex flex-column justify-content-between"
                    >
                      <div>
                        <b-skeleton animation="wave" width="85%"></b-skeleton>
                        <b-skeleton animation="wave" width="55%"></b-skeleton>
                        <b-skeleton animation="wave" width="70%"></b-skeleton>
                      </div>
                      <div class="author d-flex mt-4 align-items-center">
                        <div class="author-img">
                          <b-skeleton type="avatar"></b-skeleton>
                        </div>
                        <div class="author-name ml-3 w-100">
                          <b-skeleton animation="wave" width="30%"></b-skeleton>
                          <b-skeleton animation="wave" width="50%"></b-skeleton>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="row justify-content-center"
                v-if="articles.data.length > 0"
              >
                <pagination
                  :data="articles"
                  :align="'center'"
                  @pagination-change-page="getArticles"
                >
                </pagination>
              </div>
            </b-tab>
            <b-tab title="Donation" v-if="donations.data.length > 0">
              <div class="row donations" v-if="donations.data.length > 0">
                <div
                  class="col-md-12 my-3"
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
                        class="card-img-top img-fluid donasi-thumb"
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
                            >Target : Rp
                            {{ formatPrice(donation.max_dana) }}</span
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
                <div class="col-md-12 my-3">
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
                          <b-skeleton
                            type="button"
                            class="btn-block"
                          ></b-skeleton>
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
            </b-tab>
            <b-tab title="Event" v-if="events.data.length > 0">
              <div class="row list-events" v-if="events.data.length > 0">
                <div
                  class="col-md-12 event-item bg-white shadow p-5 my-4 mx-2 d-flex flex-column justify-content-between"
                  v-for="event in events.data"
                  :key="event.id"
                >
                  <div>
                    <div class="row">
                      <div
                        class="col-md-2 col-lg-1"
                        v-lazy-container="{ selector: 'img' }"
                      >
                        <img data-src="/assets/icons/box.svg" alt="box" />
                      </div>
                      <div class="col-md">
                        <div class="event-title row align-items-center">
                          <h2
                            class="col-md"
                            style="font-weight: 600"
                            v-if="event.name.length > 50"
                          >
                            {{ strippedContent(event.name, 50) }}..
                          </h2>
                          <h2 class="col-md" style="font-weight: 600" v-else>
                            {{ strippedContent(event.name, 50) }}
                          </h2>
                          <span
                            class="col-md-3 col-lg-2 d-none d-md-block badge badge-pill py-3 px-3 ml-4 belum-dimulai"
                            v-if="event.status == 'Belum Dimulai'"
                            >{{ event.status }}</span
                          >
                          <span
                            class="col-md-3 col-lg-2 d-none d-md-block badge badge-pill py-3 px-3 ml-4 dimulai"
                            v-else-if="event.status == 'Dimulai'"
                            >{{ event.status }}</span
                          >
                          <span
                            class="col-md-3 col-lg-2 d-none d-md-block badge badge-pill py-3 px-3 ml-4 selesai"
                            v-else
                            >{{ event.status }}</span
                          >
                        </div>
                        <div
                          class="event-time d-flex align-items-center mb-2"
                          v-lazy-container="{ selector: 'img' }"
                        >
                          <img data-src="/assets/icons/clock.svg" alt="clock" />
                          <span class="ml-2"
                            >{{ setDate(event.date_start, "LLL") }} -
                            {{ setDate(event.date_end, "LLL") }}</span
                          >
                        </div>
                        <p v-if="event.desc.length > 50">
                          {{ strippedContent(event.desc, 50) }}..
                        </p>
                        <p v-else>
                          {{ strippedContent(event.desc, 50) }}
                        </p>
                      </div>
                    </div>
                    <div
                      class="row justify-content-center justify-content-md-between align-items-center"
                    >
                      <div class="col-md row mb-3">
                        <router-link
                          :to="{ name: 'Event' }"
                          class="d-none d-md-block event-location rounded-pill py-2 px-4 text-center m-2 text-decoration-none"
                        >
                          Provinsi : <span>{{ event.province.name }}</span>
                        </router-link>
                        <router-link
                          :to="{ name: 'Event' }"
                          class="event-location rounded-pill py-2 px-4 text-center m-2 text-decoration-none"
                        >
                          Kota : <span>{{ event.regency.name }}</span>
                        </router-link>
                      </div>
                    </div>
                  </div>
                  <div>
                    <hr />
                    <div class="row">
                      <div class="col-md">
                        <router-link
                          :to="{
                            name: 'EventDetail',
                            params: { slug: event.slug },
                          }"
                          class="btn btn-main btn-block text-center text-white py-3 rounded-pill text-decoration-none"
                          style="border-radius: 25px"
                        >
                          Lihat Detail
                        </router-link>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" v-else>
                <div
                  class="col-md-12 event-item bg-white p-5 my-4 mx-2 d-flex flex-column justify-content-between"
                >
                  <div>
                    <div class="row">
                      <div class="col-md-2 col-lg-1 mb-2">
                        <b-skeleton
                          type="avatar"
                          width="50px"
                          height="50px"
                        ></b-skeleton>
                      </div>
                      <div class="col-md">
                        <b-skeleton animation="wave" width="85%"></b-skeleton>
                        <b-skeleton animation="wave" width="55%"></b-skeleton>
                        <b-skeleton animation="wave" width="70%"></b-skeleton>
                      </div>
                    </div>
                  </div>
                  <div>
                    <hr />
                    <div class="row">
                      <div class="col-md">
                        <b-skeleton
                          type="button"
                          class="btn-block"
                        ></b-skeleton>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="row justify-content-center"
                v-if="events.data.length > 0"
              >
                <pagination
                  :data="events"
                  :align="'center'"
                  @pagination-change-page="getEvents"
                >
                </pagination>
              </div>
            </b-tab>
          </b-tabs>
        </div>
      </div>
    </div>

    <div class="container mt-4" style="clear: both" v-else>
      <div class="row justify-content-center" style="margin-top: -100px">
        <div class="col-md-12">
          <div class="card box-profile border-0 shadow-sm">
            <div class="card-body">
              <div class="row text-center">
                <div class="col d-flex flex-column align-items-center">
                  <b-skeleton
                    type="avatar"
                    width="150px"
                    height="150px"
                    style="margin-top: -100px"
                  ></b-skeleton>
                  <br /><br />
                  <b-skeleton animation="wave" width="20%"></b-skeleton>
                  <b-skeleton animation="wave" width="30%"></b-skeleton>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center mt-5">
        <div class="col-md-12 d-flex justify-content-between">
          <b-skeleton animation="wave" width="20%"></b-skeleton>
          <b-skeleton animation="wave" width="20%"></b-skeleton>
          <b-skeleton animation="wave" width="20%"></b-skeleton>
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

import axios from "axios";
import moment from "moment";

export default {
  name: "Profile",
  head: {
    title: function () {
      return { inner: "Profile", separator: "-", complement: "Info.In" };
    },
  },
  components: {
    Navbar,
    Footer,
  },
  data() {
    return {
      user: {},
      articles: { data: [] },
      donations: { data: [] },
      events: { data: [] },
    };
  },
  methods: {
    setUser(data) {
      this.user = data;
    },
    setArticles(data) {
      this.articles = data;
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
    setEvents(data) {
      this.events = data;
    },
    setDate(date, format) {
      return moment(date).format(format);
    },
    setRelativeDate(date) {
      return moment(date).startOf("hour").fromNow();
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
    strippedContent(content, length) {
      let regex = /(<([^>]+)>)/gi;
      return content.replace(regex, "").substring(0, length);
    },
    getArticles(page = 1) {
      axios
        .get(
          `https://dashboard.infoin.auroraweb.id/api/profile/article/${this.$route.params.slug}?page=${page}`
        )
        .then((response) => {
          this.setArticles(response.data.data);
        })
        .catch((error) => console.error(error));
    },
    getDonations(page = 1) {
      axios
        .get(
          `https://dashboard.infoin.auroraweb.id/api/profile/donation/${this.$route.params.slug}?page=${page}`
        )
        .then((response) => {
          this.setDonations(response.data.data);
        })
        .catch((error) => console.error(error));
    },
    getEvents(page = 1) {
      axios
        .get(
          `https://dashboard.infoin.auroraweb.id/api/profile/event/${this.$route.params.slug}?page=${page}`
        )
        .then((response) => {
          this.setEvents(response.data.data);
        })
        .catch((error) => console.error(error));
    },
  },
  mounted() {
    window.scrollTo(0, 0);
    axios
      .get(
        `https://dashboard.infoin.auroraweb.id/api/profile/${this.$route.params.slug}`
      )
      .then((response) => {
        this.setUser(response.data.data);
        this.getArticles();
        this.getDonations();
        this.getEvents();
      })
      .catch((error) => console.error(error));
  },
};
</script>

<style>
</style>