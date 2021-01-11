<template>
    <main-layout>
        <template #back-link>
            <inertia-link :href="backRoute"
               class="navbar-brand mb-0 pb-0">
                <img src="../../../../img/back-arrow.png">
            </inertia-link>
        </template>

        <template #header>
            Добавление пользователя
        </template>

        <div class="avatar">
            <img class="avatar__img" :src="avatarPath"
                 v-show="photoPreview == null && !form.image_path">
            <img class="avatar__img" :src="photoPreview" v-show="photoPreview">
            <a class="avatar__link"
               href="#"
               @click.prevent="selectNewPhoto">
                Изменить аватар
            </a>
            <input type="file"
                   ref="image"
                   @change="updatePhotoPreview"
                   class="hidden">
            <JetInputError :message="form.error('image')" class="mt-1"/>
        </div>
        <div class="profile-form">
            <Form :form="form"
                  :roles="roles"
                  :referral_level="referral_level"
                  :is-partners-user="!!partner_id"
                  @submit="createUser"/>
        </div>
    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import HasUser from "@/Mixins/HasUser";
export default {
    name: "Add",
    components: {
        Form: () => import('./Form'),
        MainLayout,
        JetInputError: () => import('@/Jetstream/InputError'),
    },
    mixins: [HasUser],
    props: {
        roles: Array,
        referral_level: {
            type: Array,
            default: null
        },
        partner_id: {
            type: Number,
            default: null
        }
    },
    data() {
      return {
        photoPreview: null,
        form: this.$inertia.form({
            name: "",
            email: null,
            phone: null,
            iin: null,
            photoPath: null,
            image: null,
            password: '',
            role_id: 2,
            direct_points: 0,
            team_points: 0,
            partner_id: this.partner_id,
            '_method': 'POST',
        }, {
            bag: 'userForm',
            resetOnSuccess: false,
        })
      }
    },
    methods: {
        createUser() {
            if (this.$refs.image) {
                this.$set(this.form, 'image', this.$refs.image.files[0]);
            }
            this.form.post(this.storeRouteName);
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
        backRoute() {
            if (this.isAdmin) {
                return route('users-crud.index')
            } else if (this.isPartner) {
                return route('partner-users.index')
            } else {
                return route('/')
            }
        },
        storeRouteName() {
            if (this.isAdmin) {
                return '/users-crud';
            } else if (this.isPartner) {
                return '/partner-users';
            } else {
                return null;
            }
        }
    }
}
</script>
