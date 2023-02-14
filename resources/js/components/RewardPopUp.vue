<script setup lang="ts">
import { ref } from "vue";
const show = ref(false);
const showBox = ref(false);
const reward = ref();

const openRewardDialog = (a) => {
  document.documentElement.style.overflow = "hidden";
  reward.value = a;
  show.value = true;
  setTimeout(() => {
    showBox.value = true;
  }, 300);
};

const closeRewardDialog = () => {
  show.value = false;
  document.documentElement.style.overflow = "auto";
};

defineExpose({
  openRewardDialog,
});
</script>

<template>
  <transition-fade>
    <div
      class="w-full fixed z-50 bg-black bg-opacity-50 h-[100vh] flex flex-col justify-center items-center top-0"
      v-if="show"
    >
      <div class="w-full mb-40 xl:px-20 text-center text-base md:text-xl">
        <div class="w-full font-bold text-orange-500 mb-4">
          Congratulations!, you won Saldo RP 15.000. Please Screenshot this page as your
          winning proof.
        </div>

        <div class="w-full font-bold text-white mb-6">
          Username: tester, Voucher Code: 123ASD
        </div>

        <div class="w-full flex justify-center gap-x-4">
          <a
            href="#"
            class="px-6 py-3 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-700"
          >
            Claim Reward
          </a>

          <a
            href="/"
            class="px-6 py-3 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-700"
          >
            Back to Home
          </a>
        </div>
      </div>

      <transition-scale>
        <div v-if="showBox" class="relative w-80 max-w-[100%]">
          <div class="relative z-20 w-full">
            <img src="/images/back_box.png" alt="" class="relative z-10 w-full" />

            <div
              class="absolute top-0 left-0 z-20 flex items-center justify-center w-full h-full"
            >
              <img :src="`${reward.image}`" alt="" class="w-[45%]" />
            </div>
            <img
              src="/images/left_box.png"
              alt=""
              class="absolute top-0 left-0 z-30 w-full transition-all duration-300 ease-linear translate-x-[-7rem]"
            />
            <img
              src="/images/right_box.png"
              alt=""
              class="absolute top-0 right-0 z-40 w-full transition-all duration-300 ease-linear translate-x-[5.5rem]"
            />
            <img
              src="/images/lid_box.png"
              alt=""
              class="absolute top-0 left-0 z-50 w-full transition-all duration-300 ease-linear translate-y-[-5.5rem]"
            />
          </div>
        </div>
      </transition-scale>
    </div>
  </transition-fade>
</template>
