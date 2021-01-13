<template>
    <form>
        <label class="profile-form__label mt-3"
               for="sum">
            Сумма платежа
        </label>
        <input class="profile-form__input mb-0"
               type="number"
               id="sum"
               placeholder="Введите сумму"
               v-model="form.sum"
        >
        <JetInputError :message="form.error('sum')" class="mt-1"/>

        <label class="profile-form__label mt-3"
               for="paid_at">
            Дата оплаты
        </label>
        <input class="profile-form__input mb-0"
               type="date"
               id="paid_at"
               v-model="form.paid_at"
        >
        <JetInputError :message="form.error('paid_at')" class="mt-1"/>

        <a class="profile-form__submit mt-3" type="submit" href="#"
           @click="submitForm"
           :class="{ 'opacity-25': form.processing }"
           :disabled="form.processing">
            Сохранить
        </a>
    </form>
</template>

<script>
export default {
  name: "Form",
  components: {
    JetInputError: () => import('@/Jetstream/InputError'),
  },
  props: {
    form: Object
  },
  methods: {
    submitForm() {
      this.$emit('submit');
    }
  }
}
</script>

<style scoped>

</style>
