<template>
  <div class="page">
    <sidebar />

    <div class="main">
      <nav class="navbar sticky-top navbar-light bg-white">
        <span class="navbar-brand mb-0 pb-0">
          <slot name="back-link"></slot>
          <slot name="header"></slot>
        </span>
        <ul class="nav ml-auto">

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

          <li class="nav-item dropdown" style="display: block; padding: .5rem 1rem;">
            <a class="icon-button dropdown-toggle-bell" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <BellIcon />
              <span class="icon-button__badge"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a v-for="notification in $page.notifications" class="dropdown-item" href="#">{{notification.title}}</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle d-flex"
               data-toggle="dropdown" role="button"
               aria-haspopup="true" aria-expanded="false">
              <span style="display: block; padding: .5rem 1rem;">{{ username }}</span>
              <img :src="avatarPath" class="ml-2 mr-1">
            </a>
            <div class="dropdown-menu">
              <a :href="route('me')" class="dropdown-item">Настройка профиля</a>
              <a :href="route('support.index')" class="dropdown-item">Поддержка</a>
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

      <slot name="modals"></slot>
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
  .dropdown-toggle::after {
      margin-top: 1rem;
  }

  .icon-button__badge {
      position: absolute;
      top: -3px;
      right: 0;
      width: 10px;
      height: 10px;
      background: red;
      color: #ffffff;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 50%;
  }

  .icon-button {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
  }
  .dropdown-toggle-bell {
      white-space: nowrap;
  }
  .dropdown-toggle-bell::after {
       display: inline-block;
       margin-left: .255em;
       vertical-align: .255em;
       border-top: .3em solid;
       border-right: .3em solid transparent;
       border-bottom: 0;
       border-left: .3em solid transparent;
    }
</style>
