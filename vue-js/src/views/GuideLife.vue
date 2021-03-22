<template>
  <div class="page-guide-life" v-lazy-container="{ selector: 'img' }">
    <Navbar />
    <div class="container">
      <section class="mt-5 header">
        <header>
          <div class="row justify-content-center">
            <div class="col-md-10 text-center">
              <h5 class="sub-title-header" data-aos="fade-up">
                Protokol Kesehatan
              </h5>
              <h3
                class="title-core-header"
                data-aos-delay="150"
                data-aos="fade-up"
              >
                Di Era New Normal dan Covid-19
              </h3>
              <center>
                <div
                  id="line-header"
                  data-aos-delay="150"
                  data-aos="fade-up"
                ></div>
              </center>
              <img
                data-src="/assets/img/map.png"
                data-aos-delay="150"
                id="img-map"
                width="70%"
                alt=""
                data-aos="fade-up"
              />
            </div>
          </div>
        </header>
      </section>
      <!-- akhir header -->

      <!-- content -->
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-md-7">
            <div data-aos="fade-right" data-aos-duration="200">
              <h6 class="sub-title-header">Apa yang harus kita lakukan?</h6>
              <div id="parent-box-title-content">
                <h1 class="number-title">4</h1>
                <div id="box-title-content">
                  <h5 class="title-content">
                    Poin Penting Yang Harus Diterapkan
                  </h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5 justify-content-center">
          <div class="col-md-12 col-lg-7">
            <div class="row" data-aos="fade-up" data-aos-duration="200">
              <div class="col-md-5">
                <div class="box-step">
                  <h1 class="number-step">1</h1>
                </div>
              </div>
              <div class="col-md-7 mt-4">
                <div>
                  <h5 class="text-step" style="font-weight: 600">
                    Jangan Lupa Masker
                  </h5>
                  <p class="parag-step">
                    Biasakan diri kita menggunakan masker <br />
                    bila beraktivitas diluar lingkungan <br />
                    rumah, supaya terhindar dari penularan <br />
                    virus Covid-19 ini.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5 justify-content-center">
          <div class="col-md-12 col-lg-7">
            <div class="row" data-aos="fade-up" data-aos-duration="400">
              <div class="col-md-7 mt-5">
                <div>
                  <h5 class="text-step2" style="font-weight: 600">
                    Physical Distancing
                  </h5>
                  <p class="parag-step2">
                    Ketika kita berada di tempat umum <br />
                    kita harus menjaga jarak <br />
                    dengan orang sekitar minimal 1 meter.
                  </p>
                </div>
              </div>
              <div class="col-md-5 mt-4">
                <div class="box-step2">
                  <h1 class="number-step">2</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5 justify-content-center">
          <div class="col-md-12 col-lg-7">
            <div class="row" data-aos="fade-up" data-aos-duration="200">
              <div class="col-md-5">
                <div class="box-step">
                  <h1 class="number-step">3</h1>
                </div>
              </div>
              <div class="col-md-7 mt-4">
                <div>
                  <h5 class="text-step" style="font-weight: 600">
                    Ketahui Etika Batuk & Bersin
                  </h5>
                  <p class="parag-step">
                    Salah satu yang terpenting, ketahui etika <br />
                    batuk dan bersin. Mau itu dirumah <br />
                    ataupun ditempat umum lainnya.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-5 justify-content-center">
          <div class="col-md-12 col-lg-7">
            <div class="row" data-aos="fade-up" data-aos-duration="400">
              <div class="col-md-7 mt-5">
                <div>
                  <h5 class="text-step2" style="font-weight: 600">
                    Isolasi Mandiri
                  </h5>
                  <p class="parag-step2">
                    Jika kita merasakan salah satu gejala <br />
                    terkena Covid-19, baiknya kita melakukan <br />
                    isolasi mandiri dirumah, supaya <br />
                    memotong mata rantai penularan virus.
                  </p>
                </div>
              </div>
              <div class="col-md-5 mt-4">
                <div class="box-step2">
                  <h1 class="number-step">4</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <Footer />
  </div>
</template>

<script>
// @ is an alias to /data-src
import Navbar from "@/components/Navbar.vue";
import Footer from "@/components/Footer.vue";

export default {
  name: "GuideLife",
  head: {
    title: function () {
      return { inner: "Guide Life", separator: "-", complement: "Info.In" };
    },
  },
  components: {
    Navbar,
    Footer,
  },
};
</script>
