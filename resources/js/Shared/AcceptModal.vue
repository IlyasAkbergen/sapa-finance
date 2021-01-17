<template>
  <Modal :show="show"
         class="js-delete-course"
         @close="() => $emit('close')">
    <div class="js-delete-course">
      <div class="modal-body">
        <p>{{ text }}</p>
        <div class="modal-body__buttons">
          <a class="modal-body__button modal-body__button--blue"
             href="#"
             @click.prevent="$emit('accepted')"
          >
            Да
          </a>
          <a class="modal-body__button modal-body__button--green"
             href=""
             @click.prevent="$emit('close')">
            Нет
          </a>
        </div>
      </div>
    </div>
  </Modal>
</template>

<script>
  export default {
    name: "AcceptModal",
    props: ['show', 'text'],
    components: {
      Modal: () => import('@/Jetstream/Modal')
    }
  }
</script>
