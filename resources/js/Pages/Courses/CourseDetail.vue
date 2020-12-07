<template>
  <main-layout>
    <template #back-link>
      <a :href="route('courses.index')" class="navbar-brand mb-0">
        <img src="../../../img/back-arrow.png" alt="">
      </a>
    </template>

    <template #header>
      {{ course.title }}
    </template>

    <div class="main__content__course-card">
      <img src="../../../img/course-card-img.png"
           class="main__content__course-card__img" alt="">
      <p class="main__content__course-card__title">
        {{ course.title }}
      </p>
      <p class="main__content__course-card__text">
        {{ course.short_description }}
      </p>
      <p class="main__content__course-card__text">
        {{ course.description }}
      </p>
      <div class="main__content__course-card__bottom">
        <p class="main__content__course-card__bottom__price">
          {{ course.price_without_feedback }} ₸
        </p>
        <a href="#" @click="showModal = true" class="main__content__course-card__bottom__button">
          Купить курс
        </a>
      </div>
    </div>
    <template #modals>
      <div class="page__agent-course-modal" v-show="showModal">
        <i class="fas fa-times fa-2x" @click="showModal = false"></i>
        <div class="page__course-modal__body">
          <ul class="page__course-modal__body__nav">
            <li class="page__course-modal__body__nav__item">
              <a href="#"
                 class="page__course-modal__body__nav__link"
                 @click="createPurchaseForm.with_feedback = true">
                Курсы с обратной связью
                <img src="../../../img/modal-arrow.png" alt="">
              </a>
            </li>
            <li class="page__course-modal__body__nav__item">
              <a href="#"
                 class="page__course-modal__body__nav__link"
                 @click="createPurchaseForm.with_feedback = false">
                Курсы без обратной связи
                <img src="../../../img/modal-arrow.png" alt="">
              </a>
            </li>
          </ul>
          <ul class="page__course-modal__body__nav-2">
            <li class="page__course-modal__body__nav__item">
              <a href="#"
                 class="page__course-modal__body__nav__link"
                 @click="createPurchaseForm.pay_online = true; submitPurchase()">
                Оплатить онлайн
                <img src="../../../img/modal-arrow.png" alt="">
              </a>
            </li>
            <li class="page__course-modal__body__nav__item">
              <a href="#"
                 class="page__course-modal__body__nav__link"
                 @click="createPurchaseForm.with_feedback = false; submitPurchase()">
                Оплатить в кассе Sapa
                <img src="../../../img/modal-arrow.png" alt="">
              </a>
            </li>
          </ul>
        </div>
      </div>
    </template>
  </main-layout>
</template>

<script>
  import MainLayout from "@/Layouts/MainLayout";
  import Button from "@/Jetstream/Button";

  export default {
    name: "CourseDetail",
    components: {
      Button,
      MainLayout
    },

    props: {
      course: Object,
    },

    data() {
      return {
        showModal: false,
        createPurchaseForm: this.$inertia.form({
          purchasable_id: this.course.id,
          purchasable_type: 'App\\Models\\Course',
          with_feedback: false,
          pay_online: false
        })
      }
    },

    methods: {
      submitPurchase() {
        this.createPurchaseForm.post(route('purchases.store'))
          .then(response => {
            if (! this.createPurchaseForm.hasErrors()) {
              window.location = response.redirect_url;
            }
          })
      }
    }
  }
</script>
