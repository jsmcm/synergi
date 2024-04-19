<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        
        <div class="container content-space-3 content-space-t-lg-4 content-space-b-lg-3">
            <div class="flex-grow-1 mx-auto" style="max-width: 28rem;">
                <!-- Heading -->
                <div class="text-center mb-5 mb-md-7">
                    <h1 class="h2">Welcome back</h1>
                    <p>Login to manage your account.</p>
                </div>
                <!-- End Heading -->

                <!-- Form -->
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

                    <!-- Form -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label" for="signupSimpleLoginPassword">Password</label>
                        </div>


                        <div class="input-group input-group-merge">
                            <TextInput
                                id="password"
                                type="password"
                                class="form-control form-control-lg"
                                v-model="form.password"
                                required
                                minlength="8"
                                placeholder="8+ characters required" 
                                autocomplete="current-password"
                            />
                        </div>

                        <InputError class="mt-2" :message="form.errors.password" />

                    </div>
                    <!-- End Form -->

                    <div class="d-grid mb-3">
                        <label class="flex items-center">
                            <Checkbox name="remember" v-model:checked="form.remember" />
                            <span class="ms-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div class="d-grid mb-3">
                        <PrimaryButton class="btn btn-primary btn-lg" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Log in
                        </PrimaryButton>
                    </div>

                    <div class="text-center">
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="form-label-link"
                        >
                            Forgot your password?
                        </Link>
                    </div>
                </form>
                <!-- End Form -->

                <div v-if="status" class="alert alert-success" role="alert">
                    {{ status }}
                </div>
                
            </div>
        </div>
        <!-- End Form -->
   
    </GuestLayout>
</template>
