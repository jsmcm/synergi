<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});


const validatePassword = (password) => {

    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,64}$/;

    if (! regex.test(password)) {
        return false;
    }
    return true;

};


const submit = () => {
    
    if (validatePassword(form.password) == false) {
        form.errors.password = "Password too weak. It must be between 8 and 64 characters, have one upper and one lower case character, one number and one symbol!";
        return;
    }

    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Reset Password" />

        <div class="container content-space-3 content-space-t-lg-4 content-space-b-lg-3">
            <div class="flex-grow-1 mx-auto" style="max-width: 28rem;">

                <form @submit.prevent="submit" class="js-validate needs-validation">
            
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



                    <!-- Form -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label" for="signupSimpleLoginPassword">Confirm Password</label>
                        </div>


                        <div class="input-group input-group-merge">
                            <TextInput
                                id="password"
                                type="password"
                                class="form-control form-control-lg"
                                v-model="form.password_confirmation"
                                required
                                minlength="8"
                                placeholder="8+ characters required" 
                                autocomplete="current-password"
                            />
                        </div>

                        <InputError class="mt-2" :message="form.errors.password_confirmation" />

                    </div>
                    <!-- End Form -->


                    <div class="d-grid mb-3">
                        <PrimaryButton class="btn btn-primary btn-lg" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Reset Password
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
