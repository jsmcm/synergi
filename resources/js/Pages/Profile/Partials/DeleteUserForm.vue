<script setup>
import sweetalert from "sweetalert";
import { Inertia } from '@inertiajs/inertia'

const confirmUserDeletion = () => {

    sweetalert({
        text: "Are you sure you want to delete your account?",
        title: "Are you sure?",
        icon: "warning",
        buttons: ["No, don't delete!", "Yes, I am sure!"],
        dangerMode: true,
    }).then(function (isConfirm) {
        if (isConfirm) {
       
            deleteUser();

        } else {
            sweetalert({
                title: "Not deleting",
                text: "Your entry is safe :)",
                icon: "success",
                timer: 3500,
            });
        }
    });

};

const deleteUser = () => {

    Inertia.visit(route('profile.destroy'), {
          method: 'delete',
          onSuccess: () => {
            sweetalert({
                title: "Deleted!",
                text: "This account has been deleted.",
                icon: "success",
                timer: 3500,
            });
          },
          onError: () => {
            alert('Error deleting item'); 
          }
        });

};


</script>

<template>
    <section class="space-y-6">

        <div class="text-center mb-5 mb-md-7">
            <h1 class="h2">Delete Account</h1>
            <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting
                your account, please download any data or information that you wish to retain.</p>
        </div>


        <button class="btn btn-danger" @click="confirmUserDeletion">Delete Account</button>


    </section>
</template>
