<template>
    <form action="">

        <label class="profile-form__label mt-3" for="content">Отзыв</label>
        <textarea class="profile-form__input mb-0" type="text" id="content"
                  v-model="form.content" row="5"></textarea>
        <JetInputError :message="form.error('content')" class="mt-1"/>

        <a class="profile-form__submit mt-3" type="submit" href="#"
           @click="submitForm"
           :class="{ 'opacity-25': form.processing }"
           :disabled="form.processing">
            Оставить отзыв
        </a>
    </form>
</template>

<script>

export default {
    name: "Form",
    components: {
        JetInputError: () => import('@/Jetstream/InputError'),
        Attachments: () => import('@/Shared/Attachments'),
    },
    props: {
        form: Object,
    },
    methods: {
        submitForm() {
            this.$emit('submit')
        },
    }
}
</script>
