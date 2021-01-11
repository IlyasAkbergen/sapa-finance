<template>
    <form action="">
        <label class="profile-form__label" for="username">ФИО</label>
        <input class="profile-form__input mb-0" type="text" id="username"
            v-model="form.name">
        <JetInputError :message="form.error('name')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="email">Эл. почта</label>
        <input class="profile-form__input mb-0" type="email" id="email"
            v-model="form.email">
        <JetInputError :message="form.error('email')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="phone">Номер телефона</label>
        <input class="profile-form__input mb-0" type="text"id="phone"
            v-model="form.phone">
        <JetInputError :message="form.error('phone')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="iin">ИИН</label>
        <input class="profile-form__input mb-0" type="text" id="iin"
            v-model="form.iin">
        <JetInputError :message="form.error('iin')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="password">Пароль</label>
        <input class="profile-form__input mb-0" type="password" v-model="form.password" id="password">
        <JetInputError :message="form.error('password')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="role" v-if="isAdmin">Роль</label>
        <select class="profile-form__select mb-0" v-if="isAdmin" v-model="form.role_id" id="role">
            <option v-for="role in roles"
                    :value="role.id">{{ role.name }}</option>
        </select>
        <JetInputError v-if="form.role_id === 1" :message="form.error('role_id')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="teamitem" v-if="isAdmin || isPartnersUser">
            Реферальный уровень
        </label>
        <select class="profile-form__select mb-0" v-if="isAdmin || isPartnersUser"
                v-model="form.referral_level_id" id="referral">
            <option v-for="referral in referral_level"
                    :value="referral.id">{{ referral.title }}</option>
        </select>
        <JetInputError v-if="isAdmin || isPartnersUser"
                       :message="form.error('referral_level_id')" class="mt-1"/>

        <div v-if="form.id">
            <label class="profile-form__label mt-3" for="item" v-if="isAdmin">Личные единицы</label>
            <input class="profile-form__input mb-0" type="number"
                   v-if="isAdmin" v-model="form.direct_points" id="item">
            <JetInputError v-if="isAdmin" :message="form.error('direct_points')" class="mt-1"/>

            <label class="profile-form__label mt-3" for="teamitem" v-if="isAdmin">Командные единицы</label>
            <input class="profile-form__input" type="number"
                   v-if="isAdmin" v-model="form.team_points" id="teamitem">
            <JetInputError v-if="isAdmin" :message="form.error('team_points')" class="mt-1"/>
        </div>

        <a class="profile-form__submit mt-3" type="submit" href="#"
           @click="submitForm"
           :class="{ 'opacity-25': form.processing }"
           :disabled="form.processing">
            Сохранить изменения
        </a>
    </form>
</template>

<script>

import HasUser from "@/Mixins/HasUser";

export default {
    name: "Form",
    components: {
        JetInputError: () => import('@/Jetstream/InputError'),
        JetActionMessage: () => import('@/Jetstream/ActionMessage'),
        Attachments: () => import('@/Shared/Attachments'),
    },
    mixins: [HasUser],
    props: {
        form: Object,
        roles: Array,
        referral_level: Array,
        isPartnersUser: Boolean
    },
    methods: {
        submitForm() {
            if (this.$refs.image) {
                this.$set(this.form, 'image', this.$refs.image.files[0]);
            }
            this.$emit('submit')
        },
    }
}
</script>
