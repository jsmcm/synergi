<script setup>

import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
<GuestLayout>
    <!-- Content -->
    <div class="d-md-flex">
        <div class="container d-md-flex align-items-md-center vh-md-100 content-space-t-3 content-space-b-1 content-space-b-md-3 content-space-md-0">
            <div class="row justify-content-md-between align-items-md-center flex-grow-1">
                <div class="col-9 col-md-5 mb-5 mb-md-0">
                    <img class="img-fluid" src="/assets/svg/illustrations/oc-yelling.svg" alt="SVG Illustration">
                </div>
                <!-- End Col -->

                <div class="col-md-6">
                    <!-- Heading -->
                    <div class="mb-4">
                        <h1>Its lonely here!</h1>
                        <h4>There are no admin users here.</h4>
                            <p>To get started please create your first admin user. To do so you'll need to use an artisan command: <strong>synergi:create_first_admin</strong></p>
                        <p>Once you've created your first admin user you'll be able to login to do your work.</p>
                    </div>
                    <!-- End Heading -->
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
    </div>
</GuestLayout>

</template>