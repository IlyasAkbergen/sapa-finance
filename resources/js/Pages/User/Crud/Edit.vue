<template>
  <main-layout>
    <template #back-link>
      <inertia-link :href="backRoute"
                    class="navbar-brand mb-0 pb-0">
        <img src="../../../../img/back-arrow.png">
      </inertia-link>
    </template>

    <template #header>
      Профиль пользователя {{ client.name }}
    </template>

    <b-tabs content-class="mt-3" align="center">
      <b-tab title="Основные данные">
        <div class="main__content__consultant-settings-flex">
          <div class="main__content__settings-flex__ava">
            <img class="avatar__img" :src="avatarPath"
                 v-show="photoPreview == null && !form.image_path">
            <img class="avatar__img" :src="photoPreview" v-show="photoPreview">
            <a class="avatar__link" href="" @click.prevent="selectNewPhoto">
              Изменить аватар
            </a>
            <input type="file"
                   ref="image"
                   @change="updatePhotoPreview"
                   class="hidden">
          </div>

          <div class="main__content__settings-flex__form">
            <Form :form="form"
                  :roles="roles"
                  :referral_level="referral_level"
                  :is-partners-user="!!partner_id"
                  :all_clients="all_clients"
                  @submit="updateUser"/>
          </div>

          <div class="main__content__settings-flex__right"
               v-if="client.id === getUser().id && getUser().referral_level_id">
            <div class="main__content__settings-flex__stats">
              <div class="main__content__settings-flex__stats__top">
                <div class="main__content__settings-flex__stats__top__item">
                  <p>Единицы</p>
                  <p>{{ balance.direct_points }}</p>
                </div>
                <div class="main__content__settings-flex__stats__top__item">
                  <p>Командные единицы</p>
                  <p>{{ balance.team_points }}</p>
                </div>
                <div class="main__content__settings-flex__stats__top__item"
                     v-if="next_level">
                  <p>{{ next_level.title }}</p>
                  <p>{{ client.next_level_progress }}%</p>
                </div>
              </div>
              <a href="#"
                 @click.prevent="showAboutPointsModal = true"
                 class="main__content__settings-flex__stats__button">
                Подробнее
              </a>
            </div>
            <div class="main__content__settings-flex__comission">
              <p class="main__content__settings-flex__comission__title">Комиссионные</p>
              <p class="main__content__settings-flex__comission__price">{{ balance.sum }} ₸</p>
              <a href="#"
                 @click.prevent="showSellsModal = true"
                 class="main__content__settings-flex__comission__btn-1">
                История продаж
              </a>
              <a href="#"
                 @click.prevent="showPayoutSumModal = true"
                 class="main__content__settings-flex__comission__btn-2">
                Вывести средства
              </a>
            </div>
            <div v-if="referrer" class="main__content__settings-flex__agent">
              <img src="../../../../img/profile-agent-ava.png"
                   class="avatar__img" style="width: 50px; height: 50px"
                   alt="">
              <p class="referrer_name">{{ referrer.name }}</p>
              <p class="referrer_title">Мой агент</p>
              <inertia-link class="avatar__link"
                            v-if="referrer"
                            :href="route('complaints.create', {
                                id: client.id,
                                referrer_id: referrer.id
                            })"
                            style="text-align: center">
                Оставить отзыв
              </inertia-link>
            </div>
          </div>
        </div>
      </b-tab>

      <b-tab title="Рефераллы" active v-if="isAdmin">
        <div :class="`panel panel-default  dotted-border mb-3
                ${isDraggedOver ? 'isDraggedOver' : ''}`"
             @drop.stop="(e) => drop(e)"
             @dragover.stop
             @dragenter.prevent
             @dragover.prevent
        >
          <div class="panel-heading border-bottom-1" role="tab"
               @dragenter="isDraggedOver = true"
               @dragleave="isDraggedOver = false"
          >
            <a data-v-46cb73ac="" id="6" role="button" data-toggle="collapse"
               href="#" aria-expanded="true"
               class="panel-title accordion-toggle collapsed panel-client">
              <div class="panel-heading-flex justify-content-center">
                <p class="panel-heading-flex__name text-center">
                  {{ client.name }}
                </p>
              </div>
            </a>
          </div>
        </div>
        <ReferralItem v-for="referral in referral_tree"
                      :referral="referral"
                      @change="(data) => referralTreeChanged(data)"
                      :key="referral.id" />

      </b-tab>
    </b-tabs>

    <AcceptModal :show="acceptModalShow"
                 :text="'Вы уверены?'"
                 @close="() => cancelReferralTreeChange()"
                 @accepted="() => submitReferralTreeChange()" />

    <div class="page__consultant-settings-program-modal" v-show="showSellsModal">
      <i class="fas fa-times fa-2x" @click="showSellsModal = false"></i>
      <div class="page__program-modal__body scrollable">
        <table class="table">
          <thead>
          <tr>
            <th>Имя покупателя</th>
            <th>Что продал</th>
            <th>Цена</th>
            <th>Комиссионные</th>
            <th>Единицы</th>
            <th>Ком. Единицы</th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="sale in sales">
              <th scope="row">
                <img class="photo" :src="sale.purchase.user.profile_photo_path" alt="">
                {{ sale.purchase.user.name }}
              </th>
              <td>
                {{ sale.purchase.purchasable.title }}
              </td>
              <td>{{ sale.purchase.sum | price }}</td>
              <td>{{ sale.sum | price | defaultValue(0) }}</td>
              <td>{{ sale.is_direct ? sale.points : 0 | defaultValue(0)}}</td>
              <td>{{ sale.is_direct ? 0 : sale.points | defaultValue(0) }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="page__consultant-settings-program-modal-2" v-show="showAboutPointsModal">
      <i class="fas fa-times fa-2x" @click="showAboutPointsModal = false"></i>
      <div class="page__program-modal__body">
        <p class="page__program-modal__body__text">
          <b>Единицы это:</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry.
        </p>
        <p class="page__program-modal__body__text">
          <b>Командные единицы это:</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry.
        </p>
        <p class="page__program-modal__body__text">
          <b>Чтобы стать «Финансовым консультантом (ФК)» необходимо:</b>
        </p>
        <ol>
          <li>ФК присваивается при сумме единиц 100 Е</li>
          <li>Сертификация</li>
          <li>Собранный КЕ будут добавляться, но не имеют отношения к карьерному росту.</li>
        </ol>
        <p class="page__program-modal__body__text">
          ФК вправе продавать и зарабатывать комиссионные вознаграждение от продажи образовательных продуктов и финансовых инструментов.
        </p>
        <a href="#"
           @click.prevent="showAboutPointsModal = false"
           class="page__program-modal__body__button">Понятно</a>
      </div>
    </div>

    <Modal :show="showPayoutSumModal"
           :closeable="true"
           @close="showPayoutSumModal = false">
      <form action="#">
        <label class="profile-form__label mt-3"
               for="monthly_payment">
          Сумма для вывода средств
        </label>

        <input class="profile-form__input mb-0" type="number"
               id="monthly_payment"
               v-model="payoutForm.sum"
               placeholder="Введите сумму для вывода средств">
        <JetInputError :message="payoutForm.error('sum')" class="mt-1"/>

        <a class="profile-form__submit mt-3 clickable"
           type="submit" href="#"
           @click.prevent="submitPayoutForm"
           :class="{ 'opacity-25': payoutForm.processing }"
           :disabled="payoutForm.processing">
          Сохранить
        </a>
      </form>
    </Modal>
  </main-layout>
</template>

<script>
  import MainLayout from '@/Layouts/MainLayout'
  import HasUser from "@/Mixins/HasUser";
  export default {
    name: "Edit",
    mixins: [HasUser],
    components: {
      Form: () => import('./Form'),
      MainLayout,
      ReferralItem: () => import('@/Shared/ReferralItem'),
      AcceptModal: () => import('@/Shared/AcceptModal'),
      Modal: () => import('@/Jetstream/Modal'),
      JetInputError: () => import('@/Jetstream/InputError'),
    },
    props: {
      client: Object,
      roles: Array,
      all_clients: {
        type: Array,
        default: null
      },
      client_referrer: {
        type: Object,
        default: null,
      },
      auth_user: {
        type: Object,
        default: null,
      },
      referral_level: {
        type: Array,
        default: null
      },
      partner_id: {
        type: Number,
        default: null
      },
      referral_tree: {
        type: Array,
        default: null
      },
      next_level: {
        type: Object,
        default: null
      }
    },
    data() {
      return {
        isDraggedOver: false,
        photoPreview: null,
        form: this.$inertia.form({
          ...this.client,
          ...{
            partner_id: this.partner_id,
            image: null,
            password: null,
            '_method': 'PUT',
          }
        }, {
          bag: 'userForm',
          resetOnSuccess: true,
        }),
        payoutForm: this.$inertia.form({
          sum: null,
          '_method': 'POST',
        }, {
          //bag: 'userForm',
          resetOnSuccess: true,
        }),
        acceptModalShow: false,
        referralChangeData: null,
        showAboutPointsModal: false,
        showSellsModal: false,
        showPayoutSumModal: false
      }
    },
    methods: {
      drop(e) {
        const child_id = e.dataTransfer.getData('child_id');
        const parent_id = this.client.id;

        if (child_id !== parent_id) {
          this.referralTreeChanged({
            child_id, parent_id
          });
        }
        this.isDraggedOver = false
      },
      updateUser() {
        if (this.$refs.image) {
          this.$set(this.form, 'image', this.$refs.image.files[0]);
        }
        console.log('is partner: ' + this.isPartner);
        console.log('route: ' + this.updateRouteName);
        this.form.post(this.updateRouteName + this.client.id);
      },
      selectNewPhoto() {
        this.$refs.image.click();
      },
      updatePhotoPreview() {
        const reader = new FileReader();

        reader.onload = (e) => {
          this.photoPreview = e.target.result;
        };

        reader.readAsDataURL(this.$refs.image.files[0]);
      },
      referralTreeChanged(data) {
        console.log(data);
        this.referralChangeData = {
          ...data,
          '_method': 'POST'
        };
        this.acceptModalShow = true;
        console.log(this.acceptModalShow)
      },
      submitReferralTreeChange() {
        this.$inertia.post(
          route('user-referrer-change', this.referralChangeData)
        ).then(() => this.cancelReferralTreeChange());
      },
      cancelReferralTreeChange() {
        this.referralChangeData = null;
        this.acceptModalShow = false;
      },
      submitPayoutForm() {
        this.payoutForm.post(route('payouts.store'));
      }
    },
    computed: {
      avatarPath() {
        return this.form.profile_photo_path
          ? this.form.profile_photo_path
          : '/images/avatar-empty.png';
      },
      updateRouteName() {
        if (this.isAdmin) {
          return window.location.pathname === '/users-crud/me'
            ? '/users-crud/update/'
            : '/users-crud/';
        } else if (this.isPartner) {
          return '/partner-users/'
        } else {
          return ''
        }
      },
      backRoute() {
        if (this.isAdmin) {
          return route('users-crud.index')
        } else if (this.isPartner) {
          return route('partner-users.index')
        } else {
          return route('')
        }
      },
      sales() {
        return this.client?.sales;
      }
    }
  }
</script>

<style scoped>
  .dotted-border {
    border: 3px dotted #dee2e6;
    background-color: rgba(2, 2, 2, 0.15) !important;
  }

  .photo {
    border-radius: 50%;
    width:50px;
    height: 50px;
    object-fit: cover;
  }

  .scrollable {
    margin: auto auto;
    z-index: 100;
    max-height: 80vh;
    overflow-y: scroll;
  }
</style>
