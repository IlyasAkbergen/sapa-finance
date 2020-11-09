<template>
  <div class="page">
    <div class="sidebar">
      <div class="sidebar__profile">
        <img class="sidebar__profile__client-ava"
             :src="$page.user.profile_photo_url"
             :alt="$page.user.name" >
        <p class="sidebar__profile__client-name">$page.user.name</p>
        <p class="sidebar__profile__client-post">Клиент</p>
        <div class="sidebar__profile__progress__header">
          <p class="sidebar__profile__progress__header__course">Текущий курс: Название ку...</p>
          <p class="sidebar__profile__progress__header__percent">60%</p>
        </div>
        <div class="progress">
          <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div class="sidebar__profile__agent">
          <img class="sidebar__profile__agent__ava"
               :src="$page.user.profile_photo_url"
               alt="">
          <p class="sidebar__profile__agent__name">Зарлыков Темирлан</p>
          <p class="sidebar__profile__agent__post">Мой агент</p>
        </div>
        <div class="sidebar__profile__dropdown">
          <img src="../../img/dropdown-arrow.png" alt="">
        </div>
      </div>
      <div class="sidebar__menu">
        <ul class="sidebar__menu__nav">
          <li class="sidebar__menu__nav__item">
            <a href="#" class="sidebar__menu__nav__link">
              <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.99976 3.78136C7.74114 3.78136 7.53102 3.99148 7.53102 4.25011C7.53102 4.50873 7.74114 4.71886 7.99976 4.71886C8.25838 4.71886 8.4685 4.50873 8.4685 4.25011C8.46847 3.99148 8.25835 3.78136 7.99976 3.78136Z"/>
                <path d="M8.62868 9.25793C8.43458 9.35496 8.21715 9.40624 7.99974 9.40624C7.7823 9.40624 7.56487 9.35496 7.37077 9.25793L2.81239 6.99435V9.87499C2.81239 10.0086 2.86914 10.1355 2.96895 10.2247C3.06004 10.3062 5.26378 12.2187 7.99974 12.2187C10.7357 12.2187 12.9394 10.3062 13.0305 10.2247C13.1303 10.1355 13.1871 10.0086 13.1871 9.87499V6.99435L8.62868 9.25793Z"/>
                <path d="M15.9753 15.3827L15.1965 13.0149C15.6696 12.7882 15.9995 12.3086 15.9995 11.7499C15.9995 11.1396 15.6065 10.6242 15.0621 10.43V5.00856L15.7404 4.66937C15.8993 4.58972 15.9995 4.42769 15.9995 4.25006C15.9995 4.07244 15.8993 3.91041 15.7404 3.83075L8.2094 0.0496431C8.07756 -0.0162629 7.92194 -0.0162629 7.79009 0.0496431L0.259093 3.83078C0.10025 3.91044 0 4.07247 0 4.2501C0 4.42772 0.10025 4.58975 0.259093 4.66941L7.79013 8.4193C7.85603 8.45227 7.92791 8.46873 7.99978 8.46873C8.07166 8.46873 8.14353 8.45227 8.20944 8.4193L14.1246 5.47731V10.43C13.5802 10.6242 13.1871 11.1396 13.1871 11.7499C13.1871 12.3086 13.5171 12.7882 13.9903 13.0149L13.2114 15.3827C13.1096 15.6852 13.3354 15.9997 13.6559 15.9997H15.5308C15.8514 15.9997 16.0771 15.6852 15.9753 15.3827ZM7.99978 5.65631C7.22438 5.65631 6.59357 5.02553 6.59357 4.2501C6.59357 3.47466 7.22435 2.84388 7.99978 2.84388C8.77518 2.84388 9.40599 3.47466 9.40599 4.2501C9.40599 5.02553 8.77518 5.65631 7.99978 5.65631Z"/>
              </svg>
              Курсы
            </a>
          </li>
          <li class="sidebar__menu__nav__item active">
            <a href="#" class="sidebar__menu__nav__link">
              <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0)">
                  <path d="M8.81312 5.54481L5.6875 4.44165V6.56253C5.6875 6.8214 5.89737 7.03128 6.15625 7.03128H12.4062C12.6651 7.03128 12.875 6.8214 12.875 6.56253V4.44165L9.74928 5.54487C9.59862 5.59806 9.44112 5.62503 9.28125 5.62503C9.12138 5.62503 8.96387 5.59806 8.81312 5.54481Z"/>
                  <path d="M3.81275 2.7858L9.12525 4.66081C9.17572 4.67862 9.2285 4.68752 9.28125 4.68752C9.334 4.68752 9.38678 4.67862 9.43725 4.66081L14.125 3.0063V4.84377C14.125 5.10265 14.3349 5.31252 14.5938 5.31252C14.8526 5.31252 15.0625 5.10265 15.0625 4.84377V2.34377C15.0625 2.14505 14.9372 1.9679 14.7498 1.90174L9.43725 0.0267422C9.33631 -0.00891406 9.22619 -0.00891406 9.12525 0.0267422L3.81275 1.90174C3.62534 1.9679 3.5 2.14505 3.5 2.34377C3.5 2.54249 3.62534 2.71965 3.81275 2.7858Z"/>
                  <path d="M14.2734 9.8204L12.5004 12.139C12.1456 12.6029 11.5949 12.875 11.0109 12.875H7.71875C7.45988 12.875 7.25 12.6652 7.25 12.4063C7.25 12.1474 7.45988 11.9375 7.71875 11.9375H10.5722C11.1854 11.9375 11.699 11.4356 11.6873 10.8224C11.6759 10.2282 11.1907 9.75002 10.5938 9.75002H7.3125C6.37041 8.84418 4.91659 8.73818 3.85306 9.49784L3.5 9.75002V15.0625H6.625H7.25H11.652C12.609 15.0625 13.5003 14.5759 14.0178 13.7709L15.8472 10.9252C15.9469 10.77 16 10.5894 16 10.4049C16 9.48471 14.8323 9.08943 14.2734 9.8204Z"/>
                  <path d="M2.09375 8.81252H0.46875C0.209875 8.81252 0 9.02239 0 9.28127V15.5313C0 15.7902 0.209875 16 0.46875 16H2.09375C2.35262 16 2.5625 15.7902 2.5625 15.5313V9.28127C2.5625 9.02239 2.35262 8.81252 2.09375 8.81252Z"/>
                </g>
                <defs>
                  <clipPath id="clip0">
                    <rect width="16" height="16"/>
                  </clipPath>
                </defs>
              </svg>
              Мои курсы
            </a>
          </li>
          <li class="sidebar__menu__nav__item">
            <a href="#" class="sidebar__menu__nav__link">
              <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.46116 3.14121C5.97503 3.5232 6.43411 4.13379 7.05236 4.13379H8.58949C9.20775 4.13379 9.66682 3.5232 9.18069 3.14121C8.90868 2.92747 8.5657 2.8 8.19293 2.8H7.44892C7.07615 2.8 6.73317 2.92747 6.46116 3.14121ZM11.4106 3.29854C11.5668 3.75502 11.9551 4.13379 12.4376 4.13379C13.4462 4.13379 14.297 4.88486 14.4221 5.88572L14.6262 7.51838C14.7497 8.506 14.1281 9.4341 13.1679 9.69598L12.4472 9.89254L8.8734 10.8672C8.57193 10.9494 8.26322 10.9957 7.95362 11.006C7.55558 11.0192 7.15605 10.9729 6.76846 10.8672L6.76843 10.8672L3.19464 9.89254L2.4739 9.69598C1.51367 9.4341 0.89213 8.506 1.01558 7.51838L1.21967 5.88572C1.34477 4.88486 2.19558 4.13379 3.20422 4.13379C3.68672 4.13379 4.07507 3.75499 4.23132 3.29848C4.68896 1.96134 5.95667 1 7.44892 1H8.19293C9.6852 1 10.9529 1.96136 11.4106 3.29854ZM2.07926 11.1431L6.37379 12.3144C7.32125 12.5728 8.32062 12.5728 9.26808 12.3144L13.5626 11.1431C13.8121 11.0751 14.0937 11.1739 14.1519 11.426C14.1854 11.5712 14.2031 11.7224 14.2031 11.8778V12.3454C14.2031 13.4499 13.3077 14.3454 12.2031 14.3454H3.43866C2.33409 14.3454 1.43866 13.4499 1.43866 12.3454V11.8778C1.43866 11.7224 1.45638 11.5712 1.4899 11.426C1.54811 11.1739 1.82969 11.0751 2.07926 11.1431Z"/>
              </svg>
              Портфели
            </a>
          </li>
          <li class="sidebar__menu__nav__item">
            <a href="#" class="sidebar__menu__nav__link">
              <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0)">
                  <path d="M14.2734 9.8204L12.5004 12.139C12.1456 12.6029 11.5949 12.875 11.0109 12.875H7.71875C7.45988 12.875 7.25 12.6652 7.25 12.4063C7.25 12.1474 7.45988 11.9375 7.71875 11.9375H10.5722C11.1854 11.9375 11.699 11.4356 11.6873 10.8224C11.6759 10.2282 11.1907 9.75002 10.5938 9.75002H7.3125C6.37041 8.84418 4.91659 8.73818 3.85306 9.49784L3.5 9.75002V15.0625H6.625H7.25H11.652C12.609 15.0625 13.5003 14.5759 14.0178 13.7709L15.8472 10.9252C15.9469 10.77 16 10.5894 16 10.4049C16 9.48471 14.8323 9.08943 14.2734 9.8204Z"/>
                  <path d="M2.09375 8.81252H0.46875C0.209875 8.81252 0 9.02239 0 9.28127V15.5313C0 15.7902 0.209875 16 0.46875 16H2.09375C2.35262 16 2.5625 15.7902 2.5625 15.5313V9.28127C2.5625 9.02239 2.35262 8.81252 2.09375 8.81252Z"/>
                  <path d="M13.375 3C13.03 3 12.75 2.70133 12.75 2.33333V1.33333H10.25V2.33333C10.25 2.70133 9.97 3 9.625 3C9.28 3 9 2.70133 9 2.33333V1.33333C9 0.598 9.56062 0 10.25 0H12.75C13.4394 0 14 0.598 14 1.33333V2.33333C14 2.70133 13.72 3 13.375 3Z"/>
                  <path d="M11.7663 5.44894C11.6988 5.47592 11.6013 5.49518 11.5 5.49518C11.3987 5.49518 11.3012 5.47592 11.2112 5.44123L7 4V6.94027C7 7.52601 7.46125 8 8.03125 8H14.9688C15.5387 8 16 7.52601 16 6.94027V4L11.7663 5.44894Z"/>
                  <path d="M16 1.91667V2.68L11.59 3.98667C11.56 3.99667 11.53 4 11.5 4C11.47 4 11.44 3.99667 11.41 3.98667L7 2.68V1.91667C7 1.41 7.46125 1 8.03125 1H14.9688C15.5387 1 16 1.41 16 1.91667Z"/>
                </g>
                <defs>
                  <clipPath id="clip0">
                    <rect width="16" height="16"/>
                  </clipPath>
                </defs>
              </svg>
              Мой портфель
            </a>
          </li>
          <li class="sidebar__menu__nav__item">
            <a href="#" class="sidebar__menu__nav__link">
              <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M8 14.6667C11.6819 14.6667 14.6667 11.6819 14.6667 8.00001C14.6667 4.31811 11.6819 1.33334 8 1.33334C4.3181 1.33334 1.33334 4.31811 1.33334 8.00001C1.33334 11.6819 4.3181 14.6667 8 14.6667ZM11.0601 5.20627C11.1406 5.03644 10.9636 4.85946 10.7937 4.93991L8.11255 6.20995C7.27767 6.60542 6.60541 7.27767 6.20994 8.11255L4.9399 10.7937C4.85945 10.9636 5.03643 11.1406 5.20626 11.0601L7.88746 9.79007C8.72234 9.3946 9.3946 8.72235 9.79007 7.88747L11.0601 5.20627Z"/>
              </svg>
              Новости
            </a>
          </li>
          <li class="sidebar__menu__nav__item">
            <a href="#" class="sidebar__menu__nav__link">
              <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0C3.58862 0 0 3.58862 0 8C0 12.4114 3.58862 16 8 16C12.4114 16 16 12.4114 16 8C16 3.58862 12.4114 0 8 0ZM8 12.6666C7.63196 12.6666 7.33337 12.368 7.33337 12C7.33337 11.632 7.63196 11.3334 8 11.3334C8.36804 11.3334 8.66663 11.632 8.66663 12C8.66663 12.368 8.36804 12.6666 8 12.6666ZM9.0553 8.42798C8.81934 8.53662 8.66663 8.77466 8.66663 9.03406V9.33337C8.66663 9.70129 8.36865 10 8 10C7.63135 10 7.33337 9.70129 7.33337 9.33337V9.03406C7.33337 8.25598 7.79065 7.54272 8.4967 7.21667C9.17603 6.90405 9.66663 6.07397 9.66663 5.66663C9.66663 4.74805 8.91931 4 8 4C7.08069 4 6.33337 4.74805 6.33337 5.66663C6.33337 6.03467 6.03528 6.33337 5.66663 6.33337C5.29797 6.33337 5 6.03467 5 5.66663C5 4.0127 6.34595 2.66663 8 2.66663C9.65405 2.66663 11 4.0127 11 5.66663C11 6.56738 10.2186 7.89136 9.0553 8.42798Z"/>
              </svg>
              Поддержка
            </a>
          </li>
          <li class="sidebar__menu__nav__item">
            <a href="#" class="sidebar__menu__nav__link">
              <svg width="16" height="16" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 15C9.10457 15 10 14.1046 10 13C10 12.8062 9.8313 12.6651 9.63751 12.6629L6.41586 12.6264C6.19581 12.6239 6 12.78 6 13C6 14.1046 6.89543 15 8 15Z"/>
                <path d="M3.33334 6C3.33334 3.42267 5.42267 1 8 1C10.5773 1 12.6667 3.42267 12.6667 6V7.64045C12.6667 8.50522 13.0365 9.32871 13.6828 9.90324C14.3764 10.5197 13.9403 11.6667 13.0124 11.6667H2.98765C2.0597 11.6667 1.62364 10.5197 2.3172 9.90324C2.96353 9.32871 3.33334 8.50522 3.33334 7.64045V6Z"/>
              </svg>
              Уведомления
            </a>
          </li>
        </ul>
        <a href="#" class="sidebar__menu__link">Стать агентом</a>
      </div>
    </div>

    <div class="main">
      <nav class="navbar sticky-top navbar-light bg-white">
        <span class="navbar-brand mb-0">Мои курсы</span>
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
              Хасен Таир
              <img class="ml-2 mr-1"
                   :src="$page.user.profile_photo_url"
                   alt="">
            </a>
            <div class="dropdown-menu">
              <a href="#" class="dropdown-item">Настройка профиля</a>
              <a href="#" class="dropdown-item">Поддержка</a>
              <a href="#" class="dropdown-item text-danger">Выйти</a>
            </div>
          </li>
        </ul>
      </nav>
      <!-- Page Content -->
      <main>
        <slot></slot>
      </main>
    </div>

    <nav class="navbar fixed-bottom navbar-light bg-white">
      <jet-dropdown align="right" width="48">
        <template #trigger>
          <button v-if="$page.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
            <img class="h-8 w-8 rounded-full object-cover"
                 :src="$page.user.profile_photo_url"
                 :alt="$page.user.name" />
          </button>

          <button v-else class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
            <div>{{ $page.user.name }}</div>

            <div class="ml-1">
              <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
              </svg>
            </div>
          </button>
        </template>

        <template #content>
          <!-- Account Management -->
          <div class="block px-4 py-2 text-xs text-gray-400">
            Manage Account
          </div>

          <jet-dropdown-link :href="route('profile.show')">
            Настройки профиля
          </jet-dropdown-link>

          <div class="border-t border-gray-100"></div>

          <!-- Authentication -->
          <form @submit.prevent="logout">
            <jet-dropdown-link as="button">
              <span class="text-danger">Выйти</span>
            </jet-dropdown-link>
          </form>
        </template>
      </jet-dropdown>
    </nav>
  </div>
</template>

<script>
  import JetApplicationMark from '@/Jetstream/ApplicationMark'
  import JetDropdown from '@/Jetstream/Dropdown'
  import JetDropdownLink from '@/Jetstream/DropdownLink'
  import JetNavLink from '@/Jetstream/NavLink'
  import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

  export default {
    components: {
      JetApplicationMark,
      JetDropdown,
      JetDropdownLink,
      JetNavLink,
      JetResponsiveNavLink,
    },

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
