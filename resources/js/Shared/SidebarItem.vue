<template>
  <li :class="`sidebar__menu__nav__item ${route().current(route_name) ? 'active' : ''}`">
    <inertia-link class="sidebar__menu__nav__link d-flex align-items-center"
                  :href="route_url ? route_url : route(route_name)">
      <component :is="iconComponent"></component>
      <slot></slot>
    </inertia-link>
  </li>
</template>

<script>

  export default {
    props: {
      route_name: {
        type: String,
        default: null
      },
      route_url: {
        type: String,
        default: null
      },
      icon: {
        type: String
      }
    },
    computed: {
      iconComponent() {
        return () => import('@/assets/icons/' + this.icon + '.vue');
      }
    }
  }
</script>
