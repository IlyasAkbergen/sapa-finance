<template>
    <main-layout>
        <template #header>
            Уведомления
        </template>
        <h3>Todo show notifications</h3>
    </main-layout>
</template>

<script>
  export default {
    name: "Index",
    components: {
      MainLayout: () => import('@/Layouts/MainLayout')
    }
  }
</script>
