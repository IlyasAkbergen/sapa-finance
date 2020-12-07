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
          <li class="nav-item">
            <a href="#" class="nav-link">
              <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 22.5C13.6569 22.5 15 21.1569 15 19.5C15 19.4719 14.9996 19.4439 14.9988 19.416C14.9922 19.174 14.7823 18.998 14.5403 18.9953L9.47169 18.9378C9.22965 18.935 9.01585 19.1062 9.00379 19.348C9.00127 19.3983 9 19.449 9 19.5C9 21.1569 10.3431 22.5 12 22.5Z" fill="#92929E"/>
                <path d="M5 9C5 5.13401 8.13401 1.5 12 1.5C15.866 1.5 19 5.13401 19 9V11.4607C19 12.7578 19.5547 13.9931 20.5242 14.8549C21.5645 15.7796 20.9104 17.5 19.5185 17.5H4.48147C3.08955 17.5 2.43545 15.7796 3.47579 14.8549C4.4453 13.9931 5 12.7578 5 11.4607V9Z" fill="#92929E"/>
              </svg>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              {{ username }}
              <img src="" class="ml-2 mr-1" alt="">
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
        <slot></slot>
      </div>
    </div>
    <slot name="modals"></slot>
  </div>
</template>


<script>
  import JetApplicationMark from '@/Jetstream/ApplicationMark'
  import JetDropdown from '@/Jetstream/Dropdown'
  import JetDropdownLink from '@/Jetstream/DropdownLink'
  import JetNavLink from '@/Jetstream/NavLink'
  import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
  import Sidebar from '@/Shared/Sidebar'
  import FlashMessage from '@/Shared/FlashMessage'
  import HasUser from "@/Mixins/HasUser"

  export default {
    components: {
      JetApplicationMark,
      JetDropdown,
      JetDropdownLink,
      JetNavLink,
      JetResponsiveNavLink,
      Sidebar,
      FlashMessage
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
