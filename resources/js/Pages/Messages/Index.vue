<template>
    <main-layout>
        <template #header>
            Уведомления
        </template>

    </main-layout>
</template>

<script>
export default {
    name: "Index",
    components: {
        MainLayout: () => import('@/Layouts/MainLayout')
    },
    props: {
        messages: Array
    }
}
</script>
