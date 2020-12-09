<template>
    <main-layout>
        <template #back-link>
            <a :href="route('sales.index')" class="navbar-brand mb-0">
                <img src="../../../img/back-arrow.png" alt="">
            </a>
        </template>
        <template #header>
            Мои рефераллы
        </template>

        <div class="main__content__referals-top">
            <div class="main__content__referals-top__wrapper">
                <img class="blue" src="" alt="">
                <p class="blue-text">
                    Это агент которому ранее вы продали курс/программу, на данный момент он будучи агентом делает продажи, и эти продажи плюсуются вам в виде <b>КЕ</b>
                </p>
            </div>
            <p class="main__content__referals-top__measure">
                <b>Е</b> - Единицы
            </p>
            <p class="main__content__referals-top__measure">
                <b>КЕ</b> - Командные единицы
            </p>
        </div>
        <div class="main__content__referals-bottom">
            <div class="panel-group" id="filter-menu" role="tablist" aria-multiselectable="true">
                <ReferralItem v-for="referral in referrals"
                    :referral="referral"
                    :key="referral.id" />

            </div>
        </div>
    </main-layout>
</template>

<script>
export default {
    components: {
        MainLayout: () => import('@/layouts/MainLayout'),
        ReferralItem: () => import('@/Shared/ReferralItem')
    },
    props: {
        referrals: Array
    },

}
</script>