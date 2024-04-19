<script setup>

import sweetalert from "sweetalert";
import { useForm } from '@inertiajs/vue3';
// import { Inertia } from '@inertiajs/inertia'

let props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'DELETE'
});

let confirmDelete = () => {
    sweetalert({
        title: "Are you sure?",
        text: "Really delete user: " + props.user.first_name + " " + props.user.surname + "?",
        danger: true,
        icon: "warning",
        buttons: ["No, do not delete!", "Yes, delete"]
    })
    .then((isConfirm) => {

        if (isConfirm) {
            deleteUser();
        }
    });
};

let deleteUser = () => {
    
    form.delete(route('user.delete', { user: props.user.id }), {
        onSuccess: () => {
            // don't really need anything here 
            // as it is reactive
        },
        onError: () => {
            alert('Error deleting item');
        }
    });
    
};

</script>

<template>

    <button
        @click="confirmDelete"
        type="button"
        class="btn btn-danger btn-icon"
    >
        <i class="bi-trash"></i>
    </button>
       
</template>