<script setup>
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {  useForm, Head } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

import "vue3-select-component/dist/style.css";


// could possibly refactor this into a composable
// to share code with the profile edit (the user's own)
const form = useForm({
    name        : "",
    email       : "",
    comment     : "",
});



let save = () => { 

    form.post(route('user.post', { data: form }), {
        onSuccess: () => {
            
        },
        onError: () => {
            // alert('Error posting item');
        }
    });

};
</script>


<template>


<Head title="Welcome, please enter your info" />
<GuestLayout>

<div class="container content-space-3 content-space-t-lg-4 content-space-b-lg-3">
    <div class="flex-grow-1 mx-auto">

        <div class="py-12">

            <form @submit.prevent="save" class="js-validate needs-validation">


                <section>
                    
                    <div class="text-center mb-5 mb-md-7">
                        <h1 class="h2">Welcome, please enter your info</h1>
                    </div>

                    <!-- Form -->

                    <div class="row">

                        <div class="col-6 mb-4">
                            <label class="form-label" for="email">Your Name</label>

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
                            <label class="form-label" for="comments">Additional Comments/Info</label>

                            <div class="input-group input-group-merge">
                                <textarea v-model="form.comment" id="comments" class="form-control" placeholder="Comments or info" rows="8"></textarea>
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

</GuestLayout>    

</template>
