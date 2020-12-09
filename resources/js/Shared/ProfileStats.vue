<template>
  <jet-dropdown
      content-classes="sidebar__profile__dropdown-block"
      @switch="(value) => this.open = value"
  >
    <template #content>
      <div class="sidebar__profile__progress__header">
        <p class="sidebar__profile__progress__header__course">Финансовый консультант</p>
        <p class="sidebar__profile__progress__header__percent">70%</p>
      </div>
      <div class="progress">
        <div class="progress-bar bg-info" role="progressbar" style="width: 70%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <div class="sidebar__profile__progress__header">
        <p class="sidebar__profile__progress__header__course">Текущий курс: Название ку...</p>
        <p class="sidebar__profile__progress__header__percent">50%</p>
      </div>
      <div class="progress">
        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
        <img src="../../img/profile-agent-ava.png" class="sidebar__profile__agent__ava" alt="">
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
    </template>
    <template #trigger>
      <div class="sidebar__profile__dropdown">
        <svg v-show="open" class="" width="15" height="11" viewBox="0 0 12 8" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5893 7.08942C11.2639 7.41486 10.7362 7.41486 10.4108 7.08942L6.00004 2.67867L1.5893 7.08942C1.26386 7.41486 0.73622 7.41486 0.410784 7.08942C0.0853462 6.76398 0.0853461 6.23634 0.410784 5.91091L5.41078 0.910907C5.73622 0.58547 6.26386 0.58547 6.58929 0.910907L11.5893 5.91091C11.9147 6.23634 11.9147 6.76398 11.5893 7.08942Z" fill="white"></path>
        </svg>
        <img v-show="!open" src="../../img/dropdown-arrow.png" alt="">
      </div>
    </template>
  </jet-dropdown>
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
        open: false
      }
    }
  }
</script>

<style scoped>

</style>