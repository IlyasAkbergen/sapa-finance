<template>
  <main-layout>
    <template #header>
      Уведомления
    </template>

    <div class="main__content__sellings-wrapper">
      <div class="complaints mb-3">
        <div class="table-responsive">
          <table class="table">
            <thead>
            <tr>
              <th scope="col">Заголовок</th>
              <th scope="col">Содержание</th>
              <th scope="col">Дополнительная ссылка</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="message in messages.data"
                class="clickable"
                @click="() => messageClicked(message)">
              <td class="align-middle">
                <div class="w-50">
                  {{ message.title }}
                </div>
              </td>
              <td class="align-middle">
                <div class="w-50">
                  {{ message.content | truncate(100) }}
                </div>
              </td>
              <td class="align-middle">
                  <span class="ml-1">
                      <a :href="message.url" target="_blank">
                        {{ message.url | truncate(20)}}
                      </a>
                  </span>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
      <Pagination :prev_page_url="messages.prev_page_url"
                  :next_page_url="messages.next_page_url"
                  :current_page="messages.current_page"
                  :links="messages.links"
      />
    </div>
    <Modal :show="showModal"
           :closeable="true"
           @close="closeModal">
      <div class="main__content__agent-new-card"
           v-if="focusedMessage"
      >
        <p class="main__content__new-card__title">
          {{ focusedMessage.title }}
        </p>
        <p class="main__content__new-card__text">
          {{ focusedMessage.content }}
        </p>
        <div v-if="focusedMessage.url">
          <p class="profile-form__label">Дополнительная ссылка</p>
          <p class="main__content__new-card__text">
            <a :href="focusedMessage.url">
              {{ focusedMessage.url }}
            </a>
          </p>
        </div>
        <div class="d-flex" v-for="attachment in focusedMessage.attachments">
          <img src="../../../img/uploaded-file.png">
          <span class="ml-2 pt-2">{{ attachment.name | truncate(10) }}</span>
          <a :href="attachment.path" class="ml-2 pt-2" target="_blank">
            <Download/>
          </a>
        </div>
      </div>
    </Modal>
  </main-layout>
</template>

<script>
  export default {
    name: "Index",
    components: {
      Pagination: () => import('@/Shared/Pagination'),
      MainLayout: () => import('@/Layouts/MainLayout'),
      Download: () => import('@/assets/icons/Download'),
      Modal: () => import('@/Jetstream/Modal'),
    },
    props: {
      messages: Object
    },
    data() {
      return {
        focusedMessage: null,
        showModal: false
      }
    },
    methods: {
      messageClicked(message) {
        this.focusedMessage = message
        this.showModal = true
      },
      closeModal() {
        this.focusedMessage = null
        this.showModal = false
      },
      makeNewMessagesSeen() {
        if (this.messages.data.length > 0) {
          axios.post(route('make_seen').url(), {
            ids: this.messages.data.map(n => n.id),
            _method: 'POST'
          }).then(r => {
            console.log(r);
          })
        }
      },
    },
    created() {
      this.makeNewMessagesSeen()
    }
  }
</script>
<style scoped>
  .clickable:hover {
    background-color: rgba(132,132,132, 0.12);
  }
</style>
