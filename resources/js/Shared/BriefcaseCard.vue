<template>
  <div class="main__content__portfels-flex__card">
    <img src="" class="main__content__portfels-flex__card__img" alt="">
    <a :href="route('briefcases.show', briefcase.id)"
       class="main__content__portfels-flex__card__title">
        {{ briefcase.title }}
    </a>
    <p class="main__content__portfels-flex__card__text">
       {{ briefcase.description }}
    </p>
    <p class="main__content__portfels-flex__card__subtitle">Размер ежемесячного взноса</p>
    <p class="main__content__portfels-flex__card__digit">50 000 ₸</p>
    <p class="main__content__portfels-flex__card__subtitle">Срок накопления</p>
    <p class="main__content__portfels-flex__card__digit">50 000 ₸</p>
    <p class="main__content__portfels-flex__card__subtitle">Общая сумма договора</p>
    <p class="main__content__portfels-flex__card__digit">1 450 000 ₸</p>
    <p class="main__content__portfels-flex__card__subtitle">Доходность</p>
    <p class="main__content__portfels-flex__card__digit">1 450 000 ₸</p>
    <a href="#" class="main__content__portfels-flex__card__button" style="display: none;">Добавить программу</a>
    <a href="#" class="main__content__portfels-flex__card__button sent">Запрос отправлен</a>
  </div>
</template>

<script>
export default {
    name: "BriefcaseCard",
    props: {
      briefcase: Object
    }
}
</script>
