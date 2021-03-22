<template>
  <div class="page-article">
    <Navbar />
    <section
      class="old-post mb-5"
      id="old-post"
      v-if="articles.data.length > 0"
    >
      <div class="container post-wrap pt-3">
        <div class="row justify-content-center">
          <div class="col-md-12 hero-title">
            <span class="rounded-pill"></span>
            <h3>Article {{ articles.data[0].categori.name }}</h3>
          </div>
        </div>
        <div class="row mt-4" v-if="articles.data.length > 0">
          <div
            class="col-md-6 col-lg-6 col-xl-4 my-3"
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
                  :alt="article.title"
                  class="card-img-top"
                  height="250px"
                />
              </router-link>
              <div class="card-body d-flex flex-column justify-content-between">
                <router-link
                  :to="{
                    name: 'ArticleDetail',
                    params: { slug: article.slug },
                  }"
                  class="text-decoration-none"
                >
                  <h5
                    class="card-title"
                    style="font-family: 'Poppins', sans-serif; font-weight: 500"
                    v-if="article.title.length > 50"
                  >
                    {{ strippedContent(article.title, 50) }}..
                  </h5>
                  <h5
                    class="card-title"
                    style="font-family: 'Poppins', sans-serif; font-weight: 500"
                    v-else
                  >
                    {{ strippedContent(article.title, 50) }}
                  </h5>
                </router-link>
                <div class="author d-flex mt-4 align-items-center">
                  <router-link
                    :to="{
                      name: 'Profile',
                      params: { slug: article.user.slug },
                    }"
                    class="author-img"
                  >
                    <img
                      v-lazy="article.user.avatar"
                      v-if="article.user.google_id"
                      alt="author"
                      class="rounded-circle"
                      width="50"
                      height="50"
                    />
                    <img
                      v-lazy="
                        `https://dashboard.infoin.auroraweb.id/storage/${article.user.avatar}`
                      "
                      v-else
                      alt="author"
                      class="rounded-circle"
                      width="50"
                      height="50"
                    />
                  </router-link>
                  <div class="author-name ml-3">
                    <p class="m-0">
                      <router-link
                        :to="{
                          name: 'Profile',
                          params: { slug: article.user.slug },
                        }"
                        >{{ article.user.name }}</router-link
                      >
                      in
                      <router-link
                        :to="{
                          name: 'Category',
                          params: { slug: article.categori.slug },
                        }"
                        >{{ article.categori.name }}</router-link
                      >
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
        <div class="row" v-else>
          <div class="col-md-6 col-lg-6 col-xl-4 my-3" v-for="n in 3" :key="n">
            <b-col>
              <b-skeleton-img></b-skeleton-img>
            </b-col>
            <b-col>
              <b-skeleton
                animation="wave"
                width="85%"
                class="mt-3"
              ></b-skeleton>
              <b-skeleton animation="wave" width="55%"></b-skeleton>
              <b-skeleton animation="wave" width="70%"></b-skeleton>
            </b-col>
          </div>
        </div>
        <div class="row justify-content-center" v-if="articles.data.length > 0">
          <pagination
            :data="articles"
            :align="'center'"
            @pagination-change-page="getArticles"
          >
          </pagination>
        </div>
      </div>
    </section>

    <div class="donations mt-3" v-if="donations.data.length > 0">
      <div class="container">
        <div class="row">
          <div class="col-md-12 hero-title">
            <span class="rounded-pill"></span>
            <h3>Donation {{ donations.data[0].categories[0].name }}</h3>
          </div>
        </div>
        <div class="row" v-if="donations.data.length > 0">
          <div
            class="col-md-6 my-3"
            v-for="donation in donations.data"
            :key="donation.id"
          >
            <div class="card border-0 p-3">
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
              <div class="card-body p-0 mt-3">
                <div class="donasi-item">
                  <div class="main-donasi">
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
                            class="rounded-pill text-decoration-none mx-1"
                            v-for="category in donation.categories"
                            :key="category.id"
                            >{{ category.name }}</router-link
                          >
                        </div>
                      </div>
                      <div class="col-lg d-flex justify-content-lg-end">
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
                      <h5>
                        {{ donation.title }}
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
                    <hr />
                    <router-link
                      :to="{
                        name: 'DonationDetail',
                        params: { slug: donation.slug },
                      }"
                      class="btn btn-main btn-block"
                      style="border-radius: 25px"
                    >
                      DONASI SEKARANG
                    </router-link>
                  </div>
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
// @ is an alias to /src
import Navbar from "@/components/Navbar.vue";
import Footer from "@/components/Footer.vue";

import moment from "moment";
import axios from "axios";

export default {
  name: "Category",
  head: {
    title: function () {
      return { inner: "Category", separator: "-", complement: "Info.In" };
    },
  },
  components: {
    Navbar,
    Footer,
  },
  data() {
    return {
      articles: { data: [] },
      donations: { data: [] },
    };
  },
  methods: {
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
    setDate(date, format) {
      return moment(date).format(format);
    },
    strippedContent(content) {
      let regex = /(<([^>]+)>)/gi;
      return content.replace(regex, "").substring(0, 200);
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
    getArticles(page = 1) {
      axios
        .get(
          `https://dashboard.infoin.auroraweb.id/api/article/category/${this.$route.params.slug}?page=${page}`
        )
        .then((response) => {
          this.setArticles(response.data.data);
        })
        .catch((error) => console.error(error));
    },
    getDonations(page = 1) {
      axios
        .get(
          `https://dashboard.infoin.auroraweb.id/api/donation/category/${this.$route.params.slug}?page=${page}`
        )
        .then((response) => {
          this.setDonations(response.data.data);
        })
        .catch((error) => console.error(error));
    },
  },
  mounted() {
    this.getArticles();
    this.getDonations();
  },
};
</script>
