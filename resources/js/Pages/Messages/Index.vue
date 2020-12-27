<template>
    <main-layout>
        <template #header>
            Уведомления
        </template>

        <div class="main__content__sellings-wrapper">
            <div class="complaints mb-3">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Заголовок</th>
                            <th scope="col">Дополнительная ссылка</th>
                            <th scope="col">Документы для скачивания</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="message in messages.data">
                                <td class="align-middle">
                                    <div class="w-50">
                                        {{ message.title }}
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <span class="ml-1">
                                        <a :href="message.url" target="_blank">
                                          {{ message.url | truncate(20)}}
                                        </a>
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex" v-for="attachment in message.attachments">
                                        <img src="../../../img/uploaded-file.png">
                                        <span class="ml-2 pt-2">{{ attachment.name | truncate(10) }}</span>
                                        <a :href="attachment.path" class="ml-2 pt-2" target="_blank">
                                            <Download />
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <Pagination :prev_page_url="messages.prev_page_url"
                        :next_page_url="messages.next_page_url"
                        :current_page="messages.current_page"
                        :links="messages.links"
            />
        </div>
    </main-layout>
</template>

<script>
    export default {
        name: "Index",
        components: {
            Pagination: () => import('@/Shared/Pagination'),
            MainLayout: () => import('@/Layouts/MainLayout'),
            Download: () => import('@/assets/icons/Download')
        },
        props: {
            messages: Object
        }
    }
</script>
