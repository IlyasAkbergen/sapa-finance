<template>
  <div>
    <div class="avatar avatar-consultant">
      <div class="avatar__inner">
        <img class="avatar__img" :src="avatarPath"
             v-show="photoPreview == null && !form.image_path">
        <img class="avatar__img" :src="photoPreview" v-show="photoPreview">
      </div>
      <label for="consultant-avatar" class="avatar__link"
             @click.prevent="selectNewPhoto"
             style="margin-bottom: 0; cursor: pointer;">
        Добавить аватар
      </label>
      <input type="file"
             ref="image"
             id="consultant-avatar"
             @change="updatePhotoPreview"
             class="hidden">
      <JetInputError :message="form.error('image')" class="mt-1"/>
    </div>

    <div class="profile-form">
      <form action="">
        <label class="profile-form__label" for="username">
          ФИО
        </label>
        <input class="profile-form__input mb-0" type="text"
               v-model="form.name"
               id="username" placeholder="Введите ФИО">
        <JetInputError :message="form.error('name')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="email">Эл. почта</label>
        <input class="profile-form__input mb-0" type="email" id="email"
               v-model="form.email">
        <JetInputError :message="form.error('email')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="phone">Номер телефона</label>
        <input class="profile-form__input mb-0" type="text"id="phone"
               v-model="form.phone">
        <JetInputError :message="form.error('phone')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="iin">ИИН</label>
        <input class="profile-form__input mb-0" type="text" id="iin"
               v-model="form.iin">
        <JetInputError :message="form.error('iin')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="password">Пароль</label>
        <input class="profile-form__input mb-0" type="password"
               required
               v-model="form.password" id="password">
        <JetInputError :message="form.error('password')" class="mt-1"/>

        <label class="profile-form__label mt-2" for="desc">
          Описание
        </label>
        <textarea class="profile-form__textarea"
                  id="desc" cols="30" rows="10"
                  v-model="form.description"
                  placeholder="Введите описание" />
        <JetInputError :message="form.error('description')" class="mt-1"/>

        <a class="profile-form__submit" type="submit"
           href="#" @click.prevent="submitForm">
          Сохранить
        </a>
      </form>
    </div>
  </div>
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
  },
  computed: {
		avatarPath() {
			return this.form.profile_photo_path
				? this.form.profile_photo_path
				: '/images/avatar-empty.png';
		}
  }
}
</script>

<style scoped>

</style>