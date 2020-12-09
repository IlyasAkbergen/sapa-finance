<template>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th scope="col"
                    v-for="header in headers"
                    :key="header.id">
                    {{ header.title }}
                </th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="row in rows">
                <th class="align-middle" scope="row">
                    {{ row[headers[0].key] }}
                </th>
                <td class="align-middle"
                    v-for="header in headers"
                    v-if="!header.is_title">
                    {{ row[header.key] }}
                </td>

                <td class="align-middle">
                    <a class="users__link users__link--red float-right courses__delete"
                        :href="route(delete_route_name, row.id)">
                        <img src="../../img/trash.svg">
                    </a>
                    <a class="users__link users__link--blue float-right"
                       :href="route(edit_route_name, row.id)">
                        <img src="../../img/pencil.svg">
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "CrudTable",
    props: {
        headers: Array,
        rows: Array,
        edit_route_name: String,
        delete_route_name: String
    }
}
</script>
