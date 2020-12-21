<template>
    <main-layout>
        <template #back-link>
            <a :href="route('users-crud.index')"
               class="navbar-brand mb-0 pb-0">
                <img src="../../../../img/back-arrow.png">
            </a>
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
                  :user="client"
                  :roles="roles"
                 @submit="updateUser"/>
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
    },
    props: {
        client: Object,
        roles: Array
    },
    data() {
        return {
            photoPreview: null,
            form: this.$inertia.form({
                ...this.client,
                ...{
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
            this.form.post('/users-crud/' + this.client.id);
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
        }
    }
}
</script>
