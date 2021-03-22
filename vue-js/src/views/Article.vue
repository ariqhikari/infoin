<template>
  <div class="page-article">
    <Navbar />
    <!-- Jumbotron -->
    <div class="jumbotron jumbotron-fluid bg-transparent mt-4">
      <div class="container text-center article-corona">
        <div class="row justify-content-center">
          <div class="col-md-7 col-lg-6">
            <h1 v-lazy-container="{ selector: 'img' }" style="font-weight: 600">
              Kumpulan <span>Tulisan</span> <br />
              <img
                data-src="/assets/icons/virus3.svg"
                class="d-none d-lg-inline"
                alt="virus"
              />
              Masyarakat
            </h1>
            <p class="lead mt-4">
              keluarkan info yang kalian ketahui lewat <br />
              tulisan, lalu bagi info-info itu ke masyarakat lain.
            </p>
            <form
              class="mt-5 d-flex justify-content-center"
              onSubmit="return false;"
            >
              <div
                class="form-group d-flex input-search justify-content-center shadow-sm"
                :class="{ active: searchActive }"
              >
                <button
                  class="btn"
                  type="button"
                  style="cursor: default"
                  v-lazy-container="{ selector: 'img' }"
                >
                  <img data-src="/assets/icons/search.svg" alt="search" />
                </button>
                <input
                  type="text"
                  class="form-control border-0 w-100 ml-2 bg-transparent"
                  id="search"
                  placeholder="cari..."
                  v-model="search"
                  @input="getSearchArticles"
                />
              </div>
            </form>
            <div
              class="card card-search mx-auto border-0 shadow-sm"
              style="margin-top: -20px"
              v-if="searchArticles.length > 0"
            >
              <div class="card-body">
                <router-link
                  :to="{
                    name: 'ArticleDetail',
                    params: { slug: article.slug },
                  }"
                  v-for="article in searchArticles"
                  :key="article.id"
                  class="text-decoration-none"
                >
                  <div class="row">
                    <div class="col d-flex align-items-center">
                      <div>
                        <img
                          v-lazy="
                            `https://dashboard.infoin.auroraweb.id/storage/${article.thumbnail}`
                          "
                          :alt="article.title"
                          height="50"
                        />
                      </div>
                      <div class="text-left ml-3">
                        <h5 style="font-weight: 600; color: black" class="m-0">
                          {{ strippedContent(article.title, 20) }}..
                        </h5>
                        <span>
                          {{ setDate(article.created_at, "LL") }} •
                          {{ article.min_read }}
                          min read
                        </span>
                      </div>
                    </div>
                  </div>
                  <hr
                    v-if="
                      article.id != searchArticles[searchArticles.length - 1].id
                    "
                  />
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Posts -->
    <section class="recent-posts">
      <div class="container" data-aos="fade-up" data-aos-duration="1000">
        <div class="row justify-content-center">
          <div class="col-md-12 col-lg-8 hero-title">
            <span class="rounded-pill"></span>
            <h3>Latest Article</h3>
          </div>
        </div>
        <VueSlickCarousel
          v-bind="settings"
          v-if="latestArticles.length > 0"
          class="row justify-content-center mt-4 vue-carousel"
        >
          <div
            class="col-md-12"
            v-for="article in latestArticles"
            :key="article.id"
          >
            <div class="card mb-3 shadow p-3">
              <div class="row no-gutters">
                <div class="col-md-6 thumbnail-post">
                  <router-link
                    :to="{
                      name: 'ArticleDetail',
                      params: { slug: article.slug },
                    }"
                  >
                    <img
                      v-lazy="
                        `https://dashboard.infoin.auroraweb.id/storage/${article.thumbnail}`
                      "
                      class="card-img"
                      :alt="article.title"
                    />
                  </router-link>
                </div>
                <div class="col-md-6">
                  <div
                    class="card-body d-flex flex-column justify-content-between"
                  >
                    <div>
                      <router-link
                        :to="{
                          name: 'Category',
                          params: { slug: article.categori.slug },
                        }"
                        class="badge-pill badge-main text-white text-decoration-none"
                        >{{ article.categori.name }}</router-link
                      >
                      <router-link
                        :to="{
                          name: 'ArticleDetail',
                          params: { slug: article.slug },
                        }"
                        class="text-decoration-none card-title"
                      >
                        <h2
                          class="card-title mt-3"
                          v-if="article.title.length > 40"
                        >
                          {{ strippedContent(article.title, 40) }}..
                        </h2>
                        <h2 class="card-title mt-3" v-else>
                          {{ strippedContent(article.title, 40) }}
                        </h2>
                      </router-link>
                      <p class="card-text">
                        {{ strippedContent(article.content, 100) }}..
                      </p>
                    </div>
                    <div class="media d-flex align-items-center mt-3">
                      <router-link
                        :to="{
                          name: 'Profile',
                          params: { slug: article.user.slug },
                        }"
                        class="media-header mr-3"
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
                      <div class="media-body">
                        <router-link
                          :to="{
                            name: 'Profile',
                            params: { slug: article.user.slug },
                          }"
                        >
                          <h5 class="m-0">{{ article.user.name }}</h5>
                        </router-link>
                        <span>
                          {{ setDate(article.created_at, "LL") }} •
                          {{ article.min_read }}
                          min read
                        </span>
                      </div>
                    </div>
                  </div>
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
        <div v-else class="row justify-content-center mt-4 vue-carousel">
          <div class="col-md-12">
            <div class="card mb-3 shadow p-3">
              <div class="row no-gutters">
                <div class="col-md-6 thumbnail-post">
                  <b-skeleton-img></b-skeleton-img>
                </div>
                <div class="col-md-6">
                  <div
                    class="card-body d-flex flex-column justify-content-between"
                  >
                    <div>
                      <b-skeleton animation="wave" width="85%"></b-skeleton>
                      <b-skeleton animation="wave" width="55%"></b-skeleton>
                      <b-skeleton animation="wave" width="70%"></b-skeleton>
                    </div>
                    <div class="media d-flex align-items-center mt-3">
                      <b-skeleton type="avatar"></b-skeleton> <br />
                      <div class="media-body ml-2">
                        <b-skeleton animation="wave" width="30%"></b-skeleton>
                        <b-skeleton animation="wave" width="50%"></b-skeleton>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Old Posts -->
    <section class="old-post mb-5" id="old-post" style="margin-top: 100px">
      <div class="container post-wrap pt-3">
        <div class="row justify-content-center">
          <div class="col-md-12 col-lg-8 hero-title">
            <span class="rounded-pill"></span>
            <h3>All Article</h3>
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
        <div class="row mt-4" v-else>
          <div class="col-md-6 col-lg-6 col-xl-4 my-3" v-for="n in 3" :key="n">
            <div class="card">
              <b-skeleton-img no-aspect="true" height="250px"></b-skeleton-img>
              <div class="card-body d-flex flex-column justify-content-between">
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
    <Footer />
  </div>
</template>

<script>
// @ is an alias to /src
import Navbar from "@/components/Navbar.vue";
import Footer from "@/components/Footer.vue";

import VueSlickCarousel from "vue-slick-carousel";
import "vue-slick-carousel/dist/vue-slick-carousel.css";
// optional style for arrows & dots
import "vue-slick-carousel/dist/vue-slick-carousel-theme.css";

import axios from "axios";
import moment from "moment";

export default {
  name: "Article",
  head: {
    title: {
      inner: "Article",
      separator: "-",
      complement: "Info.In",
    },
  },
  components: {
    Navbar,
    Footer,
    VueSlickCarousel,
  },
  data() {
    return {
      searchActive: false,
      search: "",
      searchArticles: [],
      latestArticles: [],
      articles: { data: [] },
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
    getSearchArticles() {
      if (this.search.length > 0) {
        this.searchActive = true;
        axios
          .get(
            `https://dashboard.infoin.auroraweb.id/api/article/search?q=${this.search}`
          )
          .then((response) => this.setSearchArticles(response.data.data))
          .catch((error) => {
            console.error(error);
          });
      } else {
        this.searchActive = false;
        this.searchArticles = [];
      }
    },
    setSearchArticles(data) {
      this.searchArticles = data;
    },
    setLatestArticles(data) {
      this.latestArticles = data;
    },
    setArticles(data) {
      this.articles = data;
    },
    strippedContent(content, length) {
      let regex = /(<([^>]+)>)/gi;
      return content.replace(regex, "").substring(0, length);
    },
    setDate(date, format) {
      return moment(date).format(format);
    },
    setRelativeDate(date) {
      return moment(date).startOf("hour").fromNow();
    },
    getArticles(page = 1) {
      axios
        .get(`https://dashboard.infoin.auroraweb.id/api/article?page=${page}`)
        .then((response) => {
          this.setArticles(response.data.data);
        })
        .catch((error) => console.error(error));
    },
  },
  mounted() {
    axios
      .get("https://dashboard.infoin.auroraweb.id/api/article/latest")
      .then((response) => {
        this.setLatestArticles(response.data.data);
        this.getArticles();
      })
      .catch((error) => console.error(error));
  },
};
</script>
