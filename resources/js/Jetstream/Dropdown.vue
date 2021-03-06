<template>
    <div class="relative">
        <div @click="toggle">
            <slot name="trigger"></slot>
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="fixed inset-0 z-40" @click="toggle">
        </div>

        <transition
            enter-active-class="transition ease-out duration-200"
            enter-class="transform opacity-0 scale-95"
            enter-to-class="transform opacity-100 scale-100"
            leave-active-class="transition ease-in duration-75"
            leave-class="transform opacity-100 scale-100"
            leave-to-class="transform opacity-0 scale-95">
            <div v-show="open"
                    class="absolute z-50 mt-2 rounded-md shadow-lg"
                    :class="[widthClass, alignmentClasses]"
                    style="display: none;">
                <div class="rounded-md shadow-xs" :class="contentClasses">
                    <slot name="content"></slot>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: {
            align: {
                default: 'right'
            },
            width: {
                default: '48'
            },
            contentClasses: {
                default: () => ['py-1', 'bg-white']
            }
        },

        data() {
            return {
                open: false
            }
        },

        methods: {
            toggle() {
                this.open = !this.open;
                this.$emit('switch', this.open);
            }
        },

        created() {
            const closeOnEscape = (e) => {
                if (this.open && e.keyCode === 27) {
                    this.open = false
                }
            }

            this.$once('hook:destroyed', () => {
                document.removeEventListener('keydown', closeOnEscape)
            })

            document.addEventListener('keydown', closeOnEscape)
        },

        computed: {
            widthClass() {
                return 'w-' + this.width.toString()
            },

            alignmentClasses() {
                if (this.align == 'left') {
                    return 'origin-top-left left-0'
                } else if (this.align == 'right') {
                    return 'origin-top-right right-0 float-right'
                } else {
                    return 'origin-top'
                }
            },
        }
    }
</script>
<style scoped>
    .w-500 {
        width: 500px !important;
    }
</style>