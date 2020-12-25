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

        <label class="profile-form__label mt-3" for="role" v-if="form.role_id === 1">Роль</label>
        <select class="profile-form__select mb-0" v-if="form.role_id === 1" v-model="form.role_id" id="role">
            <option v-for="role in roles"
                    :value="role.id">{{ role.name }}</option>
        </select>
        <JetInputError v-if="form.role_id === 1" :message="form.error('role_id')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="item" v-if="form.role_id === 1">Личные единицы</label>
        <input class="profile-form__input mb-0" type="number"
               v-if="form.role_id === 1" v-model="form.direct_points" id="item">
        <JetInputError v-if="form.role_id === 1" :message="form.error('direct_points')" class="mt-1"/>


        <label class="profile-form__label mt-3" for="teamitem" v-if="form.role_id === 1">Командные единицы</label>
        <input class="profile-form__input" type="number"
               v-if="form.role_id === 1" v-model="form.team_points" id="teamitem">
        <JetInputError v-if="form.role_id === 1" :message="form.error('team_points')" class="mt-1"/>

        <a class="profile-form__submit mt-3" type="submit" href="#"
           @click="submitForm"
           :class="{ 'opacity-25': form.processing }"
           :disabled="form.processing">
            Сохранить изменения
        </a>
    </form>
</template>

<script>

export default {
    name: "Form",
    components: {
        JetInputError: () => import('@/Jetstream/InputError'),
        JetActionMessage: () => import('@/Jetstream/ActionMessage'),
        Attachments: () => import('@/Shared/Attachments'),
    },
    props: {
        form: Object,
        user: Object,
        roles: Array
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
