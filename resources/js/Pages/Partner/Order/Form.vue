<template>
  <form>
    <div>
      <label class="profile-form__label mt-3"
             for="contract_number">
        Номер договора
      </label>

      <input class="profile-form__input mb-0" type="text"
             id="contract_number"
             v-model="form.contract_number"
             placeholder="Введите размер ежемесячного взноса">
      <JetInputError :message="form.error('contract_number')" class="mt-1"/>
    </div>

    <div>
        <label class="profile-form__label mt-3"
               for="monthly_payment">Размер ежемесячного взноса</label>

        <input class="profile-form__input mb-0" type="number"
               id="monthly_payment"
               v-model="form.monthly_payment"
               placeholder="Введите размер ежемесячного взноса">
        <JetInputError :message="form.error('monthly_payment')" class="mt-1"/>
    </div>

    <label class="profile-form__label mt-3" for="duration">
        Срок накопления
    </label>

    <input class="profile-form__input mb-0"
           type="number"
           v-model="form.duration"
           id="duration" placeholder="Введите cрок накопления">

    <JetInputError :message="form.error('duration')" class="mt-1"/>

    <label class="profile-form__label mt-3" for="units">
        Общая сумма договора
    </label>

    <input class="profile-form__input mb-0"
           type="number"
           v-model="form.sum"
           id="units" placeholder="Введите общую сумму договора">

    <JetInputError :message="form.error('sum')" class="mt-1"/>

    <label class="profile-form__label mt-3"
           for="commandunits">Доходность</label>

    <input class="profile-form__input mb-0" type="number"
           id="commandunits"
           v-model="form.profit"
           placeholder="Введите доходность">
    <JetInputError :message="form.error('profit')" class="mt-1"/>

    <br>
    <br>

    <jet-action-message :on="form.recentlySuccessful">
      <label class="profile-form__label text-green">
        <img src="../../../../img/lesson-icon-passed.png">
        Сохранено
      </label>
    </jet-action-message>

    <a class="profile-form__submit" href="#"
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
			JetActionMessage: () => import('@/Jetstream/ActionMessage'),
		},
		props: {
			form: Object,
		},
		data() {
			return {

			}
		},
		methods: {
			submitForm() {
				if (this.$refs.image) {
					this.$set(this.form, 'image', this.$refs.image.files[0]);
				}
				this.$emit('submit')
			}
		}
	}
</script>
