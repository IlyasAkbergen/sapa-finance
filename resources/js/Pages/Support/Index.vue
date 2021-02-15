<template>
    <main-layout>
        <template #header>
            Поддержка
        </template>

        <div class="main__content__agent-support-form">
            <input type="file" id="support-file-input">
            <Attachments
                    :model-type="'support'"
                    :uuid="form.uuid"
                    :title="'Добавить фото или файл'"
                    :is-support="true"
            />
            <textarea name="message"
                      v-model="form.message"
                      placeholder="Напишите сообщение сюда">
            </textarea>
            <a @click="createSupport()" style="cursor: pointer">Отправить</a>
        </div>

        <div class="main__content__agent-support-notification">
            Если у вас есть какие либо затруднения с платформой, либо вы хотите подсказать какие-то улучшения, мы
            обязательно выслушаем вас.
        </div>
    </main-layout>
</template>

<script>
    import MainLayout from "@/Layouts/MainLayout";
    import Attachments from '@/Shared/Attachments';
    import {uuid} from 'vue-uuid'

    export default {
        name: "Index",
        components: {
            MainLayout,
            Attachments,
        },
        data() {
            return {
                form: this.$inertia.form({
                    message: '',
                    uuid: uuid.v1(),
                    '_method': 'POST',
                }, {
                    bag: 'partnerForm',
                    resetOnSuccess: true,
                })
            }
        },
        methods: {
            createSupport() {
                this.form.post(route('support.store'));
            }
        }
    }
</script>
