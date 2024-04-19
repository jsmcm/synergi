<script setup>

import { useForm, Link } from '@inertiajs/vue3';
let props = defineProps({
    user: Object,
    currentPage: Number,
});

const form = useForm({
    _method: 'PUT'
});

let edit = () => {

    form.put(route('user.update', { user: props.user }), {
        onSuccess: () => {
            // don't really need anything here 
            // as it is reactive
        },
        onError: () => {
            alert('Error editing item');
        }
    });
    
};

</script>

<template>

    <Link
        :href="route('user.update', { user: props.user.id}) + '?page=' + props.currentPage"
        type="button"
        class="btn btn-warning btn-icon"
    >
        <i class="bi-pencil"></i>
    </Link>

</template>
