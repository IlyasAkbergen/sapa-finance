<template>
    <div class="page">
        <div class="sidebar">
            <div class="sidebar__agent-profile">
                <img :src="avatarPath" class="sidebar__profile__client-ava" alt="">
                <p class="sidebar__profile__client-name">
                    {{ username }}
                </p>
                <p class="sidebar__profile__client-post">
                    {{ referralLevel != null ? referralLevel.title : "Клиент" }}
                </p>

                <ProfileStats />

            </div>

            <div class="sidebar__menu">
                <ul class="sidebar__menu__nav">
                    <SidebarItem
                            v-if="isAdmin"
                            :route_name="'users.index'"
                            icon="person-couple">
                        Пользователи
                    </SidebarItem>

                    <SidebarItem
                            v-if="isAdmin"
                            :route_name="'partners.index'"
                            icon="deal">
                        Партнеры
                    </SidebarItem>

                    <SidebarItem :route_name="isAdmin ? 'courses-crud.index' : 'courses.index'"
                                 icon="graduation">
                         Курсы
                    </SidebarItem>

                    <SidebarItem
                            v-if="isAdmin"
                            :route_name="'welcome'"
                            icon="mail-open">
                        ШФК
                    </SidebarItem>

                    <SidebarItem
                            v-if="!isAdmin"
                            :route_name="'my-courses'"
                            icon="my-graduation">
                        Мои курсы
                    </SidebarItem>

                    <SidebarItem :route_name="'briefcases.index'"
                                 icon="briefcase">
                        Портфели
                    </SidebarItem>

                    <SidebarItem
                            v-if="!isAdmin"
                            :route_name="'my-briefcases'"
                            icon="my-briefcase">
                        Мой портфель
                    </SidebarItem>


                    <SidebarItem
                            v-if="isAdmin"
                            :route_name="'welcome'"
                            icon="dislike">
                        Список жалоб
                    </SidebarItem>

                    <SidebarItem :route_name="'sales.index'"
                                 v-if="!isAdmin && hasSomeLevel(['Agent', 'Mentor', 'Tutor'])"
                                 icon="cart">
                        Продажи
                    </SidebarItem>

                    <SidebarItem :route_name="'articles.index'"
                                 icon="compass">
                        Новости
                    </SidebarItem>

                    <SidebarItem
                            v-if="!isAdmin"
                            :route_name="'support.index'"
                            icon="question">
                        Поддержка
                    </SidebarItem>

                    <SidebarItem
                            v-if="isAdmin"
                            :route_name="'welcome'"
                            icon="partner-service">
                        Услуги партнеров
                    </SidebarItem>

                    <SidebarItem
                            v-if="isAdmin"
                            :route_name="'welcome'"
                            icon="app-service">
                        Услуги на сайте
                    </SidebarItem>

                    <SidebarItem
                            v-if="isAdmin"
                            :route_name="'welcome'"
                            icon="conversation">
                        Консультанты на сайте
                    </SidebarItem>

                    <SidebarItem
                            v-if="isAdmin"
                            :route_name="'welcome'"
                            icon="info">
                        Информация об агентах
                    </SidebarItem>

                    <SidebarItem :route_name="'notifications.index'"
                                 icon="bell">
                        Увеодомления
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
