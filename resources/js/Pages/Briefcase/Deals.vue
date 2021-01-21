<template>
  <main-layout>
    <template #header>
      Мои программы
    </template>
    <ul class="main__content__agent-portfels-nav">
      <li class="main__content__portfels-nav__item"
          :class="showType == 1 ? 'active' : ''">
        <a href="#"
           @click.prevent="showType = 1"
           class="main__content__portfels-nav__link">
          Накопительные
        </a>
      </li>
      <li class="main__content__portfels-nav__item"
          :class="showType == 2 ? 'active' : ''">
        <a href="#"
           @click.prevent="showType = 2"
           class="main__content__portfels-nav__link">
          Разовые
        </a>
      </li>
    </ul>
    <div class="main__content__agent-portfels-flex"
      v-show="showType == 1"
    >
      <DealCard v-for="deal in cumulatives"
                :deal="deal"
                :key="deal.id"/>
    </div>
    <div class="main__content__agent-portfels-flex"
      v-show="showType == 2"
    >
      <DealCard v-for="deal in oneTimes"
                :deal="deal"
                :key="deal.id"/>
    </div>
    <div class="main__content__agent-empty-courses" v-if="!deals || deals.length == 0">
      <p class="main__content__empty-courses__text">У вас пока нет договоров</p>
      <inertia-link :href="route('briefcases.index')" class="main__content__empty-courses__button">
        Перейти к портфелям
      </inertia-link>
    </div>
  </main-layout>
</template>

<script>
  import MainLayout from '@/Layouts/MainLayout'
  import DealCard from '@/Shared/DealCard';

  export default {
    name: 'Deals',
    props: {
      deals: Array
    },
    data() {
      return {
        showType: 1
      }
    },
    components: {
      MainLayout,
      DealCard
    },
    computed: {
      cumulatives() {
        return this.deals.filter(d => d.briefcase.type_id == 1);
      },
      oneTimes() {
        return this.deals.filter(d => d.briefcase.type_id == 2);
      }
    }
  }
</script>
