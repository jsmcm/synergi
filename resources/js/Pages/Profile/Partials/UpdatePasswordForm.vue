<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>

        <div class="text-center mb-5 mb-md-7">
            <h1 class="h2">Update Password</h1>
            <p>Ensure your account is using a long, random password to stay secure.</p>
        </div>


        <form @submit.prevent="updatePassword" class="js-validate needs-validation">


            <!-- Form -->
            <div class="mb-4">
                <label class="form-label" for="current_password">Current Password</label>

                <div class="input-group input-group-merge">
                    <TextInput
                            id="current_password"
                            ref="currentPasswordInput"
                            type="password"
                            class="form-control form-control-lg"
                            v-model="form.current_password"
                            required
                            placeholder="Current Password"
                        />
                </div>
                <InputError class="mt-2" :message="form.errors.current_password" />

            </div>
            <!-- End Form -->



            <!-- Form -->
            <div class="mb-4">
                <label class="form-label" for="current_password">New Password</label>

                <div class="input-group input-group-merge">
                    <TextInput
                            id="current_password"
                            ref="passwordInput"
                            type="password"
                            class="form-control form-control-lg"
                            v-model="form.password"
                            required
                            placeholder="New Password"
                        />
                </div>
                <InputError class="mt-2" :message="form.errors.password" />

            </div>
            <!-- End Form -->



            <!-- Form -->
            <div class="mb-4">
                <label class="form-label" for="password_confirmation">Confirm Password</label>

                <div class="input-group input-group-merge">
                    <TextInput
                            id="password_confirmation"
                            ref="passwordInput"
                            type="password"
                            class="form-control form-control-lg"
                            v-model="form.password_confirmation"
                            required
                            placeholder="New Password"
                        />
                </div>
                <InputError class="mt-2" :message="form.errors.password_confirmation" />

            </div>
            <!-- End Form -->



            <div class="flex items-center gap-4">
                <PrimaryButton class="btn btn-primary btn-lg" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">Save</PrimaryButton>
                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
