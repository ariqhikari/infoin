<template>
  <div class="page-donasi-detail">
    <Navbar v-on:setDataUser="getDataUser" />
    <!-- Donasi & Pembayaran -->
    <div
      class="container donasi-payment mt-4"
      v-if="Object.keys(donation).length > 0"
    >
      <div class="row justify-content-between">
        <div class="col-md-7 my-2">
          <div class="card border-0 p-3">
            <img
              v-lazy="
                `https://dashboard.infoin.auroraweb.id/storage/${donation.thumbnail}`
              "
              :alt="donation.title"
              class="card-img-top img-fluid"
            />
            <div class="card-body p-0 mt-3">
              <div class="donasi-item">
                <div class="main-donasi">
                  <div
                    class="row justify-content-between align-items-center mb-4"
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
                  <h5 class="card-title">
                    {{ donation.title }}
                  </h5>
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
                    <span class="text-right" v-else>
                      Remaining : Terpenuhi
                    </span>
                  </div>
                  <p v-html="donation.content"></p>
                </div>
                <hr />
                <div class="media-donasi">
                  <h5 class="mb-3">Penggalang Dana</h5>
                  <div class="media d-flex align-items-center">
                    <router-link
                      :to="{
                        name: 'Profile',
                        params: { slug: donation.user.slug },
                      }"
                    >
                      <img
                        v-lazy="donation.user.avatar"
                        v-if="donation.user.google_id"
                        alt="Event Organizer"
                        class="mr-3 rounded-circle thumb-eo"
                        width="50"
                        height="50"
                      />
                      <img
                        v-lazy="
                          `https://dashboard.infoin.auroraweb.id/storage/${donation.user.avatar}`
                        "
                        v-else
                        alt="Event Organizer"
                        class="mr-3 rounded-circle"
                        width="50"
                        height="50"
                      />
                    </router-link>
                    <div class="media-body">
                      <router-link
                        :to="{
                          name: 'Profile',
                          params: { slug: donation.user.slug },
                        }"
                        style="color: #565a60"
                      >
                        <h6 class="m-0">
                          {{ donation.user.name }}
                        </h6>
                      </router-link>
                      <small v-if="donation.user.role_id == 2"
                        >Event Organizer</small
                      >
                      <small v-else>Admin</small>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="media-donasi">
                  <h5 class="mb-3">
                    Donasi ({{ donation.donation_details.length }})
                  </h5>
                  <div
                    class="media rounded p-3 my-4"
                    style="background-color: #fbfbfb"
                    v-for="user in donation.donation_details"
                    :key="user.id"
                  >
                    <img
                      v-lazy="user.user.avatar"
                      :alt="user.user.name"
                      v-if="user.user.google_id"
                      class="mr-3 rounded-circle"
                      width="50"
                      height="50"
                    />
                    <img
                      v-lazy="
                        `https://dashboard.infoin.auroraweb.id/storage/${user.user.avatar}`
                      "
                      :alt="user.user.name"
                      v-else
                      class="mr-3 rounded-circle"
                      width="50"
                      height="50"
                    />
                    <div class="media-body mt-1">
                      <h6 class="m-0">{{ user.user.name }}</h6>
                      <small>{{ setRelativeDate(user.created_at) }}</small>
                      <div class="media-desc mt-4">
                        <p>
                          {{ user.pesan }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5 col-lg-4 my-2">
          <form>
            <div class="card border-0 p-3 mb-5">
              <div class="nominal-donasi">
                <h5 class="mb-3">Pembayaran :</h5>
                <h6>Nominal Donasi :</h6>
                <div class="mb-3 my-3">
                  <div class="input-group px-3 py-1 d-flex align-items-center">
                    <div class="input-group-prepend">
                      <h5 class="m-0">Rp</h5>
                    </div>
                    <input
                      type="number"
                      class="form-control border-0"
                      v-model="formDonasi.donasi"
                      :min="0"
                      :max="100000000"
                    />
                  </div>
                  <span
                    class="invalid-feedback d-block"
                    role="alert"
                    v-if="validation.donasi"
                  >
                    <strong>Masukkan Donasi</strong>
                  </span>
                </div>
                <h6>Pesan untuk mereka (optional) :</h6>
                <div
                  class="input-group mb-3 my-3 px-1 py-1 d-flex align-items-center"
                >
                  <textarea
                    class="form-control border-0"
                    placeholder="Tulis pesan.."
                    style="height: 50px"
                    v-model="formDonasi.pesan"
                  ></textarea>
                </div>
                <div class="d-flex justify-content-between">
                  <h6>Kode Unik</h6>
                  <h6 class="text-right">Rp. {{ formatPrice(kodeUnik) }}</h6>
                </div>
                <div class="d-flex justify-content-between">
                  <h6>Total Pembayaran</h6>
                  <h6 class="text-right" style="font-weight: 600">
                    Rp.
                    {{ formatPrice(parseInt(formDonasi.donasi) + kodeUnik) }}
                  </h6>
                </div>
              </div>
              <hr />
              <div v-if="konfirmasi">
                <div v-for="bank in donation.user.user_banks" :key="bank.id">
                  <div class="transfer-item">
                    <h5 class="mb-3">Transfer Pembayaran :</h5>
                    <div class="logo-rekening mb-2">
                      <img
                        v-lazy="
                          `https://dashboard.infoin.auroraweb.id/storage/${bank.bank.logo}`
                        "
                        :alt="bank.bank.name"
                      />
                    </div>
                    <div class="d-flex justify-content-between">
                      <h6>Bank</h6>
                      <h6 class="text-right" style="font-weight: 600">
                        {{ bank.bank.name }}
                      </h6>
                    </div>
                    <div class="d-flex justify-content-between">
                      <h6>No. Rekening</h6>
                      <h6 class="text-right" style="font-weight: 600">
                        {{ bank.no_rekening }}
                      </h6>
                    </div>
                    <div class="d-flex justify-content-between">
                      <h6>Penerima</h6>
                      <h6 class="text-right" style="font-weight: 600">
                        {{ bank.nama_rekening }}
                      </h6>
                    </div>
                  </div>
                  <hr />
                </div>
                <div class="nominal-donasi">
                  <h5 class="mb-3">Konfirmasi Pembayaran :</h5>
                  <h6>Nama Rekening :</h6>
                  <div class="mb-3 my-3">
                    <div class="input-group py-1 d-flex align-items-center">
                      <input
                        type="text"
                        class="form-control border-0"
                        placeholder="Nama rekening anda.."
                        v-model="formDonasi.nama_rekening"
                      />
                    </div>
                    <span
                      class="invalid-feedback d-block"
                      role="alert"
                      v-if="validation.nama_rekening"
                    >
                      <strong>Masukkan Nama Rekening</strong>
                    </span>
                  </div>
                  <h6>Bukti Pembayaran :</h6>
                  <div class="mb-3">
                    <input
                      type="file"
                      class="form-control-file border-0 mt-2 mb-3"
                      name="bukti_pembayaran"
                      @change="onImageChange"
                    />
                    <span
                      class="invalid-feedback d-block"
                      role="alert"
                      v-if="validation.bukti_pembayaran"
                    >
                      <strong>Masukkan Bukti Pembayaran</strong>
                    </span>
                  </div>
                </div>
              </div>
              <button
                type="button"
                class="btn btn-main btn-block p-3"
                v-if="!konfirmasi"
                @click="setKonfirmasi()"
              >
                KONFIRMASI PEMBAYARAN
              </button>
              <div class="row justify-content-between" v-else>
                <button
                  type="button"
                  class="col-6 btn btn-secondary p-3"
                  @click="konfirmasi = false"
                >
                  BATAL
                </button>
                <button
                  type="button"
                  class="col-6 btn btn-main p-3 continue-donation"
                  @click="postDonasi"
                  v-if="!donasiClick"
                >
                  <span> LANJUTKAN </span>
                </button>
                <button
                  type="button"
                  class="col-6 btn btn-main p-3 continue-donation"
                  disabled
                  v-else
                >
                  <b-spinner
                    style="width: 1.3rem; height: 1.3rem"
                    class="mx-4"
                  ></b-spinner>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="container donasi-payment mt-4" v-else>
      <div class="row justify-content-between">
        <div class="col-md-7 my-2">
          <div class="card border-0 p-3">
            <b-skeleton-img></b-skeleton-img>
            <div class="card-body p-0 mt-3">
              <div class="donasi-item">
                <div class="main-donasi">
                  <b-skeleton animation="wave" width="85%"></b-skeleton>
                  <b-skeleton animation="wave" width="55%"></b-skeleton>
                  <b-skeleton
                    animation="wave"
                    width="100%"
                    height="10px"
                    class="my-3"
                  ></b-skeleton>
                  <div class="d-flex justify-content-between mt-2 mb-4">
                    <b-skeleton animation="wave" width="30%"></b-skeleton>
                    <b-skeleton animation="wave" width="30%"></b-skeleton>
                  </div>
                  <p>
                    <b-skeleton animation="wave" width="85%"></b-skeleton>
                    <b-skeleton animation="wave" width="55%"></b-skeleton>
                    <b-skeleton animation="wave" width="70%"></b-skeleton>
                  </p>
                </div>
                <hr />
                <div class="media-donasi">
                  <b-skeleton
                    animation="wave"
                    width="30%"
                    class="mb-3"
                  ></b-skeleton>
                  <div class="media d-flex align-items-center">
                    <b-skeleton type="avatar"></b-skeleton>
                    <div class="media-body ml-2">
                      <b-skeleton animation="wave" width="50%"></b-skeleton>
                      <b-skeleton animation="wave" width="30%"></b-skeleton>
                    </div>
                  </div>
                </div>
                <hr />
                <div class="media-donasi">
                  <b-skeleton
                    animation="wave"
                    width="20%"
                    class="mb-3"
                  ></b-skeleton>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5 col-lg-4 my-2">
          <form>
            <div class="card border-0 p-3 mb-5">
              <div class="nominal-donasi">
                <b-skeleton animation="wave" width="60%"></b-skeleton>
                <b-skeleton animation="wave" width="50%"></b-skeleton>
                <div class="mb-3 my-3">
                  <b-skeleton type="input"></b-skeleton>
                </div>
                <b-skeleton animation="wave" width="50%"></b-skeleton>
                <div class="mb-3 my-3">
                  <b-skeleton type="input"></b-skeleton>
                </div>
                <div class="d-flex justify-content-between">
                  <b-skeleton animation="wave" width="30%"></b-skeleton>
                  <b-skeleton animation="wave" width="30%"></b-skeleton>
                </div>
                <div class="d-flex justify-content-between mt-1">
                  <b-skeleton animation="wave" width="40%"></b-skeleton>
                  <b-skeleton animation="wave" width="30%"></b-skeleton>
                </div>
                <b-skeleton type="button" class="btn-block mt-4"></b-skeleton>
              </div>
            </div>
          </form>
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

import moment from "moment";
import axios from "axios";

export default {
  name: "DonationDetail",
  head: {
    title: function () {
      return { inner: "Donation", separator: "-", complement: "Info.In" };
    },
  },
  components: {
    Navbar,
    Footer,
  },
  data() {
    return {
      konfirmasi: false,
      donasiClick: false,
      donation: {},
      formDonasi: {
        donasi: 0,
        pesan: "",
        nama_rekening: "",
        bukti_pembayaran: "",
      },
      //state validation
      validation: [],
      kodeUnik: Math.floor(Math.random() * 500) + 1,
    };
  },
  methods: {
    getDanaTerkumpul(data) {
      var hasil = data.reduce(
        (acc, current) => acc + parseInt(current.donasi),
        0
      );
      return hasil;
    },
    getDataUser(user) {
      this.formDonasi.user_id = user.id;
    },
    setKonfirmasi() {
      if (!this.formDonasi.user_id) {
        this.$router.push({ name: "Login" });
      }

      this.konfirmasi = true;
    },
    setDonation(data) {
      this.donation = data;
      this.formDonasi.donation_id = data.id;

      var now = new Date();
      this.donation.donation_end = new Date(this.donation.donation_end);
      this.donation.timeLeft = this.donation.donation_end - now;
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
    onImageChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      this.createImage(files[0]);
    },
    createImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = (e) => {
        vm.formDonasi.bukti_pembayaran = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    postDonasi() {
      if (
        this.formDonasi.donasi >= this.donation.min_dana &&
        this.formDonasi.nama_rekening &&
        this.formDonasi.bukti_pembayaran
      ) {
        this.donasiClick = true;

        axios
          .post(
            "https://dashboard.infoin.auroraweb.id/api/donation",
            this.formDonasi
          )
          .then(() => {
            //debug user login
            const slugDonation = this.donation.slug;
            this.formDonasi = {};
            this.$router.push({ name: "Checkout", params: { slugDonation } });
          })
          .catch((error) => {
            console.log(error);
            this.donasiClick = false;
            this.$toasted.error("Yang anda masukkan bukan gambar!", {
              position: "top-right",
              className: "rounded",
              duration: 5000,
            });
          });
      }

      this.validation = [];

      if (!this.formDonasi.donasi) {
        this.validation.donasi = true;
      }

      if (!this.formDonasi.nama_rekening) {
        this.validation.nama_rekening = true;
      }

      if (!this.formDonasi.bukti_pembayaran) {
        this.validation.bukti_pembayaran = true;
      }

      if (this.formDonasi.donasi < this.donation.min_dana) {
        this.$toasted.error(
          `Minimal Donasi Rp ${this.formatPrice(this.donation.min_dana)}`,
          {
            position: "top-right",
            className: "rounded",
          }
        );
      }
    },
  },
  mounted() {
    window.scrollTo(0, 0);
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