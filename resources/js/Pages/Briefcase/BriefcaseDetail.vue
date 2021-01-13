<template>
    <main-layout>
        <template #back-link>
            <inertia-link :href="route('briefcases-admin.index')"
                          class="navbar-brand mb-0 pb-0">
                <img src="../../../img/back-arrow.png">
            </inertia-link>
        </template>

        <template #header>
            Просмотр {{ briefcase.title }}
        </template>

        <div class="cec">
            <label class="profile-form__label">Титульное фото портфеля</label>
            <label class="profile-form__label label-photo" @click="selectNewPhoto">
                <span>Изменить фото</span>
                <img :src="form.image_path" v-show="form.image_path">
                <img id="pcec" src="../../../img/course-card-img.png"
                     v-show="photoPreview == null && !form.image_path">
                <img :src="photoPreview" v-show="photoPreview">
            </label>

            <input type="file"
                   ref="image"
                   class="hidden">

            <label class="profile-form__label" for="name">
                Название портфеля
            </label>
            <input class="profile-form__input mb-0"
                   type="text"
                   id="name"
                   placeholder="Введите название портфеля"
                   v-model="form.title"
            >

            <label class="profile-form__label mt-3" for="type">
                Тип портфеля
            </label>

            <select id="type"
                    v-model="form.type_id"
                    class="mb-0">
                <option v-for="type in types"
                        :value="type.id"
                        :key="type.id"
                >
                    {{ type.title }}
                </option>
            </select>
            <label class="profile-form__label mt-3" for="description">
                Описание
            </label>
            <textarea class="profile-form__textarea mb-0"
                      id="description" cols="30" rows="6"
                      v-model="form.description"
                      placeholder="Введите полное описание"></textarea>
        </div>
    </main-layout>
</template>

<script>
    import MainLayout from "@/Layouts/MainLayout";
    export default {
        name: "BriefcaseDetail",
        components: {
            MainLayout,
            Form: () => import('./Crud/Form'),
        },
        props: {
            briefcase: Object,
            types: Array
        },
        data() {
            return {
                form: this.$inertia.form({
                    ...this.briefcase,
                    ...{
                        image: null,
                        '_method': 'PUT',
                    }
                }, {
                    bag: 'briefcaseForm',
                    resetOnSuccess: true,
                }),
                photoPreview: null,
            }
        },
        methods: {
            selectNewPhoto() {
                this.$refs.image.click();
            },

            updatePhotoPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.image.files[0]);
            }
        }
    }
</script>

<style scoped>

</style>
