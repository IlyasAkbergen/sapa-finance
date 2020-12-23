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
               @show="() => showLevelsModal(message.levels)"
               @delete="() => deleteClicked(message)"
      />
    </div>

    <Modal :show="formVisible"
           :rootClass="'js-add-notify'"
           @close="formVisible = false">
      <MessageForm :form="form"
                   @submit="submitForm" />
    </Modal>

    <Modal :show="usersModalVisible"
          :rootClass="'js-see-senders'"
          @close="usersModalVisible = false">
      <p>Список кому были отправлены уведомления</p>
      <ul>
        <li v-if="tempLevels.includes(0)">Клиентам</li>
        <li v-if="tempLevels.includes(1)">Агентам</li>
        <li v-if="tempLevels.includes(3)">Наставникам</li>
        <li v-if="tempLevels.includes(2)">Всем ФК</li>
        <li v-if="tempLevels.includes(5)">Уп. партнерам</li>
        <li v-if="tempLevels.includes(4)">Менторам</li>
      </ul>
    </Modal>

    <DeleteAcceptModal :show="deleteAcceptModalShow"
                       @close="cancelDelete"
                       @accepted="deleteMessage"/>
  </main-layout>
</template>

<script>
  import { uuid } from "vue-uuid";
  export default {
    name: "Index",
    components: {
      MainLayout: () => import('@/Layouts/MainLayout'),
      MessageItem: () => import('./MessageItem'),
      MessageForm: () => import('./Form'),
      Modal: () => import('@/Jetstream/Modal'),
			DeleteAcceptModal: () => import('@/Shared/DeleteAcceptModal')
    },
    props: {
      data: Object
    },
    data() {
      return {
        formVisible: false,
        form: this.$inertia.form({
          title: null,
          content: null,
          url: null,
          uuid: uuid.v1(),
          levels: []
        }, {
          bag: 'messageForm'
        }),
				deleteAcceptModalShow: false,
				itemToBeDeleted: null,
				usersModalVisible: false,
        tempLevels: []
      }
    },
    computed: {
      messages() {
        return this.data.data;
      }
    },
    methods: {
      showForm() {
        this.formVisible = true;
      },
			showLevelsModal(levels) {
			  this.usersModalVisible = true;
				this.tempLevels = levels;
      },
      submitForm() {
        this.form.post('/messages')
          .then(() => {
            if (this.form.recentlySuccessful) {
              this.formVisible = false;
            }
          })
      },
			deleteClicked(message) {
				this.itemToBeDeleted = message;
				this.deleteAcceptModalShow = true
			},
      deleteMessage() {
				if (this.itemToBeDeleted) {
					this.$inertia.delete(route('messages.destroy', this.itemToBeDeleted.id));
        }
      },
			cancelDelete() {
				this.deleteAcceptModalShow = false
				this.itemToBeDeleted = null
			},
    }
  }
</script>
