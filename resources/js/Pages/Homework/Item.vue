<template>
  <tr class="clickable">
    <th class="float-left" scope="row" @click.self="() => $emit('show')">
      <inertia-link :href="route('users.show', homework.user.id)">
        {{ homework.user.name }}
      </inertia-link>
    </th>
    <td class="align-middle" @click.stop="() => $emit('show')">
      {{ homework.lesson.title }}
    </td>
    <td class="float-right">
      <a class="osk__action osk__action--sky"
         v-if="homework.status !== 1"
         @click.prevent="accept"
         href="#">
        Принять
      </a>
      <a class="osk__action osk__action--red"
         v-if="homework.status !== 2"
         @click.prevent="reject"
         href="#">
        Отказать
      </a>
    </td>

    <td class="float-right" v-if="homework.status === 2" @click.stop="() => $emit('show')">
      <a class="osk__status osk__status--red">Отказано</a>
    </td>

    <td class="float-right" v-if="homework.status === 1" @click.stop="() => $emit('show')">
      <a class="osk__status osk__status--sky">Принято</a>
    </td>
  </tr>
</template>

<script>
export default {
  name: "Item",
  props: {
  	homework: Object
  },

  methods: {
  	accept() {
  		this.rate(100, 1)
    },
    reject() {
      this.rate(0, 2)
    },
    rate(score, status) {
			this.$inertia.post('/rate-homework', {
				'homework_id': this.homework.id,
				'score': score,
        'status': status
			})
    },
    messageClicked(message) {
      this.focusedMessage = message
      this.showModal = true
    },
    closeModal() {
      this.focusedMessage = null
      this.showModal = false
    },
  }
}
</script>

<style scoped>
  .clickable:hover {
    background-color: rgba(132,132,132, 0.12);
  }
</style>
