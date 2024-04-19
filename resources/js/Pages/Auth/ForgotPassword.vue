<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div class="container content-space-3 content-space-t-lg-4 content-space-b-lg-3">
            <div class="flex-grow-1 mx-auto" style="max-width: 28rem;">

                <!-- Heading -->
                <div class="text-center mb-5 mb-md-7">
                    <h1 class="h2">Forgot your password?</h1>
                    <p>No problem. Just let us know your email address and we will email you a password reset
                        link that will allow you to choose a new one.</p>
                </div>
                <!-- End Heading -->


                <form @submit.prevent="submit" class="js-validate needs-validation" novalidate>
                
                    <!-- Form -->
                    <div class="mb-4">
                        <label class="form-label" for="email">Your email</label>

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

                    <div class="d-grid mb-3">
                        <PrimaryButton class="btn btn-primary btn-lg" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Email Password Reset Link
                        </PrimaryButton>
                    </div>
                </form>

                <div v-if="status" class="alert alert-success" role="alert">
                    {{ status }}
                </div>

            </div>
        </div>
   
    </GuestLayout>
</template>
