<script setup lang="ts">
// import AppLogoIcon from '@/components/AppLogoIcon.vue';
// import AuthLayout from '@/layouts/auth/AuthSimpleLayout.vue';
import { Link } from '@inertiajs/vue3';
document.body.classList.add('main')
defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10 text-white z-2">
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-8">
                <div class="flex flex-col items-center gap-4">
                    <Link href="/" class="flex flex-col items-center gap-2 font-medium">
                    <img src="/assets/logo.png" alt="" class="w-52 max-w-full mx-auto mb-1">
                    <span class="sr-only">{{ title }}</span>
                    </Link>
                    <div class="space-y-2 text-center">
                        <h1 class="text-xl font-medium">{{ title }}</h1>
                        <p class="text-center text-sm text-muted-foreground">{{ description }}</p>
                    </div>
                </div>
                <slot />
            </div>
        </div>
    </div>
    <div class="absolute top-0 right-0 bottom-0 overflow-hidden">
        <img src="/assets/vector-yellow-4.png" alt="" class="w-72">
    </div>
    <img src="/assets/vector-white-2.png" alt="" class="w-24 absolute bottom-16 left-0">
</template>
