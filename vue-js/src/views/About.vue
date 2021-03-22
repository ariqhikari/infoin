<template>
  <div class="page-about" v-lazy-container="{ selector: 'img' }">
    <Navbar />
    <header>
      <img data-src="/assets/img/about-us.png" alt="About Us" />
    </header>
    <div class="container base">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-12 text-center">
              <section class="about">
                <div class="box-about-us">
                  <h6>About Us</h6>
                </div>
                <h5 class="title-about" style="font-weight: 600">
                  Who we are?
                </h5>
                <p class="parag-about">
                  Ingin mengetahui siapa orang-orang dibalik website ini? <br />
                  scroll kebawah, kita akan mengetahuinya bersama
                </p>
              </section>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-left">
              <div class="come-found-us">
                <p>Come!!</p>
                <h4>Found</h4>
                <h5>us.</h5>
              </div>
            </div>
          </div>
          <div class="row justify-content-center mt-4" id="member">
            <div class="col-md-4 text-center">
              <img data-src="/assets/img/ariq.png" width="170px" alt="" />
            </div>
            <div class="col-md-8">
              <h5 style="font-weight: 600">Ariq Hikari Hidayat</h5>
              <p>
                Nama saya Ariq Hikari Hidayat, saya dari SMKN 4 Bandung kelas XI
                RPL 2. Alasan mengikuti lomba DINAMIK 15, untuk mengasah
                kemampuan saya khususnya di bidang Web Development 😊
              </p>
              <a href="https://www.instagram.com/ariqhikari/" target="_blank">
                <h6>Visit Instagram</h6>
              </a>
            </div>
          </div>
          <div class="row justify-content-center mt-5" id="member">
            <div class="col-md-8">
              <h5 style="font-weight: 600">Muhamad Bilal Arief Suryanto</h5>
              <p>
                Nama saya Muhamad Bilal Arief Suryanto, saya dari SMKN 4 Bandung
                kelas XI RPL 2. Alasan mengikuti lomba DINAMIK 15, untuk
                menambah wawasan tentang bidang yang berkaitan dan dapat
                mengasah bakat dan kemampuan dengan mengaplikasikan bakat.
              </p>
              <a href="https://www.instagram.com/bilalarief/" target="_blank">
                <h6>Visit Instagram</h6>
              </a>
            </div>
            <div class="col-md-4 text-center">
              <img data-src="/assets/img/bilal.png" width="170px" alt="" />
            </div>
          </div>
          <div class="row justify-content-center mt-5" id="member">
            <div class="col-md-4 text-center">
              <img data-src="/assets/img/rasel.png" width="170px" alt="" />
            </div>
            <div class="col-md-8">
              <h5 style="font-weight: 600">Rachel Sabardila Permana Putra</h5>
              <p>
                Nama saya Rachel Sabardila Permana Putra, saya dari SMKN 4
                Bandung kelas XI RPL 2. Alasan mengikuti lomba DINAMIK 15,
                pengen juara biar dapat fulus 😁
              </p>
              <a
                href="https://www.instagram.com/raselsabardila_/"
                target="_blank"
              >
                <h6>Visit Instagram</h6>
              </a>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-left">
              <div class="come-found-us">
                <p>Where?</p>
                <h4>Found</h4>
                <h5>us.</h5>
              </div>
            </div>
          </div>
          <div class="row text-center mt-2" id="school">
            <div class="col-md-12">
              <img
                data-src="/assets/img/4.png"
                width="50%"
                alt=""
                id="img-school"
              />
              <h5 style="font-weight: 600">SMKN <span>4</span> Bandung</h5>
              <p>
                SMK Negeri 4 Bandung merupakan Sekolah Menengah Kejuruan Negeri
                yang berada di Kota Bandung, Jawa Barat, Indonesia. Berlokasi di
                Jalan Kliningan No. 6 RT 02 RW 05, Kelurahan Turangga, Kecamatan
                Lengkong, Kota Bandung.
              </p>
              <a
                href="https://www.instagram.com/smknegeri4bandung/"
                target="_blank"
              >
                <h6>Visit Instagram</h6>
              </a>
            </div>
          </div>
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

export default {
  name: "About",
  head: {
    title: {
      inner: "About Us",
      separator: "-",
      complement: "Info.In",
    },
  },
  components: {
    Navbar,
    Footer,
  },
};
</script>
