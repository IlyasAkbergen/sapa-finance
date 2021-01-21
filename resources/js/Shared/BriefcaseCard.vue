<template>
  <div class="main__content__portfels-flex__card">
    <img :src="imagePath"
         class="main__content__portfels-flex__card__img">
    <inertia-link :href="route('briefcases.show', briefcase.id)"
                  class="main__content__portfels-flex__card__title">
      {{ briefcase.title }}
    </inertia-link>
    <p class="main__content__portfels-flex__card__text">
      {{ briefcase.description | truncate(80) }}
    </p>
    <a href="#" class="main__content__portfels-flex__card__button"
       @click.prevent="addBriefcase">
      Добавить программу
    </a>

    <Modal :show="showModal"
           :closeable="true"
           @close="closeModal">
      <form action="#" v-if="userBriefcaseForm">
        <div v-if="briefcase.type_id == 1">
          <label class="profile-form__label mt-3"
                 for="monthly_payment">
            Размер ежемесячного взноса
          </label>

          <input class="profile-form__input mb-0" type="number"
                 id="monthly_payment"
                 v-model="userBriefcaseForm.monthly_payment"
                 placeholder="Введите размер ежемесячного взноса">
          <JetInputError :message="userBriefcaseForm.error('monthly_payment')" class="mt-1"/>
        </div>

        <div v-if="briefcase.type_id == 2">
          <label class="profile-form__label mt-3"
                 for="sum">
            Общая сумма договора
          </label>

          <input class="profile-form__input mb-0" type="number"
                 id="sum"
                 v-model="userBriefcaseForm.sum"
                 placeholder="Введите общую сумму договора">
          <JetInputError :message="userBriefcaseForm.error('sum')" class="mt-1"/>
        </div>

        <label class="profile-form__label mt-3" for="duration">
          Срок накопления
        </label>

        <input class="profile-form__input mb-0"
               type="number"
               v-model="userBriefcaseForm.duration"
               id="duration" placeholder="Введите cрок накопления">

        <JetInputError :message="userBriefcaseForm.error('duration')" class="mt-1"/>

        <a class="profile-form__submit mt-3" type="submit" href="#"
           @click.prevent="submitForm"
           :class="{ 'opacity-25': userBriefcaseForm.processing }"
           :disabled="userBriefcaseForm.processing">
          Сохранить
        </a>
      </form>
    </Modal>
  </div>
</template>

<script>
  import toast from '@/toast'
  import HasUser from "@/Mixins/HasUser";
  export default {
    name: "BriefcaseCard",
    mixins: [HasUser],
    props: {
      briefcase: Object,
    },
    watch: {
      formSuccessfull(newValue) {
        if (newValue) {
          toast.success("Платеж сохранен.")
          this.closeModal()
        }
      }
    },
    components: {
      Modal: () => import('@/Jetstream/Modal'),
      JetInputError: () => import('@/Jetstream/InputError'),
    },
    data() {
      return {
        userBriefcaseForm: null,
        showModal: false,
      }
    },
    computed: {
      alreadyHave() {
        return this.briefcase.auth_user_pivot;
      },
      imagePath() {
        return this.briefcase.image_path
          ? this.briefcase.image_path
          : 'images/course-card-img.png';
      },
      formSuccessfull() {
        return this.userBriefcaseForm && this.userBriefcaseForm.recentlySuccessful;
      }
    },
    methods: {
      addBriefcase() {
        if (!this.referrer) {
          this.$emit('showReferrers')
          return;
        }
        this.userBriefcaseForm = this.$inertia.form({
          monthly_payment: null,
          sum: null,
          duration: null,
          briefcase_id: this.briefcase.id,
          type_id: this.briefcase.type_id,
          '_method': 'POST'
        }, {
          resetOnSuccess: true
        })
        this.showModal = true;
      },
      closeModal() {
        this.userBriefcaseForm = null;
        this.showModal = false;
      },
      submitForm() {
        this.userBriefcaseForm
          .post(route('attach_briefcase'));
      }
    }
  }
</script>
