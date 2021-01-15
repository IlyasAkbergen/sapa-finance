<template>
  <main-layout>
    <template #back-link>
      <inertia-link :href="backRoute"
                    class="navbar-brand mb-0 pb-0">
        <img src="../../../../img/back-arrow.png">
      </inertia-link>
    </template>

    <template #header>
      Профиль пользователя {{ client.name }}
    </template>

    <div class="avatar">
      <img class="avatar__img" :src="avatarPath"
           v-show="photoPreview == null && !form.image_path">
      <img class="avatar__img" :src="photoPreview" v-show="photoPreview">
      <a class="avatar__link" href="" @click.prevent="selectNewPhoto">
        Изменить аватар
      </a>
      <input type="file"
             ref="image"
             @change="updatePhotoPreview"
             class="hidden">
    </div>

    <div class="profile-form">
      <Form :form="form"
            :roles="roles"
            :referral_level="referral_level"
            :is-partners-user="!!partner_id"
            @submit="updateUser"/>
    </div>

    <div class="column" v-if="isAdmin">
      <ReferralTree :data="referral_tree" />
    </div>

    <div v-if="referrer" class="avatar" style="margin-left: 20px">
      <img src="../../../../img/profile-agent-ava.png" class="avatar__img" style="width: 50px; height: 50px" alt="">
      <p class="referrer_name">{{ referrer.name }}</p>
      <p class="referrer_title">Мой агент</p>
      <inertia-link class="avatar__link"
                    v-if="referrer"
                    :href="route('complaints.create', {
                    id: client.id,
                    referrer_id: referrer.id
                })"
                    style="text-align: center">
        Оставить отзыв
      </inertia-link>
    </div>
  </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'

export default {
  name: "Edit",
  components: {
    Form: () => import('./Form'),
    MainLayout,
    ReferralTree: () => import('../ReferralTree')
  },
  props: {
    client: Object,
    roles: Array,
    referrer: {
      type: Object,
      default: null,
    },
    auth_user: {
      type: Object,
      default: null,
    },
    referral_level: {
      type: Array,
      default: null
    },
    partner_id: {
      type: Number,
      default: null
    },
    referral_tree: {
      type: Object,
      default: null
    }
  },
  data() {
    return {
      photoPreview: null,
      form: this.$inertia.form({
        ...this.client,
        ...{
          partner_id: this.partner_id,
          image: null,
          password: null,
          '_method': 'PUT',
        }
      }, {
        bag: 'userForm',
        resetOnSuccess: true,
      }),
    }
  },
  methods: {
    updateUser() {
      if (this.$refs.image) {
        this.$set(this.form, 'image', this.$refs.image.files[0]);
      }
      console.log('is partner: ' + this.isPartner);
      console.log('route: ' + this.updateRouteName);
      this.form.post(this.updateRouteName + this.client.id);
    },
    selectNewPhoto() {
      this.$refs.image.click();
    },
    updatePhotoPreview() {
      const reader = new FileReader();

      reader.onload = (e) => {
        this.photoPreview = e.target.result;
      };

      reader.readAsDataURL(this.$refs.image.files[0]);
    },
  },
  computed: {
    avatarPath() {
      return this.form.profile_photo_path
        ? this.form.profile_photo_path
        : '/images/avatar-empty.png';
    },
    updateRouteName() {
      if (this.isAdmin) {
        return window.location.pathname === '/users-crud/me'
          ? '/users-crud/update/'
          : '/users-crud/';
      } else if (this.isPartner) {
        return '/partner-users/'
      } else {
        return ''
      }
    },
    backRoute() {
      if (this.isAdmin) {
        return route('users-crud.index')
      } else if (this.isPartner) {
        return route('partner-users.index')
      } else {
        return route('')
      }
    },
    isAdmin() {
      return this.$page.user.role_id === 1;
    },
    isPartner() {
      return this.$page.user.role_id === 3;
    }
  }
}
</script>
