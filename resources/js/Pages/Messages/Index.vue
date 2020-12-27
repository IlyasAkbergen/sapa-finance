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
                                <td class="align-middle" scope="row">
                                    {{ message.title }}
                                </td>
                                <td class="align-middle d-flex">
                                    <img src="../../../img/uploaded-file.png">
                                    <span>
                                        <a :href="message.url" target="_blank">
                                          {{ message.url | truncate(20)}}
                                        </a>
                                    </span>
                                </td>
                                <td class="align-middle d-flex" v-for="attachment in message.attachments">
                                    <img src="../../../img/uploaded-file.png">
                                    <span>{{ attachment.name | truncate(10) }}</span>
                                    <a :href="attachment.path">
                                        <Download />
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <Pagination :prev_page_url="messages.prev_page_url"
                        :next-page-url="messages.next_page_url"
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
            MainLayout: () => import('@/Layouts/MainLayout')
        },
        props: {
            messages: Object
        }
    }
</script>
