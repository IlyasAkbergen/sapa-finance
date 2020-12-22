<template>
  <div class="table-responsive">
    <table class="table">
      <tbody>
      <tr>
        <th class="align-middle" scope="row">
          {{ message.text }}
        </th>
        <td class="align-middle">
          <a class="osk__action osk__action--blue actions__see-senders"
            href="#" @click="showUsers"
          >
            Кому отправлены уведомления
          </a>
        </td>
        <td class="align-middle">
          <img src="../../../../img/uploaded-file.png">
          <span>
            <a :href="message.url">
              {{ message.url | truncate(20)}}
            </a>
          </span>
        </td>
        <td class="align-middle" v-for="attachment in attachments">
          <img src="../../../../img/uploaded-file.png">
          <span>{{ attachment.name }}</span>
          <a :href="attachment.path">
            <Download />
          </a>
        </td>
        <td class="align-middle">
          <a class="osk__action osk__action--red" href="#"
            @click.prevent="$emit('delete')"
          >
            Удалить
          </a>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "MessageItem",
  components: {
    Download: () => import('@/assets/icons/Download')
  },
  props: {
    message: Object
  },
  data() {

  },
  methods: {
    showUsers() {

    },
    deleteMessage() {

    }
  }
}
</script>
