<template>
  <main-layout>
    <template #header>
      Жалобы
    </template>
    <div class="main__content__sellings-wrapper">
      <div class="complaints mb-3">
        <div class="table-responsive">
          <table class="table">
            <thead>
            <tr>
              <th scope="col">Кто пожаловался</th>
              <th scope="col"></th>
              <th scope="col">На кого пожаловался</th>
              <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="complaint in data.data">
              <th class="align-middle" scope="row">
                {{ complaint.from_user.name }}
              </th>
              <td class="align-middle">
                <img src="../../../../img/complaint.png" alt="">
              </td>
              <td class="align-middle">
                {{ complaint.to_user.name }}
              </td>
              <td class="align-middle">
                <a class="complaints__link complaints__link--red float-right fc__report"
                   href="#"
                   @click.prevent="showPenaltyForm(complaint)"
                >
                  Оштрафовать
                </a>
                <a class="complaints__link complaints__link--sky float-right fc__change"
                   href="#"
                   @click.prevent="changeConsultant(complaint)"
                >
                  Изменить фк
                </a>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
      <Pagination :prev_page_url="data.prev_page_url"
                  :next_page_url="data.next_page_url"
                  :current_page="data.current_page"
                  :links="data.links"
      />
    </div>

    <Modal :show="penaltyFormVisible"
           @close="() => penaltyFormVisible = false"
    >
      <div class="modal-body" v-if="penaltyFormVisible">
        <p class="complaint__title">
          Укажите сумму штрафа для пользователя
          <inertia-link :href="route('users-crud.edit', penaltyForm.user.id)"> {{ penaltyForm.user.name }}
          </inertia-link>
        </p>
        <form>
          <label class="profile-form__label" for="units">Личные единицы</label>
          <input class="profile-form__input" type="text"
                 v-model="penaltyForm.direct_points"
                 id="units" placeholder="Введите личные единицы">

          <label class="profile-form__label" for="commandunits">Командные единицы</label>
          <input class="profile-form__input" type="text"
                 v-model="penaltyForm.team_points"
                 id="commandunits" placeholder="Введите командные единицы">

          <a class="profile-form__submit complaints__link--red p-2"
             href="#" @click.prevent="submitPenaltyForm">
            Оштрафовать
          </a>
        </form>
      </div>
    </Modal>

    <Modal :show="newConsultantFormVisible"
           :rootClass="'js-change-fc'"
           @close="() => newConsultantFormVisible = false">
      <div class="modal-body" v-if="newConsultantFormVisible">
        <p>Укажите нового финансового консультанта для пользователя
          <inertia-link :href="route('users-crud.edit', newConsultantForm.user_id)">
            {{ newConsultantForm.user.name }}
          </inertia-link>
        </p>
        <VueSlickCarousel v-bind="sliderSettings">
          <div v-for="consultant in consultants" class="mx-2">
            <a href="#" @click.prevent="() => setConsultant(consultant.id)">
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
  import VueSlickCarousel from 'vue-slick-carousel'

  export default {
    name: "Index",
    components: {
      MainLayout,
      Pagination: () => import('@/Shared/Pagination'),
      Modal: () => import('@/Jetstream/Modal'),
      VueSlickCarousel,
    },
    props: {
      data: Object,
      consultants: Array
    },
    data() {
      return {
        newConsultantFormVisible: false,
        newConsultantForm: this.$inertia.form({}, {
          preserveScroll: false
        }),
        penaltyFormVisible: false,
        penaltyForm: this.$inertia.form({}, {
          preserveScroll: false
        }),
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
    methods: {
      setConsultant(id) {
        axios.post('/change-referral', {...this.newConsultantForm, id})
          .then(() => this.newConsultantFormVisible = false)
      },

      hidePenaltyForm() {
        this.penaltyFormVisible = false
      },

      showPenaltyForm(complaint) {
        this.penaltyForm = this.$inertia.form(
          {
            direct_points: 0,
            team_points: 0,
            user_id: complaint.to_user.id,
            user: complaint.to_user
          }, {
            resetOnSuccess: true,
            preserveScroll: false,
            bag: 'penaltyForm',
          }
        )
        this.penaltyFormVisible = true
      },

      changeConsultant(complaint) {
        this.newConsultantForm = this.$inertia.form(
          {
            user_id: complaint.from_user.id,
            user: complaint.from_user,
          }, {
            resetOnSuccess: true,
            preserveScroll: false,
            bag: 'newConsultantForm',
          }
        )
        this.newConsultantFormVisible = true;
      },

      submitPenaltyForm() {
        if (this.penaltyForm) {
          axios.post('/penalty', {...this.penaltyForm})
            .then(() => this.hidePenaltyForm())
        }
      }
    }
  }
</script>
