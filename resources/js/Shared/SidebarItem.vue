<template>
    <li :class="`sidebar__menu__nav__item ${route().current(route_name) ? 'active' : ''}`">
        <inertia-link class="sidebar__menu__nav__link" :href="route(route_name)">
            <img :src="iconPath" class="mr-3" />
            <slot></slot>
        </inertia-link>
    </li>
</template>

<script>
    export default {
        name: "SidebarItem",
        props: {
            route_name: {
                type: String,
                default: '#'
            },
            icon: {
                type: String
            }
        },
        computed: {
            iconPath() {
                return require('../../svg/sidebar-menu-icon-' + this.icon + '.svg')
            }
        }
    }
</script> 