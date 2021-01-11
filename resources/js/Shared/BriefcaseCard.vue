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
<!--    <div v-if="briefcase.type_id == 1">-->
<!--      <p class="main__content__portfels-flex__card__subtitle">Размер ежемесячного взноса</p>-->
<!--      <p class="main__content__portfels-flex__card__digit">{{ briefcase.monthly_payment }} ₸</p>-->
<!--    </div>-->
<!--    <p class="main__content__portfels-flex__card__subtitle">Срок накопления</p>-->
<!--    <p class="main__content__portfels-flex__card__digit">{{ briefcase.duration }} ₸</p>-->
<!--    <p class="main__content__portfels-flex__card__subtitle">Общая сумма договора</p>-->
<!--    <p class="main__content__portfels-flex__card__digit">{{ briefcase.sum }} ₸</p>-->
<!--    <p class="main__content__portfels-flex__card__subtitle">Доходность</p>-->
<!--    <p class="main__content__portfels-flex__card__digit">{{ briefcase.profit }} ₸</p>-->

    <a href="#" class="main__content__portfels-flex__card__button"
       @click.prevent="addBriefcase"
       v-show="!alreadyHave">
      Добавить программу
    </a>
    <a href="#" class="main__content__portfels-flex__card__button sent"
       v-show="alreadyHave">
      Запрос отправлен
    </a>
  </div>
</template>

<script>
export default {
    name: "BriefcaseCard",
    props: {
      briefcase: Object
    },
    computed: {
        alreadyHave() {
            return this.briefcase.auth_user_pivot;
        },
        imagePath() {
        	return this.briefcase.image_path
            ? this.briefcase.image_path
            : 'images/course-card-img.png';
        }
    },
    methods: {
    	addBriefcase() {
    		this.$inertia.get(route('attach_briefcase', this.briefcase.id));
      }
    }
}
</script>
