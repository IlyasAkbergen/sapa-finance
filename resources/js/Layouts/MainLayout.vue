<template>
  <div class="page">
    <sidebar />

    <div class="main">
      <nav class="navbar sticky-top navbar-light bg-white">
        <span class="navbar-brand mb-0">
          <slot name="back-link"></slot>
          <slot name="header"></slot>
        </span>
        <ul class="nav">

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-bars sidebar-toggler"></i>
            </a>
          </li>

          <li class="nav-item add-client"
              v-if="hasSomeLevel([
                'agent', 'consultant', 'mentor', 'tutor', 'partner'
              ])">
            <a href="#" class="nav-link">
              <p>Добавить клиента&nbsp;&nbsp;<i class="fas fa-user-plus"></i></p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <BellIcon />
            </a>
          </li>

          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle d-flex"
               data-toggle="dropdown" role="button"
               aria-haspopup="true" aria-expanded="false">
              {{ username }}
              <img src="" class="ml-2 mr-1">
            </a>
            <div class="dropdown-menu">
              <a href="#" class="dropdown-item">Настройка профиля</a>
              <a href="#" class="dropdown-item">Поддержка</a>
              <a href="#"
                 class="dropdown-item text-danger"
                 @click.prevent="logout">
                Выйти
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <div class="main__content">
        <slot name="actions"></slot>
        <slot></slot>
        <Message />
      </div>
      <!-- Modal Portal -->
      <portal-target name="modal" multiple>
      </portal-target>
    </div>

  </div>
</template>


<script>
  import JetApplicationMark from '@/Jetstream/ApplicationMark'
  import JetDropdown from '@/Jetstream/Dropdown'
  import JetDropdownLink from '@/Jetstream/DropdownLink'
  import JetNavLink from '@/Jetstream/NavLink'
  import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
  import Sidebar from '@/Shared/Sidebar'
  import Message from '@/Shared/Message'
  import HasUser from "@/Mixins/HasUser"
  import InteractsWithErrorBags from "@/Mixins/InteractsWithErrorBags"
  import BellIcon from "@/assets/icons/Bell"

  export default {
    components: {
      JetApplicationMark,
      JetDropdown,
      JetDropdownLink,
      JetNavLink,
      JetResponsiveNavLink,
      Sidebar,
      Message,
      BellIcon
    },

    mixins: [HasUser, InteractsWithErrorBags],

    data() {
      return {
        showingNavigationDropdown: false,
				modalShow: false
      }
    },

    methods: {
      logout() {
        axios.post(route('logout').url()).then(response => {
          window.location = '/';
        })
      },
    }
  }
</script>

<style scoped>
  .add-client {
    display: block !important;
  }
</style>