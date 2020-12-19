<template>
  <main-layout>
    <template #back-link>
      <a :href="route('partners-crud.index')"
         class="navbar-brand mb-0 pb-0">
        <img src="../../../img/back-arrow.png">
      </a>
    </template>

    <template #header>
      Профиль компании {{ partner.name }}
    </template>

    <h3>TODO</h3>
  </main-layout>
</template>

<script>
export default {
  name: "Profile",
  components: {
    MainLayout: () => import('@/Layouts/MainLayout')
  },
  props: {
    partner: Object
  }
}
</script>
