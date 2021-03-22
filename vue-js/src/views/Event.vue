<template>
  <div class="page-event">
    <Navbar />
    <!-- Jumbotron -->
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div
          class="col-md-6 text-center"
          v-lazy-container="{ selector: 'img' }"
        >
          <img
            data-src="/assets/illustrations/event.png"
            alt="event"
            class="img-fluid"
          />
          <h1 class="my-4" style="font-weight: 600">
            Portal informasi <br />
            acara sosial di Indonesia.
          </h1>
          <a
            href="#events"
            class="btn-main text-center text-white py-2 px-5 rounded-pill text-decoration-none"
            style="border-radius: 25px"
          >
            Jelajahi
          </a>
        </div>
      </div>
    </div>

    <div class="container cari-event mt-5 pt-5" id="cari-event">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card p-3" :class="{ active: searchActive }">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-md-4 my-2">
                  <div class="d-flex">
                    <div
                      class="input-group-prepend"
                      v-lazy-container="{ selector: 'img' }"
                    >
                      <img data-src="/assets/icons/map.svg" alt="map" />
                    </div>
                    <select
                      class="form-control border-0"
                      v-model="provinceSelect"
                      @change="provinceInput"
                    >
                      <option>Pilih Provinsi</option>
                      <option
                        v-for="province in provinces"
                        :key="province.id"
                        :value="province.id"
                      >
                        {{ province.name }}
                      </option>
                    </select>
                  </div>
                  <span
                    class="invalid-feedback d-block"
                    role="alert"
                    v-if="validation.province"
                  >
                    <strong>Pilih Provinsi</strong>
                  </span>
                </div>
                <div class="col-md-4 my-2">
                  <div class="d-flex">
                    <div
                      class="input-group-prepend"
                      v-lazy-container="{ selector: 'img' }"
                    >
                      <img data-src="/assets/icons/city.svg" alt="city" />
                    </div>
                    <select
                      class="form-control border-0"
                      v-model="regencySelect"
                    >
                      <option>Pilih Kota</option>
                      <option
                        v-for="regency in regencies"
                        :key="regency.id"
                        :value="regency.id"
                      >
                        {{ regency.name }}
                      </option>
                    </select>
                  </div>
                  <span
                    class="invalid-feedback d-block"
                    role="alert"
                    v-if="validation.regency"
                  >
                    <strong>Pilih Kota</strong>
                  </span>
                </div>
                <div class="col-md-4">
                  <button
                    type="buttom"
                    class="btn btn-main btn-block text-center text-white py-3 rounded-pill text-decoration-none"
                    style="border-radius: 25px"
                    @click="getSearchEvents"
                    v-if="!searchClick"
                  >
                    Search
                  </button>
                  <button
                    type="buttom"
                    class="btn btn-main btn-block text-center text-white py-3 rounded-pill text-decoration-none"
                    style="border-radius: 25px"
                    disabled
                    v-else
                  >
                    <b-spinner
                      style="width: 1.4rem; height: 1.4rem"
                      class="mx-4"
                    ></b-spinner>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div
            class="card card-search mx-auto border-0 shadow-sm w-100"
            style="margin-top: -20px"
            v-if="searchEvents.length > 0"
          >
            <div class="card-body">
              <router-link
                :to="{
                  name: 'EventDetail',
                  params: { slug: event.slug },
                }"
                v-for="event in searchEvents"
                :key="event.id"
                class="text-decoration-none"
              >
                <div class="row">
                  <div
                    class="col-md-2 col-lg-1"
                    v-lazy-container="{ selector: 'img' }"
                  >
                    <img data-src="/assets/icons/box.svg" alt="box" />
                  </div>
                  <div class="col-md">
                    <div class="event-title row align-items-center">
                      <h2 class="col-md" style="font-weight: 600">
                        {{ event.name }}
                      </h2>
                      <span
                        class="col-md-3 col-lg-2 d-none d-md-block badge badge-pill py-3 px-3 mx-4 belum-dimulai"
                        v-if="event.status == 'Belum Dimulai'"
                        >{{ event.status }}</span
                      >
                      <span
                        class="col-md-3 col-lg-2 d-none d-md-block badge badge-pill py-3 px-3 mx-4 dimulai"
                        v-else-if="event.status == 'Dimulai'"
                        >{{ event.status }}</span
                      >
                      <span
                        class="col-md-3 col-lg-2 d-none d-md-block badge badge-pill py-3 px-3 mx-4 selesai"
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
                <hr
                  v-if="event.id != searchEvents[searchEvents.length - 1].id"
                />
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- List Events -->
    <section class="list-events" id="events">
      <div class="container">
        <div class="row">
          <div class="col hero-title">
            <span class="rounded-pill"></span>
            <h3>List Event</h3>
          </div>
        </div>
        <div class="row" v-if="events.data.length > 0">
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
                    <h2 class="col-md" style="font-weight: 600">
                      {{ event.name }}
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
                  <a
                    href="#cari-event"
                    class="d-none d-md-block event-location rounded-pill py-2 px-4 text-center m-2 text-decoration-none"
                    @click="clickProvince(event.province.id)"
                  >
                    Provinsi : <span>{{ event.province.name }}</span>
                  </a>
                  <a
                    href="#cari-event"
                    @click="clickRegency(event.province.id, event.regency.id)"
                    class="event-location rounded-pill py-2 px-4 text-center m-2 text-decoration-none"
                  >
                    Kota : <span>{{ event.regency.name }}</span>
                  </a>
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
                  <b-skeleton type="button" class="btn-block"></b-skeleton>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center" v-if="events.data.length > 0">
          <pagination
            :data="events"
            :align="'center'"
            @pagination-change-page="getEvents"
          >
          </pagination>
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
  name: "Event",
  head: {
    title: function () {
      return { inner: "Event", separator: "-", complement: "Info.In" };
    },
  },
  components: {
    Navbar,
    Footer,
  },
  data() {
    return {
      searchClick: false,
      searchActive: false,
      provinceSelect: "",
      regencySelect: "",
      searchEvents: [],
      events: { data: [] },
      provinces: [],
      regencies: [],
      //state validation
      validation: [],
    };
  },
  methods: {
    clickProvince(province) {
      this.provinceSelect = province;
      this.provinceInput();
    },
    clickRegency(province, regency) {
      this.provinceSelect = province;
      this.provinceInput();
      this.regencySelect = regency;
    },
    getSearchEvents() {
      if (this.provinceSelect && this.regencySelect) {
        this.validation.province = false;
        this.validation.regency = false;

        this.searchClick = true;
        this.searchActive = true;
        axios
          .get(
            `https://dashboard.infoin.auroraweb.id/api/event/search?q=${this.regencySelect}`
          )
          .then((response) => {
            if (response.data.data.length == 0) {
              this.$toasted.error("Event tidak ditemukan!", {
                position: "top-right",
                className: "rounded",
                duration: 5000,
              });
            }
            this.searchClick = false;
            this.setSearchEvents(response.data.data);
          })
          .catch((error) => {
            this.searchClick = false;
            console.error(error);
          });
      } else {
        this.searchClick = false;
        this.searchActive = false;
        this.searchEvents = [];

        this.validation = [];

        if (!this.provinceSelect) {
          this.validation.province = true;
        }

        if (!this.regencySelect) {
          this.validation.regency = true;
        }
      }
    },
    setSearchEvents(data) {
      this.searchEvents = data;
    },
    provinceInput() {
      axios
        .get(
          `https://dashboard.infoin.auroraweb.id/api/regencies/${this.provinceSelect}`
        )
        .then((response) => this.setRegencies(response.data))
        .catch((error) => console.error(error));
    },
    setProvinces(data) {
      this.provinces = data;
    },
    setRegencies(data) {
      this.regencies = data;
    },
    setEvents(data) {
      this.events = data;
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
    getEvents(page = 1) {
      axios
        .get(`https://dashboard.infoin.auroraweb.id/api/event?page=${page}`)
        .then((response) => this.setEvents(response.data.data))
        .catch((error) => console.error(error));
    },
  },
  mounted() {
    axios
      .get("https://dashboard.infoin.auroraweb.id/api/provinces")
      .then((response) => {
        this.setProvinces(response.data);
        this.getEvents();
      })
      .catch((error) => console.error(error));
  },
};
</script>
