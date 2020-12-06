<template>
  <jet-dropdown
      content-classes="sidebar__profile__dropdown-block"
      @switch="(value) => this.open = value"
  >
    // todo dynamic by levels
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
          <p class="sidebar__profile__stats__left__text">10</p>
        </div>
        <div class="sidebar__profile__stats__right">
          <p class="sidebar__profile__stats__right__title">Командные единицы</p>
          <p class="sidebar__profile__stats__right__text">0</p>
        </div>
      </div>
      <div class="sidebar__profile__agent">
        <img src="../../img/profile-agent-ava.png" class="sidebar__profile__agent__ava" alt="">
        <p class="sidebar__profile__agent__name">Зарлыков Темирлан</p>
        <p class="sidebar__profile__agent__post">Мой финансовый консультант</p>
      </div>
    </template>
    <template #trigger>
      <div class="sidebar__profile__dropdown">
        <img v-show="open" src="../../img/hide-arrow.png" alt="">
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