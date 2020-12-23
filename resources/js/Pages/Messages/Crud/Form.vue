<template>
  <form action="">
    <input class="profile-form__input" type="text"
           v-model="form.title" id="title"
           placeholder="Название уведомления">
    <JetInputError :message="form.error('title')" class="mt-1"/>

    <textarea class="profile-form__textarea"
              id="desc" cols="50" rows="3"
              v-model="form.content"
              placeholder="Описание уведомления"></textarea>
    <JetInputError :message="form.error('content')" class="mt-1"/>

    <input class="profile-form__input" type="text"
           v-model="form.url" id="url"
           placeholder="Приложите дополнительную ссылку">
    <JetInputError :message="form.error('url')" class="mt-1"/>

    <label class="profile-form__label">
      Документы для скачивания
    </label>

    <Attachments
        :model-type="'message'"
        :model-id="form.id"
        :uuid="form.uuid"
    />

    <p class="notify__stitle">Отправить</p>
    <div class="notify__senders">
      <div>
        <input type="checkbox" name="client"
               id="client"
               :checked="form.levels.includes(0)"
               @change="(e) => levelSwitch(e,0)">
        <label for="client">Клиентам</label><br>

        <input type="checkbox"
               :checked="form.levels.includes(1)"
               @change="(e) => levelSwitch(e,1)"
               id="agent">
        <label for="agent">Агентам</label><br>

        <input type="checkbox"
               :checked="form.levels.includes(3)"
               @change="(e) => levelSwitch(e,3)"
               id="teacher">
        <label for="teacher">Наставникам</label>
      </div>
      <div>
        <input type="checkbox" id="fc"
               :checked="form.levels.includes(2)"
               @change="(e) => levelSwitch(e,2)">
        <label for="fc">Всем ФК</label><br>

        <input type="checkbox" id="partner"
               :checked="form.levels.includes(5)"
               @change="(e) => levelSwitch(e,5)">
        <label for="partner">Уп. партнерам</label><br>

        <input type="checkbox" id="mentor"
               :checked="form.levels.includes(4)"
               @change="(e) => levelSwitch(e,4)">
        <label for="mentor">Менторам</label>
      </div>
    </div>

    <a class="profile-form__submit" type="submit"
       href="#" @click.prevent="$emit('submit')">
      Отправить
    </a>
  </form>
</template>

<script>
export default {
  name: "Form",
  components: {
    Attachments: () => import('@/Shared/Attachments'),
		JetInputError: () => import('@/Jetstream/InputError'),
	},
  props: {
    form: Object
  },
  methods: {
  	levelSwitch(e, level_id) {
  		console.log(e);
  		if (e.target.checked) {
  		  this.form.levels.push(level_id)
  		} else {
				this.form.levels = this.form.levels.filter(
					l => l !== level_id
        )
      }
    }
  }
}
</script>
