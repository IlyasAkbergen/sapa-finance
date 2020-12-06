<template>
    <inertia-link class="flex items-center group py-3" :href="route('contacts')">
        <div class="text-white">
            <slot></slot>
        </div>
    </inertia-link>
</template>

<script>
    export default {
        name: "SidebarItem",
        props: ['string'] 
    }
</script> 