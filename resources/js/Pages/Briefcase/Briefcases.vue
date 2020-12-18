<template>
    <main-layout>
        <template #header>
            Портфели
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
            <BriefcaseCard v-for="briefcase in cumulatives"
                :briefcase="briefcase"
                :key="briefcase.id" />
        </div>
        <div class="main__content__agent-portfels-flex agent-portfels-2">
            <BriefcaseCard v-for="briefcase in oneTimes"
               :briefcase="briefcase"
               :key="briefcase.id" />
        </div>
        <div class="main__content__agent-program-success">
            <div class="main__content__program-success__left">
                <img src="" alt="">
            </div>
            <div class="main__content__program-success__right">
                <i class="fas fa-times fa-sm" aria-hidden="true"></i>
                <p class="main__content__program-success__right__title">Запрос успешно отправлен</p>
                <p class="main__content__program-success__right__text">Ожидайте ответа модератора</p>
            </div>
        </div>
    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import BriefcaseCard from '@/Shared/BriefcaseCard';
export default {
    name: 'Briefcases',
    props: {
        briefcases: Array
    },
    components: {
        MainLayout,
        BriefcaseCard
    },
    computed: {
        cumulatives () {
           return this.briefcases.filter(b => b.type_id == 1);
        },
        oneTimes() {
            return this.briefcases.filter(b => b.type_id == 2);
        }
    }
}
</script>