<template>
  <main-layout>
    <template #header>
      Уведомления
    </template>

    <template #actions>
      <div class="actions">
        <a class="actions__link actions__link--green actions__add-notify"
           href="#"
          @click="showForm"
        >
          <span>Отправить новое уведомление</span>
        </a>
      </div>
    </template>

    <div class="osk">
      <MessageItem v-for="message in messages"
              :key="message.id"
              :message="message"
               @delete="deleteMessage(message)"
      />
    </div>
  </main-layout>
</template>

<script>
  import { uuid } from "vue-uuid";
  export default {
    name: "Index",
    components: {
      MainLayout: () => import('@/Layouts/MainLayout'),
      MessageItem: () => import('./MessageItem')
    },
    props: {
      data: Object
    },
    data() {
      return {
        formVisible: false,
        form: this.$inertia.form({
          text: null,
          content: null,
          url: null,
          uuid: uuid.v1(),
          levels: []
        }, {
          bag: 'messageForm'
        })
      }
    },
    computed: {
      messages() {
        return this.data.messages
      }
    },
    methods: {
      showForm() {
        this.formVisible = true;
      },
      submitForm() {
        this.form.post('/messages')
          .then(() => {
            if (this.form.recentlySuccessful) {
              this.formVisible = false;
            }
          })
      },
      deleteMessage(message) {
        this.form.delete('/messages/' + message.id);
      }
    }
  }
</script>
