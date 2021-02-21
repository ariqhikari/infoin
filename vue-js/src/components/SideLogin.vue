<template>
  <div
    class="col-lg-6 d-none d-lg-flex justify-content-end align-items-end illustration"
  >
    <Lottie
      :options="makeAnimation(boxJatoh)"
      v-on:animCreated="handleAnimation"
    />
  </div>
</template>

<script>
import Lottie from "@/components/Lottie.vue";
import * as boxJatoh from "../assets/illustrations/box-jatoh.json";

export default {
  name: "SideLogin",
  components: {
    Lottie,
  },
  data() {
    return {
      boxJatoh: boxJatoh,
    };
  },
  methods: {
    handleAnimation: function (anim) {
      this.anim = anim;
    },
    makeAnimation(animation) {
      return {
        animationData: animation.default,
        loop: false, // Optional
        autoplay: true, // Optional
        rendererSettings: {
          scaleMode: "noScale",
          clearCanvas: false,
          progressiveLoad: true,
          hideOnTransparent: true,
        },
      };
    },
  },
};
</script>

<style>
</style>