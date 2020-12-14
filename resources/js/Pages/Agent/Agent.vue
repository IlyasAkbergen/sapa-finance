<template>
    <main-layout>
        <template #header>
            Стать агентом
        </template>
        <div class="main__content">
            <div class="main__content__agent-card">
                <p class="main__content__agent-card__title">Информация о компании и работы агентом</p>
                <p class="main__content__agent-card__text">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                </p>
                <p class="main__content__agent-card__text">
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <p class="main__content__agent-card__video-title">Видео</p>
                <video controls class="main__content__agent-card__video">
<!--                    <source src="../video/Scratch Programming Lesson 1_ Intro [DBDROODrxD8].mp4" type="video/mp4">-->
<!--                    <source src="../video/Scratch Programming Lesson 1_ Intro [DBDROODrxD8].ogg" type="video/ogg">-->
                </video>
                <p class="main__content__agent-card__img-title">Фото</p>
                <img src="../../../img/agent-card-img.png" class="main__content__agent-card__img" alt="">
                <p class="main__content__agent-card__materials-title">Материалы</p>
                <div class="main__content__agent-card__materials">
                    <a href="#" class="main__content__agent-card__materials__pdf">PDF</a>
                    <a href="#" class="main__content__agent-card__materials__ppt">PPT</a>
                    <a href="#" class="main__content__agent-card__materials__word">Word</a>
                </div>
                <a href="#" class="main__content__agent-card__materials-button">Скачать материалы</a>
                <div class="main__content__agent-card__bottom">
                    <p class="main__content__agent-card__bottom__price">5 000 ₸</p>
                    <a href="#" class="main__content__agent-card__bottom__button">Купить агентский акканут</a>
                </div>
            </div>
        </div>
    </main-layout>
</template>

<script>
import MainLayout from '@/Layouts/MainLayout'
import BriefcaseCard from '@/Shared/BriefcaseCard';
import SidebarItem from "@/Shared/SidebarItem";
export default {
    name: 'Agent',
    props: {
        agent: Array
    },
    components: {
        MainLayout,
        SidebarItem
    },
    computed: {

    }
}
</script>
