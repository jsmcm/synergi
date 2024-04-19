<script setup>
import 'bootstrap-icons/font/bootstrap-icons.css';

import EditButton from "./EditButton.vue";
import DeleteButton from "./DeleteButton.vue";

let props = defineProps({
    user: Object,
    currentPage: Number,
});


</script>

<template>
    <tr>
        <th scope="row">{{ user.id }}</th>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>
            <EditButton :user="user" :currentPage="currentPage" class="mx-2" />
            <DeleteButton :user="user" />
        </td>
    </tr>
</template>