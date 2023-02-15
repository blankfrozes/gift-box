<script setup lang="ts">
import { ref, reactive, computed } from "vue";
import { required, helpers } from "@vuelidate/validators";
import { useVuelidate } from "@vuelidate/core";
import { HalfCircleSpinner } from "epic-spinners";
import { shuffleArray } from "@/helper/shuffleArray";
import RewardPopUp from "@/components/RewardPopUp.vue";
import { getAllRewards } from "@/api/rewards.js";
import { getVoucherReward, useVoucher } from "@/api/voucher.js";
import { useAsyncState } from "@vueuse/core";

// let rewards;

let { state: rewards, isReady } = useAsyncState(
  getAllRewards().then((t) => t.data),
  ""
);

const showReward = ref(false);
const enableReward = ref(false);
const showChoice = ref(true);
const showInput = ref(false);
const showOpen = ref(false);
const processSubmit = ref(false);
const voucherError = ref(false);
const rewardDialog = ref();
const selectedRewardIndex = ref();

const input = reactive({
  voucherCode: "",
});

const rules = computed(() => {
  return {
    voucherCode: {
      required: helpers.withMessage("voucher code is required!", required),
    },
  };
});

const v$ = useVuelidate(rules, input);

const voucherReward = ref();

const showRewardBox = () => {
  showReward.value = true;
  enableReward.value = true;
  showChoice.value = true;
};

const startInput = () => {
  showReward.value = false;
  enableReward.value = false;
  showChoice.value = false;
  showInput.value = true;
};

const submitVoucherCode = async () => {
  processSubmit.value = true;
  const isFormCorrect = await v$.value.$validate();
  if (!isFormCorrect) {
    input.voucherCode = "";

    processSubmit.value = false;

    return;
  }

  try {
    const { state, error } = useAsyncState(
      await getVoucherReward(input.voucherCode).then((t) => t),
      ""
    );

    voucherReward.value = state;
  } catch (error) {
    voucherError.value = true;
    processSubmit.value = false;
    return;
  }

  showInput.value = false;
  showOpen.value = true;
  processSubmit.value = false;
};

const showProcess = () => {
  enableReward.value = true;
  showOpen.value = false;
};

const annouceReward = async (index, reward, oldRewards) => {
  if (!reward) {
    return;
  }

  try {
    await useVoucher(reward.id);
  } catch (error) {
    return;
  }

  showReward.value = true;

  oldRewards = shuffleArray(oldRewards);

  for (let i = 0; i < oldRewards.length; i++) {
    if (oldRewards[i]["id"] === reward.reward_id) {
      [oldRewards[i], oldRewards[index]] = [oldRewards[index], oldRewards[i]];
      break;
    }
  }

  rewards = reactive(oldRewards);

  setTimeout(() => {
    selectedRewardIndex.value = index;
  }, 200);

  rewardDialog.value.openRewardDialog(reward);
};
</script>

<template>
  <div class="w-full">
    <!-- <div v-if="isReady">{{ rewards.length }}</div> -->
    <div class="container px-4 mx-auto sm:px-10 md:px-14 xl:px-60 2xl:px-80">
      <div class="flex items-center justify-center w-full mt-8 mb-10">
        <img src="/images/mystery.png" alt="" class="relative z-40 w-80" />
      </div>

      <div class="relative w-full mb-10">
        <div class="grid w-full grid-cols-2 gap-4 md:gap-8 md:grid-cols-4">
          <div
            class=""
            v-for="(reward, i) in rewards"
            :key="reward['id']"
            v-if="isReady"
          >
            <div class="relative w-full" v-if="selectedRewardIndex !== i">
              <div
                class="absolute top-0 left-0 z-30 w-full h-full"
                v-if="!showReward"
                @click="annouceReward(i, voucherReward.value, rewards)"
              ></div>

              <div class="relative z-20 w-full">
                <img
                  src="/images/back_box.png"
                  alt="back_box"
                  class="relative z-10 w-full"
                />

                <div
                  class="absolute top-0 left-0 z-20 flex items-center justify-center w-full h-full"
                >
                  <img
                    :src="`${reward['image']}`"
                    alt="reward"
                    class="w-[45%]"
                  />
                </div>
                <img
                  src="/images/left_box.png"
                  alt=""
                  class="absolute top-0 left-0 z-30 w-full transition-all duration-300 ease-linear"
                  :class="{
                    'translate-x-[-5rem] opacity-60': showReward,
                  }"
                />
                <img
                  src="/images/right_box.png"
                  alt=""
                  class="absolute top-0 right-0 z-40 w-full transition-all duration-300 ease-linear"
                  :class="{
                    'translate-x-[3.5rem] opacity-60': showReward,
                  }"
                />
                <img
                  src="/images/lid_box.png"
                  alt=""
                  class="absolute top-0 left-0 z-50 w-full transition-all duration-300 ease-linear"
                  :class="{
                    'translate-y-[-3.5rem] opacity-60': showReward,
                  }"
                />
              </div>
            </div>
          </div>
        </div>

        <div
          class="fixed top-0 left-0 z-30 flex flex-col items-center justify-center w-full h-full bg-black bg-opacity-30"
          v-if="!enableReward"
        >
          <div
            class="flex flex-col justify-center w-full gap-x-4"
            v-if="showChoice"
          >
            <div class="mb-10 text-2xl font-bold text-center text-white w-ful">
              WELCOME TO MYSTERY BOX
            </div>

            <div class="flex justify-center gap-x-4">
              <button
                @click="startInput"
                class="px-6 py-3 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-700"
              >
                Start
              </button>

              <button
                @click="showRewardBox"
                class="px-6 py-3 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-700"
              >
                Show Reward
              </button>
            </div>
          </div>

          <transition-slide>
            <div class="flex justify-center w-full gap-x-4" v-if="showInput">
              <form
                action="post"
                @submit.prevent="submitVoucherCode"
                class="w-full sm:w-1/2 md:w-[40%] lg:w-[30%] text-white px-4"
              >
                <div class="mb-10 text-2xl font-bold text-center w-ful">
                  Input Voucher Code
                </div>

                <div class="w-full mb-4">
                  <input
                    type="text"
                    name="code"
                    class="w-full px-4 py-2 text-black rounded disabled:bg-gray-200"
                    :class="{
                      '!border-red-500 focus:!border-red-500':
                        v$.voucherCode.$error,
                      '!border-[#42d392] ': !v$.voucherCode.$invalid,
                    }"
                    :disabled="processSubmit"
                    v-model="input.voucherCode"
                    @blur="v$.voucherCode.$touch"
                    placeholder="Voucher Code"
                    autofocus
                  />
                  <div
                    v-if="v$.voucherCode.$error"
                    class="w-full px-2 mb-2 text-sm font-bold text-red-500"
                  >
                    {{ v$.voucherCode.$errors[0].$message }}
                  </div>

                  <div
                    class="w-full px-2 text-sm font-bold text-white"
                    v-if="voucherError"
                  >
                    The code you entered is wrong, please contact Admin to get
                    the ticket code
                    <a
                      href="#"
                      class="text-green-500 hover:underline hover:text-green-700"
                      >here</a
                    >.
                  </div>
                </div>

                <button
                  type="submit"
                  :disabled="processSubmit"
                  class="flex justify-center w-full px-6 py-3 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-700 disabled:bg-gray-500"
                >
                  <half-circle-spinner
                    :animation-duration="1000"
                    :size="20"
                    color="white"
                    v-if="processSubmit"
                  />
                  <span v-else> Start </span>
                </button>
              </form>
            </div>
          </transition-slide>

          <transition-slide>
            <div class="w-full text-center gap-x-4" v-if="showOpen">
              <div class="mb-10 font-bold text-center text-white w-ful">
                Choose one of the boxes to get your reward.
              </div>

              <button
                @click="showProcess"
                class="inline-block px-6 py-3 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-700"
              >
                Continue
              </button>
            </div>
          </transition-slide>
        </div>
      </div>

      <div
        class="flex justify-center w-full"
        v-if="showReward && !voucherReward"
      >
        <button
          @click="startInput"
          class="px-6 py-3 text-sm font-bold text-white bg-blue-500 rounded hover:bg-blue-700"
        >
          Start
        </button>
      </div>
    </div>

    <RewardPopUp ref="rewardDialog" />
  </div>
</template>
