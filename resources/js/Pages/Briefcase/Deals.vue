<template>
    <main-layout>
        <template #header>
            Мои программы
        </template>
        <ul class="main__content__agent-portfels-nav">
            <li class="main__content__portfels-nav__item
                main__content__portfels-nav__item-1 active">
                <a href="#" class="main__content__portfels-nav__link">
                    Накопительные
                </a>
            </li>
            <li class="main__content__portfels-nav__item
                main__content__portfels-nav__item-2">
                <a href="#"
                   class="main__content__portfels-nav__link">
                    Разовые
                </a>
            </li>
        </ul>
        <div class="main__content__agent-portfels-flex agent-portfels-1">
            <DealCard v-for="deal in cumulatives"
                :deal="deal"
                :key="deal.id" />
        </div>
        <div class="main__content__agent-portfels-flex agent-portfels-2">
            <DealCard v-for="deal in oneTimes"
               :deal="deal"
               :key="deal.id" />
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
    components: {
        MainLayout,
        DealCard
    },
    computed: {
        cumulatives () {
           return this.deals.filter(d => d.briefcase.type_id == 1);
        },
        oneTimes() {
            return this.deals.filter(d => d.briefcase.type_id == 2);
        }
    }
}
</script>
