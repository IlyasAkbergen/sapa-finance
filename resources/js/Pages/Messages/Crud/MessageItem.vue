<template>
  <div class="table-responsive">
    <table class="table">
      <tbody>
      <tr>
        <th class="align-middle" scope="row">
          {{ message.title }}
        </th>
        <td class="align-middle">
          <a class="osk__action osk__action--blue actions__see-senders"
            href="#"
            @click.prevent="$emit('show')"
            v-if="message.levels"
          >
            Кому отправлены уведомления
          </a>
          <span v-else>
            Персональное
          </span>
        </td>
        <td class="align-middle">
          <span>
            <inertia-link :href="message.url" target="_blank">
              {{ message.url | truncate(20)}}
            </inertia-link>
          </span>
        </td>
        <td class="align-middle d-flex" v-for="attachment in message.attachments">
          <span>{{ attachment.name | truncate(10) }}</span>
          <a :href="attachment.path" target="_blank">
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
    return {

    }
  },
  methods: {
    deleteMessage() {

    }
  }
}
</script>
