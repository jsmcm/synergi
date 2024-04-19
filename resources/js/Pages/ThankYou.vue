<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

let props = defineProps({
    name: String,
});


</script>

<template>
    <Head :title="'Thanks ' + props.name + '!'" />

    <GuestLayout>
        <div class="d-md-flex">
            <div class="container d-md-flex align-items-md-center vh-md-100 content-space-t-3 content-space-b-1 content-space-b-md-3 content-space-md-0">
                <div class="row justify-content-md-between align-items-md-center flex-grow-1">
                <div class="col-9 col-md-5 mb-5 mb-md-0">
                    <img class="img-fluid" src="/assets/svg/illustrations/oc-hi-five.svg" alt="Thank you...">
                </div>
                <!-- End Col -->

                <div class="col-md-6">
                    <!-- Heading -->
                    <div class="mb-4">
                        <h1>Thank you {{ props.name }}</h1>
                        <h4>We're stoked you're here!</h4>
                        <p>We'll be in touch shortly</p>

                        <p>If you would like to update your info you can<Link
                            :href="route('password.request')"
                        >
                            get an email to set your password.
                        </Link></p>

                    </div>
                    <!-- End Heading -->


                    
                </div>
                <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
        </div>
    <!-- End Content -->
    </GuestLayout>
</template>