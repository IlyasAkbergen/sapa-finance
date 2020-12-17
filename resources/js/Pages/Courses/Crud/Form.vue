<template>
    <form>
        <label class="profile-form__label">Титульное фото программы</label>
        <label class="profile-form__label label-photo" @click="selectNewPhoto">
            <span>Изменить фото</span>
            <img :src="form.image_path" v-show="form.image_path">
            <img id="pcec" src="../../../../img/course-card-img.png"
                 v-show="photoPreview == null && !form.image_path">
            <img :src="photoPreview" v-show="photoPreview">
        </label>

        <input type="file"
               ref="image"
               @change="updatePhotoPreview"
               class="hidden">

        <JetInputError :message="form.error('photo')" class="mt-1" />

        <label class="profile-form__label" for="name">
            Название программы
        </label>
        <input class="profile-form__input mb-0"
               type="text"
               id="name"
               placeholder="Введите название программы"
               v-model="form.title"
        >
        <JetInputError :message="form.error('title')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="pricewith">
            Цена с обратной связью
        </label>
        <input class="profile-form__input mb-0" type="text"
               id="pricewith"
               v-model="form.price_with_feedback"
               placeholder="Введите цену">
        <jet-input-error :message="form.error('price_with_feedback')" class="mt-1" />

        <label class="profile-form__label mt-3" for="pricewithout">
            Цена без обратной связи
        </label>
        <input class="profile-form__input mb-0"
               type="text"
               id="pricewithout"
               v-model="form.price_without_feedback"
               placeholder="Введите цену">
        <jet-input-error :message="form.error('price_without_feedback')" class="mt-1" />

        <label class="profile-form__label mt-3 mb-0">
            Способоб проведения
        </label>
        <input class="profile-form__checkbox" type="checkbox"
               v-model="form.is_online" id="online"
               :checked="form.is_online"
               true-value="1"
               false-value="0">
        <label class="profile-form__clabel">
            Онлайн
        </label><br>

        <input class="profile-form__checkbox" type="checkbox"
               v-model="form.is_offline"
               :checked="form.is_offline"
               true-value="1"
               false-value="0">

        <label class="profile-form__clabel profile-form__clabel-2">
            Оффлайн
        </label>

        <JetInputError :message="form.error('is_online')" class="mt-1"/>
        <JetInputError :message="form.error('is_offline')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="units">Личные единицы</label>

        <input class="profile-form__input mb-0"
               type="text"
               v-model="form.direct_points"
               id="units" placeholder="Введите личные единицы">

        <JetInputError :message="form.error('direct_points')" class="mt-1"/>

        <label class="profile-form__label mt-3"
               for="commandunits">Командные единицы</label>

        <input class="profile-form__input mb-0" type="text"
               id="commandunits"
               v-model="form.team_points"
               placeholder="Введите командные единицы">
        <JetInputError :message="form.error('team_points')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="comission">
            Комиссия агента
        </label>
        <input class="profile-form__input mb-0" type="text"
               id="comission"
               v-model="form.direct_fee"
               placeholder="Введите комиссионные агента">
        <JetInputError :message="form.error('direct_fee')" class="mt-1"/>

        <label class="profile-form__label mt-3 mb-0" for="descriptionshort">
            Краткое описание
        </label>
        <textarea class="profile-form__textarea mb-0"
                  id="descriptionshort" cols="30" rows="3"
                  v-model="form.short_description"
                  placeholder="Введите короткое описание"></textarea>

        <JetInputError :message="form.error('short_description')" class="mt-1"/>

        <label class="profile-form__label mt-3" for="description">
            Полное описание
        </label>
        <textarea class="profile-form__textarea mb-0"
                  id="description" cols="30" rows="6"
                  v-model="form.description"
                  placeholder="Введите полное описание"></textarea>

        <JetInputError :message="form.error('description')" class="mt-1"/>

        <label class="profile-form__label">
            Документы для скачивания
        </label>

        <Attachments
                :model-type="'course'"
                :model-id="form.id"
                :uuid="form.uuid"
        />

        <div v-if="form.id">
            <label class="profile-form__label">Уроки</label>
            <div class="course-lessons-list">
                <LessonItem
                    v-for="lesson in course.lessons"
                    :lesson="lesson"
                    :key="lesson.id"
                    @edit="() => editLesson(lesson)"
                    @delete="() => deleteLesson(lesson)"
                />
            </div>

            <a class="course__lesson-link lesson__add lesson__add"
               href="#"
               @click="createLesson">
                Добавить урок
            </a>
        </div>
        
        <jet-action-message :on="form.recentlySuccessful">
            <label class="profile-form__label text-green">
                <img src="../../../../img/lesson-icon-passed.png">
                Сохранено
            </label>
        </jet-action-message>

        <a class="profile-form__submit" href="#"
           @click="submitForm"
           :class="{ 'opacity-25': form.processing }"
           :disabled="form.processing">
            Сохранить
        </a>

        <div class="modal-wrapper js-add-lesson"
             style="display: flex; justify-content: center; align-items: center;"
             :on="lessonFormVisible">
            <i class="fa fa-times fa-lg"></i>
            <div class="modal-body">
                <LessonForm @submit="submitLessonForm"
                            v-if="lessonFormVisible"
                            :form="lessonForm"/>
            </div>
        </div>

        <Modal :show="lessonFormVisible"
               @close="() => lessonFormVisible = false">
            <LessonForm @submit="submitLessonForm"
                                :form="lessonForm"/>
        </Modal>
    </form>
</template>

<script>

import { uuid } from "vue-uuid";

export default {
    name: "Form",
    components: {
        LessonItem: () => import('./LessonItem'),
        JetInputError: () => import('@/Jetstream/InputError'),
        JetActionMessage: () => import('@/Jetstream/ActionMessage'),
        Attachments: () => import('@/Shared/Attachments'),
        LessonForm: () => import('@/Pages/Lessons/Crud/Form'),
        Modal: () => import('@/Jetstream/Modal')
    },
    props: {
        form: Object,
        course: Object
    },
    data() {
        return {
            photoPreview: null,
            lessonForm: this.$inertia.form({}, {
                preserveScroll: false
            }),
            lessonFormVisible: false
        }
    },
    methods: {
        submitForm() {
            if (this.$refs.image) {
                this.$set(this.form, 'image', this.$refs.image.files[0]);
            }
            this.$emit('submit')
        },
        showLessonForm(value) {
            this.lessonFormVisible = value
        },
        selectNewPhoto() {
            this.$refs.image.click();
        },

        updatePhotoPreview() {
            const reader = new FileReader();

            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.image.files[0]);
        },

        createLesson() {
            this.lessonForm = this.$inertia.form(
                {
                    id: null,
                    uuid: uuid.v1(),
                    course_id: this.form.id,
                    title: null,
                    content: null,
                    video_url: null,
                    homework_content: null,
                    order: this.nextLessonOrder
                }, {
                    resetOnSuccess: true,
                    preserveScroll: false,
                    bag: 'lessonForm',
                }
            )
            this.showLessonForm(true)
        },

        editLesson(lesson) {
            this.lessonForm = this.$inertia.form(
                    {...lesson, uuid: null}, {
                    resetOnSuccess: true,
                    preserveScroll: false,
                    bag: 'lessonForm',
                }
            )
            this.showLessonForm(true)
        },

        submitLessonForm() {
            if (!this.lessonForm.id) {
                this.lessonForm.post('/lessons-crud')
                    .then(() => {
                        if (this.lessonForm.recentlySuccessful) {
                            this.showLessonForm(false);
                        }
                    });
            } else {
                this.lessonForm.put('/lessons-crud/' + this.lessonForm.id)
                    .then(() => {
                        if (this.lessonForm.recentlySuccessful) {
                            this.showLessonForm(false);
                        }
                    });
            }
        },

        deleteLesson (lesson) {
            this.lessonForm.delete(route('lessons-crud.destroy', lesson.id));
        }
    },
    computed: {
        nextLessonOrder() {
            return this.course.lessons.length > 0
                ? Math.max.apply(Math, this.course.lessons.map((l) => l.order )) + 1
                : 1;
        }
    }
}
</script>
