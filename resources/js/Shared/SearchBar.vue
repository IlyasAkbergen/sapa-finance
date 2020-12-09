<template>
    <form>
        <input class="actions__search"
               type="text" name="search"
               @input="handleInput"
               @keydown.enter.prevent="submit"
               :placeholder="placeholder">
        <a href="#" type="submit" @click="submit">
            <img src="../../img/search.svg" alt="">
        </a>
    </form>
</template>

<script>
export default {
    name: "SearchBar",
    props: {
        value: {},
        placeholder: {
            type: String,
            default: "Поиск"
        }
    },
    data() {
        return {
            content: this.value
        }
    },
    methods: {
        handleInput (e) {
            this.$emit('input', e.target.value)
        },
        submit() {
            this.$emit('submit');
        }
    }
}
</script>
