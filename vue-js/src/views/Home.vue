<template>
  <div class="page-home" v-lazy-container="{ selector: 'img' }">
    <Navbar />
    <div
      style="margin-top: 500px; margin-left: 50px; position: absolute"
      class="d-none d-lg-block"
    >
      <a href="#corona">
        <img data-src="/assets/icons/arrow.svg" alt="arrow" />
      </a>
    </div>

    <!-- Hero -->
    <section class="hero">
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-6 d-flex align-items-center mb-5">
            <div>
              <h1 class="font-weight-bolder">
                Mari Bantu <span>Orang</span> <br />
                Yang Sedang <span>Kesulitan.</span>
              </h1>
              <p>
                Program bantuan sosial dirancang untuk mendukung <br />
                kesejahteraan dan solidaritas masyarakat yang terdampak <br />
                ekonominya akibat pandemi COVID-19.
              </p>
              <br />
              <router-link
                :to="{ name: 'Donation' }"
                class="btn-main text-center text-white py-2 px-5 rounded-pill text-decoration-none"
                style="border-radius: 25px"
              >
                Mulai
              </router-link>
            </div>
          </div>
          <div class="col-md-6 d-none d-md-block overflow-hidden">
            <Lottie
              :options="animationsOptions.orangBawaKardus"
              v-on:animCreated="handleAnimation"
              class="hero-animation"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Covid -->
    <section class="corona" id="corona" data-aos="fade-up">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="corona-wrap shadow py-3 px-5 bg-white">
              <div class="row mb-2">
                <div class="col-12 d-flex">
                  <img
                    data-src="/assets/icons/indonesia.svg"
                    alt="indonesia"
                    style="object-fit: none"
                  />
                  <p class="font-weight-bolder ml-3 mt-3">Indonesia</p>
                </div>
              </div>
              <div class="row" v-if="dataCorona.haveData">
                <div class="col-md-4 text-center">
                  <h2 style="font-weight: 600">
                    <number
                      ref="number1"
                      :from="0"
                      :to="dataCorona.positif"
                      :format="theFormat"
                      :duration="3"
                      :delay="1"
                      easing="Power1.easeOut"
                    />
                  </h2>
                  <p>Total Kasus</p>
                </div>
                <div class="col-md-4 text-center">
                  <h2 class="sembuh" style="font-weight: 600">
                    <number
                      ref="number2"
                      :from="0"
                      :to="dataCorona.sembuh"
                      :format="theFormat"
                      :duration="3"
                      :delay="2"
                      easing="Power1.easeOut"
                    />
                  </h2>
                  <p>Sembuh</p>
                </div>
                <div class="col-md-4 text-center meninggal">
                  <h2 style="font-weight: 600">
                    <number
                      ref="number3"
                      :from="0"
                      :to="dataCorona.meninggal"
                      :format="theFormat"
                      :duration="3"
                      :delay="3"
                      easing="Power1.easeOut"
                    />
                  </h2>
                  <p>Meninggal Dunia</p>
                </div>
              </div>
              <div class="row" v-else>
                <div class="col-md-4 text-center">
                  <div class="d-flex flex-column align-items-center my-2">
                    <b-skeleton animation="wave" width="50%"></b-skeleton>
                    <b-skeleton animation="wave" width="80%"></b-skeleton>
                  </div>
                  <p>Total Kasus</p>
                </div>
                <div class="col-md-4 text-center">
                  <div class="d-flex flex-column align-items-center my-2">
                    <b-skeleton animation="wave" width="50%"></b-skeleton>
                    <b-skeleton animation="wave" width="80%"></b-skeleton>
                  </div>
                  <p>Sembuh</p>
                </div>
                <div class="col-md-4 text-center meninggal">
                  <div class="d-flex flex-column align-items-center my-2">
                    <b-skeleton animation="wave" width="50%"></b-skeleton>
                    <b-skeleton animation="wave" width="80%"></b-skeleton>
                  </div>
                  <p>Meninggal Dunia</p>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-12 text-center">
                  <p>
                    <i>
                      Updated {{ dataCorona.lastUpdate }} · source :
                      <a
                        href="https://github.com/mathdroid/covid-19-api"
                        target="_blank"
                        >mathdroid/covid-19-api</a
                      >
                    </i>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center" style="margin-top: -50px">
          <div class="col-md-10">
            <img data-src="/assets/img/map.png" alt="map" class="img-fluid" />
          </div>
        </div>
      </div>
    </section>

    <section class="guide-wrap">
      <div class="container guide">
        <div class="row py-5">
          <div class="col-12">
            <h1 class="font-weight-bolder">Guide Life</h1>
            <div class="title-line d-flex">
              <span class="title-line-primary"></span>
              <span class="title-line-secondary"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row mt-4 justify-content-center">
          <div
            class="col-md-6 cuciTangan"
            data-aos="fade-up"
            style="background-color: #feb19b"
          >
            <div class="guide-item d-flex justify-content-end pt-5">
              <img
                data-src="/assets/illustrations/cuciTangan.png"
                alt="cuciTangan"
                class="img-fluid"
              />
            </div>
          </div>
          <div class="row col-md-6 p-0">
            <div
              class="col-md-12 orangPakeMasker"
              data-aos="fade-up"
              data-aos-delay="100"
              style="background-color: #bcf1ff"
            >
              <div class="guide-item">
                <img
                  data-src="/assets/illustrations/pakaiMasker.png"
                  alt="pakaiMasker"
                  class="img-fluid"
                />
              </div>
            </div>
            <div
              class="col-md-12 socialDistance"
              data-aos="fade-up"
              data-aos-delay="200"
              style="background-color: #ffdda2"
            >
              <div class="guide-item">
                <img
                  data-src="/assets/illustrations/jagaJarak.png"
                  alt="jagaJarak"
                  class="img-fluid"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center mt-4 pb-5">
          <div class="col-md-4 col-lg-2">
            <router-link
              :to="{ name: 'GuideLife' }"
              class="btn-main btn-block text-center text-white p-3 rounded-pill text-decoration-none"
              style="border-radius: 25px"
            >
              View More
            </router-link>
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

import Lottie from "@/components/Lottie.vue";
import * as orangBawaKardusData from "../assets/illustrations/orang-bawa-kardus.json";

import axios from "axios";
import moment from "moment";

axios.defaults.withCredentials = false;

export default {
  name: "Home",
  head: {
    title: function () {
      return {
        inner: "Mari Bantu Orang Yang Sedang Kesulitan.",
        separator: "-",
        complement: "Info.In",
      };
    },
  },
  components: {
    Navbar,
    Footer,
    Lottie,
  },
  data() {
    return {
      dataCorona: {
        haveData: false,
      },
      animationsOptions: {
        orangBawaKardus: {
          animationData: orangBawaKardusData.default,
          loop: false, // Optional
          autoplay: true, // Optional
        },
      },
    };
  },
  methods: {
    handleAnimation(anim) {
      this.anim = anim;
    },
    theFormat(number) {
      var reverse = Math.round(number).toString().split("").reverse().join(""),
        ribuan = reverse.match(/\d{1,3}/g);
      ribuan = ribuan.join(".").split("").reverse().join("");

      return ribuan;
    },
    setRelativeDate(date) {
      return moment(date).startOf("day").fromNow();
    },
    setCoronaData(data) {
      this.dataCorona.positif = data.confirmed.value;
      this.dataCorona.sembuh = data.recovered.value;
      this.dataCorona.meninggal = data.deaths.value;
      this.dataCorona.lastUpdate = this.setRelativeDate(data.lastUpdate);
      this.dataCorona.haveData = true;
    },
  },
  mounted() {
    axios
      .get("https://covid19.mathdro.id/api/countries/indonesia")
      .then((response) => {
        this.setCoronaData(response.data);
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>
