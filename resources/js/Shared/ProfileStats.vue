<template>
  <div>
    <transition
            enter-active-class="transition ease-out duration-200"
            enter-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
      <div :class="`sidebar__profile__dropdown-block
          ${ opened ? 'sidebar__profile__dropdown-block__opened' : ''}`"
      >
        <div class="sidebar__profile__progress__header">
          <p class="sidebar__profile__progress__header__course">Финансовый консультант</p>
          <p class="sidebar__profile__progress__header__percent">70%</p>
        </div>
        <div class="progress">
          <div class="progress-bar bg-info" role="progressbar" style="width: 70%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        <div class="sidebar__profile__progress__header" v-if="activeCourse">
          <p class="sidebar__profile__progress__header__course">
            Текущий курс: {{ activeCourse.title | truncate(10) }}
          </p>
          <p class="sidebar__profile__progress__header__percent">
            {{ activeCourse.pivot.progress }}%
          </p>
        </div>

        <div class="progress" v-if="activeCourse">
          <div class="progress-bar bg-info" role="progressbar"
               :style="`width: ${activeCourse.pivot.progress}%`"
               aria-valuenow="50" aria-valuemin="0"
               aria-valuemax="100"></div>
        </div>

        <div class="sidebar__profile__stats">
          <div class="sidebar__profile__stats__left">
            <p class="sidebar__profile__stats__left__title">Единицы</p>
            <p class="sidebar__profile__stats__left__text">
              {{ balance != null ? balance.direct_points : 0 }}
            </p>
          </div>
          <div class="sidebar__profile__stats__right">
            <p class="sidebar__profile__stats__right__title">Командные единицы</p>
            <p class="sidebar__profile__stats__right__text">
              {{ balance != null ? balance.team_points : 0 }}
            </p>
          </div>
        </div>
        <div class="sidebar__profile__agent" v-if="!!referrer">
          <img :src="referrer.profile_photo_path" class="sidebar__profile__agent__ava" alt="">
          <p class="sidebar__profile__agent__name">
            {{ referrer.name }}
          </p>
          <p class="sidebar__profile__agent__post" v-if="!!referrer.referral_level">
            {{ referrer.referral_level.title }}
          </p>
          <p class="sidebar__profile__agent__post">
            Мой финансовый консультант
          </p>
        </div>
      </div>
    </transition>

    <div :class="`sidebar__profile__dropdown
        ${ opened ? 'sidebar__profile__dropdown__opened' : ''}`"
        @click="opened = !opened">
      <img src="../../img/dropdown-arrow.png">
    </div>
  </div>
</template>

<script>
  import HasUser from "@/Mixins/HasUser";
  import JetDropdown from "@/Jetstream/Dropdown";

  export default {
    name: "ProfileStats",
    mixins: [HasUser],
    components: {
      JetDropdown
    },
    data() {
      return {
        opened: false
      }
    },
  }
</script>

<style scoped>

</style>