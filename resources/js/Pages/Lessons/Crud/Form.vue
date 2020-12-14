<template>
    <form>
        <div class="lesson-info">
            <p class="text-center">Данные урока</p>
            <input type="text"
               placeholder="Название урока"
               v-model="form.title"
            >

            <input type="text"
               id="videourl"
               placeholder="Приложите ссылку на видео"
               v-model="form.video_url"
            >

            <textarea id="lessondesc"
                      cols="30" rows="5"
                      v-model="form.content"
                      placeholder="Описание урока"></textarea>

            <Attachments
                :modelType="'lesson'"
                :modelId="form.id"
                :uuid="form.uuid"
            />
        </div>
        <div class="lesson-homework">
            <p class="text-center">Домашнее задание</p>

            <Attachments
                    :modelType="'lesson'"
                    :modelId="form.id"
                    :uuid="form.uuid"
            />

            <textarea name="hwdesc" id="hwdesc" cols="30"
                      v-model="form.homework_content"
                      rows="5" placeholder="Описание домашнего задания" />
            <input type="submit"
                   @click.prevent="$emit('submit')"
                   value="Сохранить">
        </div>
    </form>
</template>

<script>
export default {
    name: "Form",
    components: {
        Attachments: () => import('@/Shared/Attachments')
    },
    props: {
        form: Object
    },

}
</script>
