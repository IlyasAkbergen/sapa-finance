<template>
    <form>
        <label class="profile-form__label">Титульное фото</label>
        <label class="profile-form__label label-photo" @click="selectNewPhoto">
            <span>Изменить фото</span>
            <img :src="form.image_path" v-show="form.image_path">
            <img id="pcec" src="../../../img/course-card-img.png"
                 v-show="photoPreview == null && !form.image_path">
            <img :src="photoPreview" v-show="photoPreview">
        </label>

        <input type="file"
               ref="image"
               @change="updatePhotoPreview"
               class="hidden">

        <JetInputError :message="form.error('image')" class="mt-1"/>

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
            Цена
        </label>
        <input class="profile-form__input mb-0" type="text"
               id="pricewith"
               v-model="form.price_with_feedback"
               placeholder="Введите цену">
        <jet-input-error :message="form.error('price_with_feedback')" class="mt-1"/>

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

        <label class="profile-form__label mt-3 mb-0" for="video_url">
          Ссылка на видео
        </label>
        <textarea class="profile-form__textarea mb-0"
                  id="video_url" cols="30" rows="3"
                  v-model="form.video_url"
                  placeholder="Вставьте ссылку на видео"></textarea>

        <label class="profile-form__label">
            Документы для скачивания
        </label>

        <Attachments
                :model-type="'course'"
                :model-id="form.id"
                :uuid="form.uuid"
        />

        <jet-action-message :on="form.recentlySuccessful">
            <label class="profile-form__label text-green">
                <img src="../../../img/lesson-icon-passed.png">
                Сохранено
            </label>
        </jet-action-message>

        <a class="profile-form__submit" href="#"
           @click="submitForm"
           :class="{ 'opacity-25': form.processing }"
           :disabled="form.processing">
            Сохранить
        </a>
    </form>
</template>

<script>
    import {uuid} from "vue-uuid";

    export default {
        name: "Form",
        components: {
            JetInputError: () => import('@/Jetstream/InputError'),
            JetActionMessage: () => import('@/Jetstream/ActionMessage'),
            Attachments: () => import('@/Shared/Attachments'),
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

            deleteLesson(lesson) {
                this.lessonForm.delete(route('lessons-crud.destroy', lesson.id));
            }
        },
        computed: {
            nextLessonOrder() {
                return this.course.lessons.length > 0
                    ? Math.max.apply(Math, this.course.lessons.map((l) => l.order)) + 1
                    : 1;
            }
        }
    }
</script>
