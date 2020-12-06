<template>
  <div class="page">
    <sidebar />
    <nav class="navbar fixed-bottom navbar-light bg-white">
      <jet-dropdown align="right" width="48">
        <template #trigger>
          <button v-if="$page.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
            <img class="h-8 w-8 rounded-full object-cover"
                 :src="getUser().profile_photo_url"
                 :alt="getUser().name" />
          </button>

          <button v-else class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
            <div>{{ getUser().name }}</div>

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
  import Sidebar from '@/Shared/Sidebar'
  import HasUser from "@/Mixins/HasUser";
  export default {
    components: {
      JetApplicationMark,
      JetDropdown,
      JetDropdownLink,
      JetNavLink,
      JetResponsiveNavLink,
      Sidebar
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
