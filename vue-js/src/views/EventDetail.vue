<template>
  <div class="page-event-detail">
    <Navbar />
    <section class="share-event">
      <div class="container">
        <div class="row justify-content-center text-center pt-5">
          <div class="col-md-12">
            <h1 class="text-white" style="font-weight: 600">
              Bagikan ke temanmu
            </h1>
          </div>
          <div class="col-md-5 mt-3">
            <div class="row justify-content-center">
              <div class="col-2 col-md-2 mx-3">
                <a
                  :href="`https://twitter.com/intent/tweet?text=${
                    event.share
                  } ${currentURL()}`"
                  target="_blank"
                  class="text-white"
                >
                  <i class="fa fa-twitter"></i>
                </a>
              </div>
              <div class="col-2 col-md-2 mx-3">
                <a
                  :href="`https://www.facebook.com/sharer/sharer.php?u=${currentURL()} ${
                    event.share
                  }&src=sdkpreparse`"
                  target="_blank"
                  class="text-white"
                >
                  <i class="fa fa-facebook-f"></i>
                </a>
              </div>
              <div class="col-2 col-md-2 mx-3">
                <a
                  :href="`https://api.whatsapp.com/send?text=${
                    event.share
                  } ${currentURL()}`"
                  target="_blank"
                  class="text-white"
                >
                  <i class="fa fa-whatsapp"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="event-wrap" v-if="Object.keys(event).length > 0">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12 col-lg-9 bg-white p-4 event-container">
            <img
              v-lazy="
                `https://dashboard.infoin.auroraweb.id/storage/${event.thumbnail}`
              "
              alt="event"
              class="img-fluid"
            />
            <div class="event-content my-3">
              <h1
                style="font-family: poppins; font-weight: 500; color: #393939"
              >
                {{ event.name }}
              </h1>
              <p>
                {{ event.desc }}
              </p>
            </div>
            <div class="event-detail my-3">
              <div class="row">
                <div class="col-12 mb-2">
                  <span class="rounded-pill bg-danger"></span>
                  <h3
                    style="
                      font-family: poppins;
                      font-weight: 500;
                      color: #393939;
                    "
                  >
                    Details Event
                  </h3>
                </div>
                <div class="col-12">
                  <ul>
                    <li>
                      <h5 style="font-family: poppins; font-weight: 500">
                        Tanggal dan Waktu
                      </h5>
                      <p>
                        {{ setDate(event.date_start, "LLL") }} -
                        {{ setDate(event.date_end, "LLL") }}
                      </p>
                    </li>
                    <li>
                      <h5 style="font-family: poppins; font-weight: 500">
                        Provinsi
                      </h5>
                      <p>{{ event.province.name }}</p>
                    </li>
                    <li>
                      <h5 style="font-family: poppins; font-weight: 500">
                        Kota
                      </h5>
                      <p>{{ event.regency.name }}</p>
                    </li>
                    <li>
                      <h5 style="font-family: poppins; font-weight: 500">
                        Event Organizer
                      </h5>
                      <router-link
                        :to="{
                          name: 'Profile',
                          params: { slug: event.user.slug },
                        }"
                        style="color: #565a60"
                      >
                        <p>
                          {{ event.user.name }}
                        </p>
                      </router-link>
                    </li>
                    <li class="event-title">
                      <h5 style="font-family: poppins; font-weight: 500">
                        Status
                      </h5>
                      <p
                        class="badge badge-pill py-2 px-4 belum-dimulai status"
                        v-if="event.status == 'Belum Dimulai'"
                      >
                        {{ event.status }}
                      </p>
                      <p
                        class="badge badge-pill py-2 px-4 dimulai status"
                        v-else-if="event.status == 'Dimulai'"
                      >
                        {{ event.status }}
                      </p>
                      <p
                        class="badge badge-pill py-2 px-4 selesai status"
                        v-else
                      >
                        {{ event.status }}
                      </p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="event-map my-3">
              <div class="row">
                <div class="col-12 mb-2">
                  <h3
                    style="
                      font-family: poppins;
                      font-weight: 500;
                      color: #393939;
                    "
                  >
                    Peta
                  </h3>
                </div>
                <div class="col-12">
                  <img
                    v-lazy="
                      `https://dashboard.infoin.auroraweb.id/storage/${event.maps}`
                    "
                    alt="map"
                    class="w-100"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="event-wrap" v-else>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12 col-lg-9 bg-white p-4 event-container">
            <b-skeleton-img></b-skeleton-img>
            <div class="event-content my-3">
              <b-skeleton animation="wave" width="85%"></b-skeleton>
              <b-skeleton animation="wave" width="55%"></b-skeleton>

              <b-skeleton
                animation="wave"
                width="100%"
                class="mt-4"
              ></b-skeleton>
              <b-skeleton animation="wave" width="70%"></b-skeleton>
              <b-skeleton animation="wave" width="55%"></b-skeleton>
            </div>
            <!-- <div class="event-detail my-3">
              <div class="row">
                <div class="col-12 mb-2">
                  <span class="rounded-pill bg-danger"></span>
                  <h1
                    style="
                      font-family: poppins;
                      font-weight: 500;
                      color: #393939;
                    "
                  >
                    Details Event
                  </h1>
                </div>
                <div class="col-12">
                  <ul>
                    <li>
                      <h5 style="font-family: poppins; font-weight: 500">
                        Tanggal dan Waktu
                      </h5>
                      <p>
                        {{ setDate(event.date_start, "LLL") }} -
                        {{ setDate(event.date_end, "LLL") }}
                      </p>
                    </li>
                    <li>
                      <h5 style="font-family: poppins; font-weight: 500">
                        Provinsi
                      </h5>
                      <p>{{ event.province.name }}</p>
                    </li>
                    <li>
                      <h5 style="font-family: poppins; font-weight: 500">
                        Kota
                      </h5>
                      <p>{{ event.regency.name }}</p>
                    </li>
                    <li>
                      <h5 style="font-family: poppins; font-weight: 500">
                        Event Organizer
                      </h5>
                      <p>{{ event.user.name }}</p>
                    </li>
                    <li class="event-title">
                      <h5 style="font-family: poppins; font-weight: 500">
                        Status
                      </h5>
                      <p
                        class="badge badge-pill py-2 px-4 belum-dimulai status"
                        v-if="event.status == 'Belum Dimulai'"
                      >
                        {{ event.status }}
                      </p>
                      <p
                        class="badge badge-pill py-2 px-4 dimulai status"
                        v-else-if="event.status == 'Dimulai'"
                      >
                        {{ event.status }}
                      </p>
                      <p
                        class="badge badge-pill py-2 px-4 selesai status"
                        v-else
                      >
                        {{ event.status }}
                      </p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="event-map my-3">
              <div class="row">
                <div class="col-12 mb-2">
                  <h1
                    style="
                      font-family: poppins;
                      font-weight: 500;
                      color: #393939;
                    "
                  >
                    Peta
                  </h1>
                </div>
                <div class="col-12">
                  <img
                    v-lazy="`https://dashboard.infoin.auroraweb.id/storage/${event.maps}`"
                    alt="map"
                    class="rounded w-100"
                  />
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </section>
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
  name: "EventDetail",
  head: {
    title: function () {
      return { inner: "Event Detail", separator: "-", complement: "Info.In" };
    },
  },
  components: {
    Navbar,
    Footer,
  },
  data() {
    return {
      event: {},
    };
  },
  methods: {
    currentURL() {
      return window.location.origin + window.location.pathname;
    },
    setEvent(data) {
      this.event = data;
      this.event.share = this.event.name.replace("&", "");
    },
    setDate(date, format) {
      return moment(date).format(format);
    },
    strippedContent(content, length) {
      let regex = /(<([^>]+)>)/gi;
      return content.replace(regex, "").substring(0, length);
    },

    getDanaTerkumpul(data) {
      var hasil = data.reduce((acc, current) => acc + current.donasi, 0);
      return hasil;
    },
  },
  mounted() {
    window.scrollTo(0, 0);
    axios
      .get(
        `https://dashboard.infoin.auroraweb.id/api/event/${this.$route.params.slug}`
      )
      .then((response) => this.setEvent(response.data.data))
      .catch((error) => console.error(error));
  },
};
</script>
