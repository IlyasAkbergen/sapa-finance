<template>
    <main-layout>
        <template #header>
            Поддержка
        </template>

        <div class="main__content__agent-support-form">
            <input type="file" id="support-file-input">
            <label for="support-file-input">
                <i class="fas fa-plus" aria-hidden="true"></i>
                Добавить фото или файл
            </label>
            <textarea name="message"
                      placeholder="Напишите сообщение сюда">
            </textarea>
            <a href="#">Отправить</a>
        </div>

        <div class="main__content__agent-support-notification">
            Если у вас есть какие либо затруднения с платформой, либо вы хотите подсказать какие-то улучшения, мы обязательно выслушаем вас.
        </div>
    </main-layout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout";

export default {
  // todo realize
  name: "Index",
  components: {
    MainLayout
  }
}


</script>