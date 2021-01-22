<template>
    <main-layout>
        <template #header>
            Продажи
        </template>
        <div class="main__content__sellings-wrapper">
            <div class="main__content__sellings-wrapper__sellings">
                <div class="main__content__sellings-wrapper__sellings__top">
<!--                    <ul class="main__content__sellings-wrapper__sellings__top__nav">-->
<!--                        <li class="main__content__sellings-wrapper__sellings__top__nav__item active">-->
<!--                            <a href="#" class="main__content__sellings-wrapper__sellings__top__nav__link">-->
<!--                                Sapa Academy-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li class="main__content__sellings-wrapper__sellings__top__nav__item">-->
<!--                            <a href="#" class="main__content__sellings-wrapper__sellings__top__nav__link">-->
<!--                                Sapa Market-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
                    <inertia-link :href="route('my-referrals')"
                       class="main__content__sellings-wrapper__sellings__top__button">
                        Посмотреть своих рефералов
                    </inertia-link>
                </div>
                <div class="main__content__sellings-wrapper__sellings__table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Имя покупателя</th>
                                <th>Что продал</th>
                                <th>Цена</th>
                                <th>Комиссионные</th>
                                <th>Единицы</th>
                                <th>Ком. Единицы</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="reward in rewards">
                                <th scope="row">
                                    <inertia-link :href="route('users.show', reward.purchase.user.id)">
                                      {{ reward.purchase.user.name }}
                                    </inertia-link>
                                </th>
                                <td>
                                    {{ reward.purchase.purchasable.title }}
                                </td>
                                <td>{{ reward.purchase.sum | price }}</td>
                                <td>{{ reward.sum | price }}</td>
                                <td>{{ reward.is_direct ? reward.points : 0 | defaultValue(0)}}</td>
                                <td>{{ reward.is_direct ? 0 : reward.points | defaultValue(0) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <Pagination
                    :prev_page_url="data.prev_page_url"
                    :next_page_url="data.next_page_url"
                    :current_page="data.current_page"
                    :links="data.links"/>
            <div class="clear"></div>
        </div>
    </main-layout>
</template>

<script>
export default {
    name: "Index",
    components: {
        MainLayout: () => import('@/Layouts/MainLayout'),
        Pagination: () => import('@/Shared/Pagination')
    },
    props: {
        data: Object
    },
    computed: {
        rewards() {
            return this.data.data;
        }
    }
}
</script>
