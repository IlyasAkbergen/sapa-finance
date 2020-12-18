<template>
  <div class="main__content__portfels-flex__card">
    <img :src="briefcase.image_path"
         class="main__content__portfels-flex__card__img">
    <a :href="route('briefcases.show', briefcase.id)"
       class="main__content__portfels-flex__card__title">
        {{ briefcase.title }}
    </a>
    <p class="main__content__portfels-flex__card__text">
       {{ briefcase.description | truncate(80) }}
    </p>
    <div v-if="briefcase.type_id == 1">
      <p class="main__content__portfels-flex__card__subtitle">Размер ежемесячного взноса</p>
      <p class="main__content__portfels-flex__card__digit">{{ briefcase.monthly_payment }} ₸</p>
    </div>
    <p class="main__content__portfels-flex__card__subtitle">Срок накопления</p>
    <p class="main__content__portfels-flex__card__digit">{{ briefcase.duration }} ₸</p>
    <p class="main__content__portfels-flex__card__subtitle">Общая сумма договора</p>
    <p class="main__content__portfels-flex__card__digit">{{ briefcase.sum }} ₸</p>
    <p class="main__content__portfels-flex__card__subtitle">Доходность</p>
    <p class="main__content__portfels-flex__card__digit">{{ briefcase.profit }} ₸</p>

    <a href="#" class="main__content__portfels-flex__card__button"
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
            return false;
        }
    }
}
</script>
