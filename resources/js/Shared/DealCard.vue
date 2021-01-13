<template>
  <div class="main__content__portfels-flex__card">
    <img :src="imagePath"
         class="main__content__portfels-flex__card__img">
    <inertia-link :href="route('briefcases.show', deal.briefcase.id)"
       class="main__content__portfels-flex__card__title">
        {{ deal.briefcase.title }}
    </inertia-link>
    <p class="main__content__portfels-flex__card__text">
       {{ deal.briefcase.description | truncate(80) }}
    </p>
    <p class="main__content__portfels-flex__card__subtitle">Номер договора</p>
    <p class="main__content__portfels-flex__card__digit">
      {{ deal.contract_number }}</p>
    <div v-if="deal.briefcase.type_id == 1">
      <p class="main__content__portfels-flex__card__subtitle">Размер ежемесячного взноса</p>
      <p class="main__content__portfels-flex__card__digit">{{ deal.monthly_payment }} ₸</p>
    </div>
    <p class="main__content__portfels-flex__card__subtitle">Срок накопления</p>
    <p class="main__content__portfels-flex__card__digit">{{ deal.duration }}</p>
    <p class="main__content__portfels-flex__card__subtitle">Общая сумма договора</p>
    <p class="main__content__portfels-flex__card__digit">{{ deal.sum }} ₸</p>
    <p class="main__content__portfels-flex__card__subtitle">Доходность</p>
    <p class="main__content__portfels-flex__card__digit">{{ deal.profit }} ₸</p>

  </div>
</template>

<script>
export default {
    name: "DealCard",
    props: {
      deal: Object
    },
    computed: {
        imagePath() {
        	return this.deal.briefcase.image_path
            ? this.deal.briefcase.image_path
            : 'images/course-card-img.png';
        }
    },
}
</script>
