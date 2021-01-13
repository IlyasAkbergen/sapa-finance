<template>
  <main-layout>
    <template #header>
      Профиль пользователя {{ client.name }}
    </template>

    <div class="avatar">
      <img class="avatar__img"
           :src="avatarPath">
    </div>

    <div class="profile-form partner-info">
      <inertia-link class="users__link users__link--blue partner-info__link"
                    v-if="canEdit"
                    :href="editRoute">
        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M10.1357 2.47392L9.94285 2.66675L12.3334 5.05728L12.5257 4.865L12.5262 4.86444L12.5315 4.85886C12.5379 4.85199 12.5493 4.83954 12.5646 4.82193C12.5953 4.78653 12.6406 4.7313 12.6919 4.65947C12.7964 4.5132 12.9155 4.31232 12.9926 4.08093C13.0688 3.85232 13.1 3.60734 13.0494 3.35479C12.9999 3.10715 12.8628 2.80567 12.5286 2.47149C12.1945 2.13731 11.893 2.00021 11.6453 1.95068C11.3928 1.90017 11.1478 1.93134 10.9192 2.00754C10.6878 2.08467 10.4869 2.20372 10.3407 2.3082C10.2688 2.35951 10.2136 2.40484 10.1782 2.43552C10.1606 2.45079 10.1481 2.4622 10.1413 2.46862L10.1357 2.47392ZM11.3906 6.00009L9.00004 3.60956L1.66671 10.9429V13.3334H4.05723L11.3906 6.00009ZM11.9068 0.643241C12.4404 0.749963 12.9723 1.02953 13.4714 1.52868C13.9706 2.02784 14.2502 2.55969 14.3569 3.0933C14.4626 3.622 14.3896 4.10619 14.2575 4.50257C14.1263 4.89619 13.9328 5.21614 13.7769 5.43445C13.698 5.54491 13.6261 5.63291 13.5722 5.69517C13.5451 5.72638 13.5224 5.75137 13.5052 5.76973C13.4966 5.77892 13.4894 5.78647 13.4837 5.79233L13.4764 5.79985L13.4736 5.80266L13.4724 5.80382L13.4719 5.80434C13.4717 5.80459 13.4714 5.80482 13 5.33342L13.4714 5.80482L4.80478 14.4715C4.67975 14.5965 4.51019 14.6667 4.33337 14.6667H1.00004C0.631851 14.6667 0.333374 14.3683 0.333374 14.0001V10.6668C0.333374 10.4899 0.403612 10.3204 0.528636 10.1953L9.1953 1.52868L9.66671 2.00009C9.1953 1.52868 9.19554 1.52844 9.19578 1.5282L9.1963 1.52768L9.19747 1.52653L9.20027 1.52375L9.2078 1.51641C9.21366 1.51074 9.22121 1.50352 9.23039 1.49493C9.24875 1.47775 9.27374 1.45499 9.30496 1.42793C9.36721 1.37398 9.45522 1.30212 9.56567 1.22322C9.78398 1.06729 10.1039 0.873836 10.4976 0.742631C10.8939 0.610503 11.3781 0.537502 11.9068 0.643241Z" fill="white"/>
        </svg>
      </inertia-link>
      <p class="partner-info__subtitle">
        ФИО
      </p>
      <p class="partner-info__title" style="padding-right: 40px;">
        {{ client.name }}
      </p>
      <p class="partner-info__subtitle" v-if="canEdit">
        ИИН
      </p>
      <p class="partner-info__title" v-if="canEdit">
        {{ client.iin }}
      </p>
      <p class="partner-info__subtitle">
        Эл. почта
      </p>
      <p class="partner-info__title">
        {{ client.email }}
      </p>
      <p class="partner-info__subtitle">
        Номер телефона
      </p>
      <p class="partner-info__title">
        {{ client.phone }}
      </p>
    </div>
  </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import HasUser from "@/Mixins/HasUser";
export default {
  name: "Show",
  components: {
    MainLayout
  },
  mixins: [HasUser],
  props: {
    client: Object
  },
  computed: {
    canEdit() {
      return this.isAdmin || this.getUser().id === this.client.id;
    },
    avatarPath() {
      return this.client.profile_photo_path
        ? this.client.profile_photo_path
        : '/images/avatar-empty.png';
    },
    editRoute() {
      return this.getUser().id === this.client.id
        ? route('me')
        : route('users-crud.edit', this.client.id)
    }
  }
}
</script>
