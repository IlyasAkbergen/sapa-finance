<template>
    <div class="page">
        <div class="sidebar">
            <div class="sidebar__agent-profile">
                <img :src="avatarPath" class="sidebar__profile__client-ava">
                <p class="sidebar__profile__client-name">
                    {{ username }}
                </p>
                <p class="sidebar__profile__client-post">
                    {{ userTitle }}
                </p>

                <ProfileStats v-if="!isAdmin"/>

            </div>

            <div class="sidebar__menu" v-if="!isPartner">
                <ul class="sidebar__menu__nav">
                    <SidebarItem
                            v-if="isAdmin"
                            :route_name="'users-crud.index'"
                            icon="PersonCouple">
                        Пользователи
                    </SidebarItem>

                    <SidebarItem
                            v-if="isAdmin"
                            :route_name="'partners-crud.index'"
                            icon="Deal">
                        Партнеры
                    </SidebarItem>

                    <SidebarItem :route_name="isAdmin ? 'courses-crud.index' : 'courses.index'"
                                 icon="Graduation">
                        Курсы
                    </SidebarItem>

                    <SidebarItem
                            v-if="!isAdmin"
                            :route_name="'my-courses'"
                            icon="MyGraduation">
                        Мои курсы
                    </SidebarItem>

                    <SidebarItem
                            :route_name="'homeworks.index'"
                            v-if="isAdmin"
                            icon="MailOpen">
                        ДЗ
                    </SidebarItem>

                    <SidebarItem :route_name="!isAdmin
                            ? 'briefcases.index'
                            : 'briefcases-admin.index'"
                                 icon="PartnerService">
                        Портфели
                    </SidebarItem>

                    <SidebarItem
                            v-if="isAdmin"
                            v-for="(route,index) in adminRouteList"
                            :key="index"
                            :route_name="route.url"
                            :icon="route.icon">
                        {{route.name}}
                    </SidebarItem>

                    <SidebarItem
                            v-if="!isAdmin"
                            :route_name="'my-briefcases'"
                            icon="MyBriefcase">
                        Мой портфель
                    </SidebarItem>

                    <SidebarItem
                            v-if="isAdmin"
                            :route_name="'complaints.index'"
                            icon="Dislike">
                        Список жалоб
                    </SidebarItem>

                    <SidebarItem
                            v-if="!isAdmin"
                            :route_name="'payments.my'"
                            icon="Deal">
                        Платежи
                    </SidebarItem>

                    <SidebarItem :route_name="'sales.index'"
                                 v-if="!isAdmin && hasSomeLevel(['Agent', 'Consultant', 'Mentor', 'Tutor'])"
                                 icon="Cart">
                        Продажи
                    </SidebarItem>

                    <SidebarItem :route_name="'articles.index'"
                                 icon="Compass">
                        Новости
                    </SidebarItem>

                    <SidebarItem
                            v-if="!isAdmin"
                            :route_name="'support.index'"
                            icon="Question">
                        Поддержка
                    </SidebarItem>

                    <!--                    <SidebarItem-->
                    <!--                            v-if="isAdmin"-->
                    <!--                            :route_name="'welcome'"-->
                    <!--                            icon="AppService">-->
                    <!--                        Услуги на сайте-->
                    <!--                    </SidebarItem>-->

                    <SidebarItem
                            v-if="isAdmin"
                            :route_name="'consultants-crud.index'"
                            icon="Conversation">
                        Консультанты на сайте
                    </SidebarItem>
                    <SidebarItem
                            v-if="isAdmin"
                            :route_name="'supports.index'"
                            icon="Info">
                        Список запросов на поддержку
                    </SidebarItem>

                    <!--                    <SidebarItem-->
                    <!--                            v-if="isAdmin"-->
                    <!--                            :route_name="'welcome'"-->
                    <!--                            icon="Info">-->
                    <!--                        Информация об агентах-->
                    <!--                    </SidebarItem>-->

                    <SidebarItem
                            v-if="isAdmin"
                            :route_name="'messages.index'"
                            icon="Bell">
                        Уведомления
                    </SidebarItem>
                    <SidebarItem
                            v-if="!isAdmin"
                            :route_name="'my_notify'"
                            icon="Bell">
                        Уведомления
                    </SidebarItem>
                    <inertia-link v-if="canBecomeAgent"
                                  :href="route('starter_lesson')"
                                  class="sidebar__menu__link mt-4">
                        Стать агентом
                    </inertia-link>
                </ul>
            </div>
            <div class="sidebar__menu" v-if="isPartner">
                <ul class="sidebar__menu__nav">
                    <SidebarItem
                            v-for="(route, index) in partnerRouteList"
                            :key="index"
                            :route_name="route.url"
                            :icon="route.icon">
                        {{route.name}}
                    </SidebarItem>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    import SidebarItem from '@/Shared/SidebarItem'
    import ProfileStats from '@/Shared/ProfileStats'
    import HasUser from "@/Mixins/HasUser";

    export default {
        name: "Sidebar",
        components: {
            SidebarItem,
            ProfileStats
        },

        mixins: [HasUser],

        data() {
            return {
                showingNavigationDropdown: false,
                adminRouteList: [
                    {
                        url: 'admin.briefcase-orders',
                        name: 'Заявки на программы',
                        icon: 'Question',
                    },
                    {
                        url: 'partner-users.deals',
                        name: 'Договоры',
                        icon: 'Deal',
                    },
                ],
                partnerRouteList: [
                    {
                        url: 'partner-cabinet.index',
                        name: 'Личный кабинет',
                        icon: 'PersonCouple',
                    },
                    {
                        url: 'programs-crud.index',
                        name: 'Программы',
                        icon: 'Graduation',
                    },
                    // {
                    // 	url: 'partner-users.index',
                    // 	name: 'Пользователи',
                    // 	icon: 'PersonCouple',
                    // },
                    {
                        url: 'partner-users.deals',
                        name: 'Договоры',
                        icon: 'Deal',
                    },
                    // {
                    // 	url: 'partner-users.payments',
                    // 	name: 'Платежи',
                    // 	icon: 'Cart',
                    // }
                    // {
                    //   url: 'partner-requests',
                    //   name: 'Заявки',
                    //   icon: '',
                    // },
                    // {
                    //   url: 'partner-month-pay',
                    //   name: 'Еж. оплаты',
                    //   icon: '',
                    // },
                    // {
                    //   url: 'partner-stats',
                    //   name: 'Статистика продаж',
                    //   icon: '',
                    // }
                ]
            }
        },

        computed: {
            canBecomeAgent() {
                return !this.isAdmin && (
                    this.getUser().referral_level_id === null
                    || this.getUser().referral_level_id === 0
                );
            },
            userTitle() {
                if (this.isPartner) return 'Партнер';

                if (this.isAdmin) return 'Админ';

                return this.referralLevel != null
                    ? this.referralLevel.title
                    : "Клиент"
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                axios.post(route('logout').url()).then(response => {
                    window.location = '/';
                })
            },
        }
    }
</script>
