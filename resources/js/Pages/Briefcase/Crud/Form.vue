<template>
  <form>
    <label class="profile-form__label">Титульное фото портфеля</label>
    <label class="profile-form__label label-photo" @click="selectNewPhoto">
      <span>Изменить фото</span>
      <img :src="form.image_path" v-show="form.image_path">
      <img id="pcec" src="../../../../img/course-card-img.png"
           v-show="photoPreview == null && !form.image_path">
      <img :src="photoPreview" v-show="photoPreview">
    </label>

    <input type="file"
           ref="image"
           @change="updatePhotoPreview"
           class="hidden">

    <JetInputError :message="form.error('image')" class="mt-1" />

    <label class="profile-form__label" for="name">
      Название портфеля
    </label>
    <input class="profile-form__input mb-0"
           type="text"
           id="name"
           placeholder="Введите название портфеля"
           v-model="form.title"
    >
    <JetInputError :message="form.error('title')" class="mt-1"/>

    <label class="profile-form__label mt-3" for="type">
      Тип портфеля
    </label>

    <select id="type"
            v-model="form.type_id"
            class="mb-0">
      <option v-for="type in types"
              :value="type.id"
              :key="type.id"
      >
        {{ type.title }}
      </option>
    </select>

    <JetInputError :message="form.error('type_id')" class="mt-1"/>

<!--    <div v-show="isCumulative">-->
<!--      <label class="profile-form__label mt-3"-->
<!--             for="monthly_payment">Размер ежемесячного взноса</label>-->

<!--      <input class="profile-form__input mb-0" type="number"-->
<!--             id="monthly_payment"-->
<!--             v-model="form.monthly_payment"-->
<!--             placeholder="Введите размер ежемесячного взноса">-->
<!--      <JetInputError :message="form.error('monthly_payment')" class="mt-1"/>-->
<!--    </div>-->

<!--    <label class="profile-form__label mt-3" for="duration">-->
<!--      Срок накопления-->
<!--    </label>-->

<!--    <input class="profile-form__input mb-0"-->
<!--           type="number"-->
<!--           v-model="form.duration"-->
<!--           id="duration" placeholder="Введите cрок накопления">-->

<!--    <JetInputError :message="form.error('duration')" class="mt-1"/>-->

<!--    <label class="profile-form__label mt-3" for="units">-->
<!--      Общая сумма договора-->
<!--    </label>-->

<!--    <input class="profile-form__input mb-0"-->
<!--           type="number"-->
<!--           v-model="form.sum"-->
<!--           id="units" placeholder="Введите общую сумму договора">-->

<!--    <JetInputError :message="form.error('sum')" class="mt-1"/>-->

<!--    <label class="profile-form__label mt-3"-->
<!--           for="commandunits">Доходность</label>-->

<!--    <input class="profile-form__input mb-0" type="number"-->
<!--           id="commandunits"-->
<!--           v-model="form.profit"-->
<!--           placeholder="Введите доходность">-->
<!--    <JetInputError :message="form.error('profit')" class="mt-1"/>-->


<!--    <label class="profile-form__label mt-3" for="comission">-->
<!--      Комиссия агента-->
<!--    </label>-->
<!--    <input class="profile-form__input mb-0" type="text"-->
<!--           id="comission"-->
<!--           v-model="form.direct_fee"-->
<!--           placeholder="Введите комиссионные агента">-->
<!--    <JetInputError :message="form.error('direct_fee')" class="mt-1"/>-->

<!--    <input class="profile-form__checkbox mt-2" type="checkbox"-->
<!--           v-model="form.awardable" id="online"-->
<!--           :checked="form.awardable"-->
<!--           true-value="1"-->
<!--           false-value="0">-->
<!--    <label class="profile-form__clabel mt-2">-->
<!--      Вознаграждается единицами-->
<!--    </label><br>-->

    <label class="profile-form__label mt-3" for="description">
      Описание
    </label>
    <textarea class="profile-form__textarea mb-0"
              id="description" cols="30" rows="6"
              v-model="form.description"
              placeholder="Введите полное описание"></textarea>

    <JetInputError :message="form.error('description')" class="mt-1"/>

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
    Attachments: () => import('@/Shared/Attachments'),
  },
  props: {
    form: Object,
    briefcase: Object,
    types: Array
  },
  data() {
    return {
      photoPreview: null,
    }
  },
  methods: {
    submitForm() {
      if (this.$refs.image) {
        this.$set(this.form, 'image', this.$refs.image.files[0]);
      }
      this.$emit('submit')
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
    }
  },
  computed: {
    isCumulative() {
      return this.form.type_id == 1;
    }
  }
}
</script>
