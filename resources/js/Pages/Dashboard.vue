<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="d-md-flex">
            <div class="container d-md-flex align-items-md-center vh-md-100 content-space-t-3 content-space-b-1 content-space-b-md-3 content-space-md-0">
                <div class="row justify-content-md-between align-items-md-center flex-grow-1">
                <div class="col-9 col-md-5 mb-5 mb-md-0">
                    <img class="img-fluid" src="/assets/svg/illustrations/oc-looking-for-answers.svg" alt="Login to continue">
                </div>
                <!-- End Col -->

                <div class="col-md-6">
                    <!-- Heading -->
                    <div class="mb-4">
                    <h1>Hi {{ $page.props.auth.user.first_name }}</h1>
                    <h4>Get to work!</h4>
                    <p>Use the navigation links above to do stuff!</p>
                    </div>
                    <!-- End Heading -->

                </div>
                <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
        </div>
    <!-- End Content -->
    </AuthenticatedLayout>
</template>
