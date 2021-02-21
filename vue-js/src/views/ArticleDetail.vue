<template>
  <div class="page-article-detail">
    <Navbar v-on:setDataUser="getDataUser" />
    <!-- Detail Post -->
    <section class="detail-post my-5" v-if="Object.keys(article).length > 0">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 col-lg-8 heading-post">
            <h2 style="font-weight: 600">{{ article.title }}</h2>
            <div style="margin-top: 15px">
              <router-link
                :to="{
                  name: 'Profile',
                  params: { slug: article.user.slug },
                }"
              >
                <img
                  v-lazy="article.user.avatar"
                  v-if="article.user.google_id"
                  alt="author"
                  class="rounded-circle float-left"
                  width="50"
                  height="50"
                />
                <img
                  v-lazy="
                    `https://dashboard.infoin.auroraweb.id/storage/${article.user.avatar}`
                  "
                  v-else
                  alt="author"
                  class="rounded-circle float-left"
                  width="50"
                  height="50"
                />
              </router-link>

              <div class="float-left ml-3">
                <p>
                  <router-link
                    :to="{
                      name: 'Profile',
                      params: { slug: article.user.slug },
                    }"
                    style="
                      font-size: 16px;
                      color: rgb(56, 56, 56);
                      margin-top: 3px;
                      text-transform: capitalize;
                    "
                  >
                    {{ article.user.name }}
                  </router-link>
                </p>
                <p style="margin-top: -19px; font-size: 14px">
                  {{ setDate(article.created_at, "LL") }} •
                  {{ article.min_read }}
                  min read
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center mt-3">
          <div class="col-md-2 col-lg-1 text-center">
            <div class="share-comment sticky-top py-md-5" style="z-index: 0">
              <div class="share-post">
                <p>Share</p>
                <a
                  :href="`https://twitter.com/intent/tweet?text=${
                    article.share
                  } ${currentURL()}`"
                  target="_blank"
                  class="d-md-block mx-4 mx-md-0 my-4 text-decoration-none"
                >
                  <i class="fa fa-twitter"></i>
                </a>
                <a
                  :href="`https://www.facebook.com/sharer/sharer.php?u=${currentURL()} ${
                    article.share
                  }&src=sdkpreparse`"
                  target="_blank"
                  class="d-md-block mx-4 mx-md-0 my-4 text-decoration-none"
                >
                  <i class="fa fa-facebook-f"></i>
                </a>
                <a
                  :href="`https://api.whatsapp.com/send?text=${
                    article.share
                  } ${currentURL()}`"
                  target="_blank"
                  class="d-md-block mx-4 mx-md-0 my-4 text-decoration-none"
                >
                  <i class="fa fa-whatsapp"></i>
                </a>
              </div>
              <hr />
              <div class="reply-post d-none d-md-block">
                <p>Reply</p>
                <a href="#komentar" class="page-scroll">0</a>
                <a
                  href="#komentar"
                  class="d-block my-3 page-scroll text-decoration-none"
                >
                  <i class="fa fa-comment"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="detail-post-thumbnail">
              <img
                v-lazy="
                  `https://dashboard.infoin.auroraweb.id/storage/${article.thumbnail}`
                "
                :alt="article.title"
                class="img-fluid"
                style="width: 100%"
              />
              <div class="breadcrumb-detail-post mt-3">
                <p>
                  <router-link
                    :to="{ name: 'Article' }"
                    class="font-weight-light"
                    >Article</router-link
                  >
                  &raquo;
                  {{ article.title }}
                </p>
              </div>
            </div>
            <div
              class="detail-post-content mt-4"
              v-html="article.content"
            ></div>
          </div>
        </div>
      </div>
    </section>

    <section class="detail-post my-5" v-else>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8 heading-post">
            <div>
              <b-skeleton animation="wave" width="85%"></b-skeleton>
              <b-skeleton animation="wave" width="55%"></b-skeleton>
            </div>
            <div style="margin-top: 15px" class="d-flex">
              <b-skeleton type="avatar" width="50" height="50"></b-skeleton>

              <div class="ml-3 w-100">
                <b-skeleton animation="wave" width="20%"></b-skeleton>
                <b-skeleton animation="wave" width="40%"></b-skeleton>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center mt-3">
          <div class="col-md-8">
            <div class="detail-post-thumbnail">
              <b-skeleton-img></b-skeleton-img>
            </div>
            <div class="detail-post-content mt-4">
              <b-skeleton animation="wave" width="85%"></b-skeleton>
              <b-skeleton animation="wave" width="55%"></b-skeleton>
              <b-skeleton animation="wave" width="70%"></b-skeleton>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Komentar & Related Post -->
    <section
      class="related-post"
      id="related-post"
      v-if="latestArticles.length > 0"
    >
      <div class="container post-wrap pt-3">
        <div class="row mt-4">
          <div class="col-md-6 col-lg-4 mb-3">
            <h2 style="font-weight: 600">Related Article</h2>
            <div class="title-line d-flex">
              <span class="title-line-primary"></span>
              <span class="title-line-secondary"></span>
            </div>
          </div>
        </div>
        <div class="row" v-if="latestArticles.length > 0">
          <div
            class="col-md-6 col-lg-6 col-xl-4 my-3"
            v-for="article in latestArticles"
            :key="article.id"
          >
            <div class="card">
              <a
                @click.prevent="changeApi(article.slug)"
                class="text-decoration-none"
                style="cursor: pointer"
              >
                <img
                  v-lazy="
                    `https://dashboard.infoin.auroraweb.id/storage/${article.thumbnail}`
                  "
                  class="card-img-top"
                  :alt="article.title"
                  height="250px"
                />
              </a>
              <div class="card-body d-flex flex-column justify-content-between">
                <a
                  @click.prevent="changeApi(article.slug)"
                  class="text-decoration-none"
                  style="cursor: pointer"
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
                </a>
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
      </div>
    </section>

    <section class="komentar pt-5" id="komentar">
      <div class="container pt-5">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <h2 style="font-weight: 600">Komentar</h2>
            <div class="title-line d-flex">
              <span class="title-line-primary"></span>
              <span class="title-line-secondary"></span>
            </div>
          </div>
        </div>
        <div class="row justify-content-center my-3" v-if="comments.length > 0">
          <div class="col-md-8">
            <div
              class="card komentar-item my-4"
              v-for="comment in comments"
              :key="comment.id"
              :id="comment.id"
            >
              <div class="card-body">
                <div class="author d-flex justify-content-between">
                  <div class="komentar-left d-flex align-items-center">
                    <div class="author-img">
                      <img
                        v-lazy="comment.user.avatar"
                        alt="komentar"
                        v-if="comment.user.google_id"
                        class="rounded-circle"
                        width="48px"
                        height="48px"
                      />
                      <img
                        v-lazy="
                          `https://dashboard.infoin.auroraweb.id/storage/${comment.user.avatar}`
                        "
                        alt="komentar"
                        v-else
                        class="rounded-circle"
                        width="48px"
                        height="48px"
                      />
                    </div>
                    <div class="author-name ml-3">
                      <p class="m-0">{{ comment.user.name }}</p>
                      <small class="m-0" v-if="comment.user.role.name == 'user'"
                        >User</small
                      >
                      <small
                        class="m-0"
                        v-else-if="comment.user.role.name == 'eo'"
                        >Event Organizer</small
                      >
                      <small class="m-0" v-else>Admin</small>
                    </div>
                  </div>
                  <div class="komentar-right">
                    <p>{{ setRelativeDate(comment.created_at) }}</p>
                  </div>
                </div>
                <div class="komentar-desc mt-3">
                  <p>{{ comment.comment }}</p>
                </div>
                <br />
                <div v-if="comment.childs.length > 0">
                  <div
                    class="ml-5"
                    v-for="commentChild in comment.childs"
                    :key="commentChild.id"
                  >
                    <div class="author d-flex justify-content-between">
                      <div class="komentar-left d-flex align-items-center">
                        <div class="author-img">
                          <img
                            v-lazy="commentChild.user.avatar"
                            alt="komentar"
                            v-if="commentChild.user.google_id"
                            class="rounded-circle"
                            width="48px"
                            height="48px"
                          />
                          <img
                            v-lazy="
                              `https://dashboard.infoin.auroraweb.id/storage/${commentChild.user.avatar}`
                            "
                            alt="komentar"
                            v-else
                            class="rounded-circle"
                            width="48px"
                            height="48px"
                          />
                        </div>
                        <div class="author-name ml-3">
                          <p class="m-0">{{ commentChild.user.name }}</p>
                          <small
                            class="m-0"
                            v-if="commentChild.user.role.name == 'user'"
                            >User</small
                          >
                          <small
                            class="m-0"
                            v-else-if="commentChild.user.role.name == 'eo'"
                            >Event Organizer</small
                          >
                          <small class="m-0" v-else>Admin</small>
                        </div>
                      </div>
                      <div class="komentar-right">
                        <p>{{ setRelativeDate(commentChild.created_at) }}</p>
                      </div>
                    </div>
                    <div class="komentar-desc mt-3">
                      <a :href="`#${comment.id}`" class="page-scroll"
                        >Reply to {{ comment.user.name }}</a
                      >
                    </div>
                    <div class="komentar-desc mt-3">
                      <p>{{ commentChild.comment }}</p>
                    </div>
                  </div>
                </div>
                <hr />
                <a
                  class="float-right"
                  href="#komentarForm"
                  @click="setReply(comment)"
                >
                  Reply
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="komentar-form my-5" id="komentarForm">
              <button
                class="btn btn-danger btn-sm rounded-pill mb-3 px-3"
                v-if="formComment.parent != 0"
                @click="setReply(null)"
              >
                Batal Reply?
              </button>
              <form @submit.prevent="commentPost">
                <div class="form-group">
                  <textarea
                    class="form-control"
                    :placeholder="commentPlaceholder"
                    rows="3"
                    v-model="formComment.comment"
                  ></textarea>
                  <span
                    class="invalid-feedback d-block"
                    role="alert"
                    v-if="validation.comment"
                  >
                    <strong>Masukkan Comment</strong>
                  </span>
                </div>
                <button
                  type="submit"
                  class="btn btn-main text-white float-right py-3 px-4 mb-5"
                  v-if="!commentClick"
                >
                  <span> Kirim Komentar </span>
                </button>
                <button
                  type="submit"
                  class="btn btn-main text-white float-right py-3 px-4 mb-5"
                  disabled
                  v-else
                >
                  <b-spinner
                    style="width: 1.4rem; height: 1.4rem"
                    class="mx-4"
                  ></b-spinner>
                </button>
              </form>
            </div>
          </div>
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

import axios from "axios";
import moment from "moment";

export default {
  name: "ArticleDetail",
  head: {
    title: function () {
      return { inner: "Detail Article", separator: "-", complement: "Info.In" };
    },
  },
  components: {
    Navbar,
    Footer,
  },
  data() {
    return {
      commentClick: false,
      article: {},
      latestArticles: [],
      comments: [],
      formComment: {
        comment: "",
        parent: 0,
      },
      //state validation
      validation: [],
      commentPlaceholder: "Tulis Komentar",
    };
  },
  methods: {
    currentURL() {
      return window.location.origin + window.location.pathname;
    },
    getDataUser(user) {
      this.formComment.user_id = user.id;
    },
    strippedContent(content, length) {
      let regex = /(<([^>]+)>)/gi;
      return content.replace(regex, "").substring(0, length);
    },
    setArticle(data) {
      this.article = data;
      this.formComment.article_id = data.id;
      this.article.share = this.article.title.replace("&", "");
    },
    setLatestArticles(data) {
      this.latestArticles = data;
    },
    setComments(data) {
      this.comments = data;
    },
    setDate(date, format) {
      return moment(date).format(format);
    },
    setRelativeDate(date) {
      return moment(date).startOf("hour").fromNow();
    },
    setReply(parent) {
      if (parent) {
        this.formComment.parent = parent.id;
        this.commentPlaceholder = `Reply to ${parent.user.name}`;
      } else {
        this.formComment.parent = 0;
        this.commentPlaceholder = `Tulis Komentar`;
      }
    },
    commentPost() {
      if (this.formComment.comment && this.formComment.user_id) {
        this.commentClick = true;

        axios
          .post(
            "https://dashboard.infoin.auroraweb.id/api/article",
            this.formComment
          )
          .then(() => {
            //debug user login
            this.formComment.comment = "";
            this.formComment.parent = 0;
            this.commentPlaceholder = `Tulis Komentar`;

            this.$toasted.success("Berhasil mengirim komentar!", {
              position: "top-center",
              className: "rounded",
              duration: 5000,
            });

            axios
              .get(
                `https://dashboard.infoin.auroraweb.id/api/article/${this.$route.params.slug}`
              )
              .then((response) => {
                this.setComments(response.data.data.comments);
                this.commentClick = false;
              })
              .catch((error) => console.error(error));
          })
          .catch((error) => {
            console.log(error);
            this.commentClick = false;
          });
      }

      this.validation = [];

      if (!this.formComment.comment) {
        this.validation.comment = true;
      }

      if (!this.formComment.user_id) {
        this.$router.push({ name: "Login" });
      }
    },
    changeApi(slug) {
      this.$route.params.slug = slug;
      window.scrollTo(0, 0);
      this.getApi();
    },
    getApi() {
      axios
        .get(
          `https://dashboard.infoin.auroraweb.id/api/article/${this.$route.params.slug}`
        )
        .then((response) => {
          this.setArticle(response.data.data.article);
          this.setLatestArticles(response.data.data.latestArticles);
          this.setComments(response.data.data.comments);
        })
        .catch((error) => console.error(error));
    },
  },
  mounted() {
    this.getApi();
  },
};
</script>

<style>
</style>