<template>
  <form action="">
    <label class="profile-form__label"
           for="partnername">Название компании</label>
    <input class="profile-form__input mb-0"
           type="text"
           id="partnername"
           v-model="form.name">
    <JetInputError :message="form.error('name')" class="mt-1"/>

    <label class="profile-form__label mt-3" for="bin">БИН компании</label>
    <input class="profile-form__input mb-0" type="text" id="bin"
           v-model="form.bin">
    <JetInputError :message="form.error('bin')" class="mt-1"/>

    <label class="profile-form__label mt-3" for="email">Эл. почта</label>
    <input class="profile-form__input mb-0" type="email" id="email"
           v-model="form.email">
    <JetInputError :message="form.error('email')" class="mt-1"/>

    <label class="profile-form__label mt-3" for="phone">Номер телефона</label>
    <input class="profile-form__input mb-0" type="text" id="phone"
           v-model="form.phone">
    <JetInputError :message="form.error('phone')" class="mt-1"/>

    <label class="profile-form__label mt-3" for="password">Пароль</label>
    <input class="profile-form__input mb-0" type="password" v-model="form.password" id="password">
    <JetInputError :message="form.error('password')" class="mt-1"/>

    <div v-if="isAdmin">
      <label class="profile-form__label mt-3" for="email_verified">Email активирован</label>
      <input class="profile-form__checkbox mb-0" type="checkbox"
             v-model="form.email_verified_at"
             :checked="form.email_verified_at"
             id="email_verified">
      <label class="profile-form__clabel profile-form__clabel-2">
        Да
      </label>
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
    mixins: [HasUser],
    components: {
      JetInputError: () => import('@/Jetstream/InputError'),
      JetActionMessage: () => import('@/Jetstream/ActionMessage'),
      Attachments: () => import('@/Shared/Attachments'),
    },
    props: {
      form: Object,
      partner: Object,
    },
    methods: {
      submitForm() {
        this.$emit('submit')
      },
    }
  }
</script>
