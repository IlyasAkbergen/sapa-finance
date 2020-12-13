<template>
    <div v-show="message">
        <p class="text-sm text-red-600 text-danger">
            {{ Array.isArray(message) ? message[0] : message }}
        </p>
    </div>
</template>

<script>
    export default {
        props: ['message']
    }
</script>
