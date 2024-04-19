<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import UserItem from '@/Components/UserList/UserItem.vue';
import { onMounted } from "vue";


defineProps({
    pageData: Array
});

onMounted(() => {
    if (usePage().props.flash.message || usePage().props.flash.error) {
        setTimeout(() => {
            usePage().props.flash.message = "";
            usePage().props.flash.error = "";
        }, 5000);
    }
});

</script>

<template>

    <Head title="User Listing" />

    <AuthenticatedLayout>

        <div class="container content-space-3 content-space-t-lg-4 content-space-b-lg-3">
            <div class="flex-grow-1 mx-auto">

                <div class="py-12">
                    <div v-if="$page.props.flash.message" class="alert alert-success" role="alert">
                        {{ $page.props.flash.message }}
                    </div>

                    <div v-if="$page.props.flash.error" class="alert alert-danger" role="alert">
                        {{ $page.props.flash.error }}
                    </div>
  
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end">
                            <Link
                                :href="route('user.update')"
                                class="btn btn btn-success"
                            >
                            Add User
                            <i class="bi-person-plus"></i>
                            </Link>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-nowrap table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                            </tr>
                            </thead>
                            <tbody>

                            <UserItem
                                v-for="user in pageData.data"
                                :key="user.id"
                                :user="user"
                                :currentPage="pageData.current_page"
                            ></UserItem>


                            </tbody>
                        </table>
                    </div>

                    <div class="row">

                        <nav class="d-sm-flex justify-content-sm-between align-items-sm-center text-center" aria-label="Page navigation example">
                            <ul class="pagination justify-content-center justify-content-sm-end">
                                <li class="page-item" :class="{
                                    disabled: pageData.first_page_url == null
                                }">
                                <Link class="page-link" :href="pageData.first_page_url" tabindex="-1" preserve-scroll="">&laquo;&laquo; First</Link>
                                </li>                            

                                <li v-for="link in pageData.links" :key="link.url" class="page-item" :class="{ active:link.active==true}">
                                    <Link class="page-link" :href="link.url" v-html="link.label" preserve-scroll=""></Link>
                                </li>
                                
                                <li class="page-item" :class="{
                                    disabled: pageData.last_page_url == null
                                }">
                                <Link class="page-link" :href="pageData.last_page_url" preserve-scroll="">Last &raquo;&raquo;</Link>
                                </li>
                            </ul>

                            <small class="text-muted">Showing {{ pageData.from }} to {{ pageData.to }} of {{ pageData.total }}</small>
                        </nav>

                    </div>
                    <!-- End Table -->
                </div>
            </div>
        </div>

    <!-- End Content -->
    </AuthenticatedLayout>

</template>
