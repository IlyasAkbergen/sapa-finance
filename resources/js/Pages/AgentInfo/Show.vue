<template>
  <main-layout>
    <template #header>
      Стать агентом
      <div class="ml-5 float-right" v-if="isAdmin">
        <inertia-link class="ai__action ai__action--sky"
                      :href="route('agent-info.edit', 0)">
          Изменить информацию
        </inertia-link>
        <a class="ai__action ai__action--red clickable"
           v-if="agent_info"
           @click.prevent="() => $inertia.delete(route('agent-info.destroy', 0), { '__method': 'DELETE' })">
          Удалить
        </a>
      </div>
    </template>

    <div class="ag-info-empty" v-if="!agent_info">
      <div class="ag-info-empty__content">
        <p class="ag-info-empty__title">У вас пока нет информации об агентах</p>
        <inertia-link class="ag-info-empty__link"
                      :href="route('agent-info.create')">
          Добавить информацию
        </inertia-link>
      </div>
    </div>

    <div class="main__content__agent-card" v-if="agent_info">
      <p class="main__content__agent-card__title">{{ agent_info.title }}</p>
      <p class="card__text">
        {{ agent_info.short_description }}
      </p>
      <p class="card__text">
        {{ agent_info.description }}
      </p>
      <p class="main__content__agent-card__video-title">Видео</p>
      <div class="ai__video">
        <iframe class="w-100"
                height="300"
                :src="agent_info.video_url">
        </iframe>
      </div>

      <p class="main__content__agent-card__img-title">Фото</p>
      <img :src="imagePath"
           class="main__content__agent-card__img" alt="">
      <p class="main__content__agent-card__materials-title">Материалы</p>

      <div class="main__content__agent-card__materials">
        <Attachments
          :modelType="'course'"
          :modelId="agent_info.id"
          :uuid="null"
          :only-show="true"
        />
      </div>

      <div class="main__content__agent-card__bottom">
        <p class="main__content__agent-card__bottom__price">
          {{ agent_info.price_with_feedback | price() }}
        </p>
        <a href="#"
           v-if="!isAdmin"
           @click.prevent="buyClicked"
           class="main__content__agent-card__bottom__button">
          Купить агентский акканут
        </a>
      </div>
    </div>

    <template #modals>
      <div class="page__agent-modal" v-show="showModal">
        <i class="fas fa-times fa-2x"
           @click="() => showModal = false"/>
        <div class="page__agent-modal__body">
          <p class="page__agent-modal__body__title">
            Агентское соглашение
          </p>
          <p class="page__agent-modal__body__text">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
            the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
            of type and scrambled it to make a type specimen book. It has survived not only five centuries,
            but also the leap into electronic typesetting, remaining essentially unchanged.
          </p>
          <p class="page__agent-modal__body__text">
            It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum
            passages, and more recently with desktop publishing software like Aldus PageMaker including
            versions of Lorem Ipsum.
          </p>
          <input type="checkbox" id="page__agent-modal__body__checkbox"
                 v-model="agreementChecked"
          >
          <label for="page__agent-modal__body__checkbox">
            Принять соглашение
          </label><br>
          <button
             @click="submitPurchase"
             :class="`page__agent-modal__body__button ${agreementChecked && !createPurchaseForm.processing ? 'enabled' : ''}`">
            Купить
          </button>
        </div>
      </div>
    </template>

    <Modal :show="showReferrers"
           :closeable="true"
           @close="showReferrers = false"
    >
      <div class="modal-body" v-if="consultants && consultants.length > 0">
        <p class="page__program-modal__body__title">
          Прежде чем добавить накопительную программу выберите фининсового консультанта
        </p>
        <VueSlickCarousel v-bind="sliderSettings">
          <div v-for="consultant in consultants" class="mx-2">
            <a href="#" @click.prevent="() => setReferrer(consultant.id)">
              <img class="avatar__img"
                   :src="consultant.profile_photo_path
                      ? consultant.profile_photo_path
                      : '/images/consultant-avatar.png'"
              >
              <p class="main__content__news-flex__card__title">
                {{ consultant.name }}
              </p>
            </a>
          </div>
        </VueSlickCarousel>
      </div>
    </Modal>

  </main-layout>
</template>

<script>
  import MainLayout from '@/Layouts/MainLayout'
  import SidebarItem from "@/Shared/SidebarItem";
  import HasUser from "@/Mixins/HasUser";
  import VueSlickCarousel from 'vue-slick-carousel'

  export default {
    name: 'Agent',
    mixins: [HasUser],
    props: {
      agent_info: {
        type: Object,
        default: null
      },
      consultants: Array
    },
    components: {
      MainLayout,
      SidebarItem,
      Attachments: () => import('@/Shared/Attachments'),
      Modal: () => import('@/Jetstream/Modal'),
      VueSlickCarousel
    },
    data() {
      return {
        showModal: false,
        agreementChecked: false,
        showReferrers: false,
        createPurchaseForm: this.agent_info
          ? this.$inertia.form({
            purchasable_id: this.agent_info.id,
            purchasable_type: 'App\\Models\\Course',
            with_feedback: true,
            pay_online: true
          }) : null,
        sliderSettings: {
          swipeToSlide: true,
          "arrows": true,
          "dots": true,
          "infinite": true,
          "centerMode": true,
          "centerPadding": "20px",
          "slidesToShow": 1,
          "slidesToScroll": 1,
          "variableWidth": true
        },
      }
    },
    computed: {
      imagePath() {
        return this.agent_info.image_path
          ? this.agent_info.image_path
          : '/images/course-card-img.png'
      }
    },
    methods: {
      buyClicked() {
        if (!this.getUser().referrer_id) {
          this.showReferrers = true;
        } else {
          this.showModal = true;
        }
      },
      setReferrer(id) {
        this.$inertia.post(route('user-referrer-change'), {
          child_id: this.getUser().id,
          parent_id: id
        }).then(() => this.showReferrers = false)
      },
      submitPurchase() {
        this.createPurchaseForm.post(route('purchases.store'))
          .then(response => {
            if (!this.createPurchaseForm.hasErrors()) {
              window.location = response.redirect_url;
            }
          })
      }
    }
  }
</script>

<style scoped>
  /* ЙОБАНЫЕ ГОВНОСТИЛИ */
  .fa-times {
    top: 90px !important;
  }
  .slick-arrow {
    color: black !important;
  }
</style>
