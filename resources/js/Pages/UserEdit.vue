<script setup>
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { computed } from "vue";

import "vue3-select-component/dist/style.css";


let props = defineProps({
    user: Object,
    currentPage: Number,
});

let comment = computed(() => {
 
    // this should not be an index an array.. except it is.. because we may later want to allow multiple comments...
    return props.user.comments[0]? props.user.comments[0].comment:"";
});

// could possibly refactor this into a composable
// to share code with the profile edit (the user's own)
const form = useForm({
    name        : props.user.name,
    role        : props.user.role??"client",
    email       : props.user.email,
    comment     : comment.value,
    currentPage : props.currentPage,
});



let userAction = computed(() => {

    if (props.user.id) {
        return "Edit";
    }

    return "Add";
});



let save = () => { 

    if (userAction.value == "Edit") {

        form.put(route('user.put', { user: props.user.id, data: form }), {
            onSuccess: () => {
                
            },
            onError: () => {
                // alert('Error putting item');
            }
        });

    } else {

        form.post(route('user.post', { data: form }), {
            onSuccess: () => {
                
            },
            onError: () => {
                // alert('Error posting item');
            }
        });
    }
};
</script>


<template>


<Head title="Edit User" />

<AuthenticatedLayout>

<div class="container content-space-3 content-space-t-lg-4 content-space-b-lg-3">
    <div class="flex-grow-1 mx-auto">

        <div class="py-12">

            <form @submit.prevent="save" class="js-validate needs-validation">


                <section>
                    
                    <div class="text-center mb-5 mb-md-7">
                        <h1 class="h2">{{ userAction }} User</h1>
                        <i><strong>Note: </strong><p>we could allow admin's to edit user passwords here. Doesn't seem like a great idea though.<br />For new users they will get the password reset link in their initial mail</p></i>
                    </div>

                    <!-- Form -->

                    <div class="row">

                        <div class="col-6 mb-4">
                            <label class="form-label" for="email">Name</label>

                            <div class="input-group input-group-merge">
                                <TextInput
                                        id="name"
                                        type="text"
                                        class="form-control form-control-lg"
                                        v-model="form.name"
                                        required
                                        autocomplete="first_name"
                                        placeholder="First name"
                                    />
                            </div>
                            <InputError class="mt-2" :message="form.errors.name" />

                        </div>
                        <!-- End Form -->
                        

                        <!-- Form -->
                        <div class="col-6 mb-4">
                            <label class="form-label" for="email">Email</label>

                            <div class="input-group input-group-merge">
                                <TextInput
                                        id="email"
                                        type="email"
                                        class="form-control form-control-lg"
                                        v-model="form.email"
                                        required
                                        autocomplete="username"
                                        placeholder="email@site.com"
                                    />
                            </div>
                            <InputError class="mt-2" :message="form.errors.email" />

                        </div>
                        <!-- End Form -->
                    
                    </div>

                    <div class="row">
                        <div class="col-12 mb-4">
                            <label class="form-label" for="role">Role</label>

                            <div class="input-group input-group-merge">
                                <select v-model="form.role" id="role" class="form-select">
                                    <option value="admin">Admin</option>
                                    <option value="client">Client</option>
                                </select>
                            </div>
                            <InputError class="mt-2" :message="form.errors.role" />

                        </div>
                    </div>




                    <div class="row">

                        <div class="col-12 mb-4">
                            <label class="form-label" for="comments">Additional Comments/Info</label>

                            <div class="input-group input-group-merge">
                                <textarea id="comments" class="form-control" placeholder="Comments or info" rows="8" v-model="form.comment"></textarea>
                            </div>
                            <InputError class="mt-2" :message="form.errors.comment" />

                        </div>
                        <!-- End Form -->

                    </div>
                    
                </section>


                <hr class="mt-7" />

                <section>
                    <div class="flex items-center gap-4">
                        <PrimaryButton class="btn btn-primary btn-lg" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</PrimaryButton>
                    </div>
                </section>
            </form>
            

        </div>
    </div>
</div>

</AuthenticatedLayout>    

</template>
