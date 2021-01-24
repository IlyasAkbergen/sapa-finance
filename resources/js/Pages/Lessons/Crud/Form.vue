<template>
    <form class="scrollable">
        <div class="lesson-info">
            <p class="text-center">Данные урока</p>
            <input type="text"
               placeholder="Название урока"
               v-model="form.title"
            >

            <JetInputError :message="form.error('title')" />

            <input type="text"
               id="videourl"
               placeholder="Приложите ссылку на видео"
               v-model="form.video_url"
            >

            <JetInputError :message="form.error('video_url')" />

            <textarea id="lessondesc"
                      rows="5"
                      v-model="form.content"
                      placeholder="Описание урока"></textarea>

            <JetInputError :message="form.error('content')" />

            <Attachments
                :modelType="'lesson'"
                :modelId="form.id"
                :uuid="form.uuid"
                :slug="'lesson'"
                ref="lesson_attachments"
            />
        </div>
        <div class="lesson-homework">
            <p class="text-center">Домашнее задание</p>

            <Attachments
                    :modelType="'lesson'"
                    :modelId="form.id"
                    :uuid="form.uuid"
                    :slug="'homework'"
                    ref="homework_attachments"
            />

            <textarea name="hwdesc" id="hwdesc" cols="30"
                      v-model="form.homework_content"
                      rows="5" placeholder="Описание домашнего задания" />

            <JetInputError :message="form.error('homework_content')" />

            <input type="submit"
                   v-show="!form.processing"
                   @click.prevent="$emit('submit')"
                   value="Сохранить">
        </div>
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
}
</script>
