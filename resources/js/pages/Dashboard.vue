<script setup lang="ts">
// import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import DashboardLayout from '@/layouts/DashboardLayout.vue';

// const breadcrumbs: BreadcrumbItem[] = [
//     {
//         title: 'Dashboard',
//         href: '/dashboard',
//     },
// ];
</script>

<template>

    <Head title="Dashboard" />

    <DashboardLayout>
        <div>Hello</div>
    </DashboardLayout>
</template>
