<template>
  <form action="">
    <label class="profile-form__label">Титульное фото новости</label>
    <label class="profile-form__label label-photo" @click="selectNewPhoto">
      <img :src="form.image_path"
           v-show="form.image_path">
      <img :src="photoPreview" v-show="photoPreview">
      <span>Добавить фото</span>

      <img id="pcec" src="../../../../img/course-card-img.png"
           v-show="photoPreview == null && !form.image_path">
    </label>

    <input type="file"
           ref="image"
           @change="updatePhotoPreview"
           class="hidden">
    <JetInputError :message="form.error('image')" class="mt-1" />

    <label class="profile-form__label" for="name">
      Название новости
    </label>
    <input class="profile-form__input mb-0"
           type="text"
           id="name"
           placeholder="Введите название новости"
           v-model="form.title"
    >
    <JetInputError :message="form.error('title')" class="mt-1"/>

    <label class="profile-form__label" for="description">
      Описание новости
    </label>
    <textarea class="profile-form__textarea"
              id="description" cols="30" rows="6"
              v-model="form.content"
              placeholder="Введите описание новости" />
    <JetInputError :message="form.error('content')" class="mt-1"/>

    <label class="profile-form__label" for="date">Видео</label>
    <input class="profile-form__input"
           type="text"
           id="videourl"
           placeholder="Приложите ссылку на видео"
           v-model="form.video_url"
    >
    <JetInputError v-if="isAdmin" :message="form.error('video_url')" />

    <label class="profile-form__label" for="date">Дата</label>
    <input class="profile-form__input"
           type="date"
           v-model="form.created_at"
           id="date" placeholder="Укажите дату">
    <JetInputError :message="form.error('created_at')" class="mt-1"/>

    <a class="profile-form__submit" href="#"
       @click="submitForm"
       :class="{ 'opacity-25': form.processing }"
       :disabled="form.processing">
      Сохранить
    </a>
  </form>
</template>

<script>
import HasUser from "@/Mixins/HasUser";
export default {
  name: "Form",
  components: {
    JetInputError: () => import('@/Jetstream/InputError'),
    JetActionMessage: () => import('@/Jetstream/ActionMessage'),
  },
  mixins: [HasUser],
  props: {
    form: Object,
    article: Object
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
    },
  }
}
</script>
