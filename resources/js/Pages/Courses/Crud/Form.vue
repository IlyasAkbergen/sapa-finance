<template>
    <form>
        <label class="profile-form__label">Титульное фото программы</label>
        <label class="profile-form__label label-photo" for="photo3">
            <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.83333 5.83333C4.45262 5.83333 3.33333 6.95262 3.33333 8.33333C3.33333 9.71405 4.45262 10.8333 5.83333 10.8333C7.21405 10.8333 8.33333 9.71405 8.33333 8.33333C8.33333 6.95262 7.21405 5.83333 5.83333 5.83333ZM5 8.33333C5 7.8731 5.3731 7.5 5.83333 7.5C6.29357 7.5 6.66667 7.8731 6.66667 8.33333C6.66667 8.79357 6.29357 9.16667 5.83333 9.16667C5.3731 9.16667 5 8.79357 5 8.33333Z"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2.5 2.5C1.11929 2.5 0 3.61929 0 5V15C0 16.3807 1.11929 17.5 2.5 17.5H17.5C18.8807 17.5 20 16.3807 20 15V5C20 3.61929 18.8807 2.5 17.5 2.5H2.5ZM17.5 4.16667H2.5C2.03976 4.16667 1.66667 4.53976 1.66667 5V15C1.66667 15.4602 2.03976 15.8333 2.5 15.8333H6.09479L11.827 10.1011C12.8033 9.12482 14.3862 9.12482 15.3625 10.1011L18.3333 13.0719V5C18.3333 4.53976 17.9602 4.16667 17.5 4.16667ZM17.5 15.8333H8.45181L13.0055 11.2796C13.3309 10.9542 13.8586 10.9542 14.184 11.2796L18.2558 15.3514C18.1233 15.6361 17.8347 15.8333 17.5 15.8333Z"/>
            </svg>
            <span>Изменить фото</span>
            <img id="pcec" src="../../../../img/course-card-img.png" alt="">
        </label>

        <input type="file" name="photo3" id="photo3" style="display: none;">

        <label class="profile-form__label" for="name">
            Название программы
        </label>
        <input class="profile-form__input"
               type="text"
               id="name"
               placeholder="Введите название программы"
               v-model="form.title"
        >

        <label class="profile-form__label" for="pricewith">
            Цена с обратной связью
        </label>
        <input class="profile-form__input" type="text"
               id="pricewith"
               v-model="form.price_with_feedback"
               placeholder="Введите цену">

        <label class="profile-form__label" for="pricewithout">
            Цена без обратной связи
        </label>
        <input class="profile-form__input"
               type="text"
               id="pricewithout"
               v-model="form.price_without_feedback"
               placeholder="Введите цену">

        <label class="profile-form__clabel profile-form__clabel-2">Способ проведения</label>

        <label class="profile-form__label">Способ проведения</label>
        <input class="profile-form__checkbox" type="checkbox" name="online" id="online">

        <label class="profile-form__clabel">Способ проведения</label><br>
        <input class="profile-form__checkbox" type="checkbox" name="offline" id="offline">

        <label class="profile-form__label" for="units">Личные единицы</label>

        <input class="profile-form__input"
               type="text"
               id="units" placeholder="Введите личные единицы">
        <label class="profile-form__label" for="commandunits">Командные единицы</label>

        <input class="profile-form__input" type="text"
               id="commandunits"
               placeholder="Введите командные единицы">

        <label class="profile-form__label" for="comission">
            Комиссия агента
        </label>
        <input class="profile-form__input" type="text"
               id="comission" placeholder="Введите комиссионные агента">

        <label class="profile-form__label" for="descriptionshort">
            Краткое описание
        </label>
        <textarea class="profile-form__textarea"
                  id="descriptionshort" cols="30" rows="3"
                  v-model="form.short_description"
                  placeholder="Введите полное описание"></textarea>

        <label class="profile-form__label" for="description">
            Полное описание
        </label>
        <textarea class="profile-form__textarea"
                  id="description" cols="30" rows="6"
                  v-model="form.description"
                  placeholder="Введите полное описание"></textarea>

        <label class="profile-form__label">
            Документ для скачивания
        </label>
        <div class="course-docs-list course-docs-add">
        </div>

        <label class="profile-form__label label-doc">
            <img src="../../../../img/add_file.svg">
            <span>Приложите документ для скачивания</span>
        </label>
        <input type="file" name="coursedoc" id="courseadddoc"
               style="display: none;">

        <label class="profile-form__label">Уроки</label>
        <div class="course-lessons-list">
            <LessonItem
                v-for="lesson in form.lessons"
                :lesson="lesson"
                :key="lesson.id"
            />
        </div>

        <a class="course__lesson-link lesson__add lesson__add">
            Добавить урок
        </a>

        <a class="profile-form__submit" href="#"
           @click="$emit('submit')">
            Добавить программу
        </a>
    </form>
</template>

<script>
export default {
    name: "Form",
    props: {
        form: Object
    },
    components: {
        LessonItem: () => import('./LessonItem')
    }
}
</script>
