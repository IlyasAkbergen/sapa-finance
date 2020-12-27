<template>
  <div class="main__content__courses-flex__card">
    <div class="consultants__top">
      <img :src="avatarPath"
           class="main__content__courses-flex__card__img">
      <span>{{ consultant.name }}</span>
    </div>
    <div class="consultants__bottom">
      <inertia-link :href="route('user_complaints', consultant.id)"
         class="consultants__feedback">
        Отзывы
      </inertia-link>
      <inertia-link :href="route('consultants-crud.edit', consultant.id)"
         class="users__link users__link--blue">
        <Pencil />
      </inertia-link>
      <a class="users__link users__link--red consultant__delete"
        href="#" @click.prevent="$emit('delete')"
      >
        <Trash />
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: "Card",
  components: {
  	Pencil: () => import('@/assets/icons/Pencil'),
  	Trash: () => import('@/assets/icons/Trash')
  },
  props: {
  	consultant: Object
  },
  computed: {
  	avatarPath() {
  		return this.consultant.profile_photo_path
          ? this.consultant.profile_photo_path
          : '../images/consultant-avatar.png';
    }
  }
}
</script>

<style scoped>

</style>