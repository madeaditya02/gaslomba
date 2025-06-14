<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue'
import { assertIsNode } from "@/lib/utils";
const showNav = ref(false)
const scrolled = ref(false)
document.body.classList.add('main')
scrolled.value = window.scrollY > 0
document.addEventListener('scroll', () => {
    scrolled.value = window.scrollY > 0
})
onMounted(() => {
    const navbar = document.querySelector('.navbar')
    document.addEventListener('click', event => {
        assertIsNode(event.target)
        if (!(event.target == navbar || navbar?.contains(event.target))) {
            showNav.value = false
        }
    })
})
</script>

<template>
    <!-- <AppLayout :breadcrumbs="breadcrumbs">
        <slot />
    </AppLayout> -->
    <div class="min-h-screen h-full overflow-y-hidden">
        <div class="relative z-10">
            <div class="navbar px-8 sm:px-12 md:px-20 py-8 flex flex-col md:flex-row justify-between items-center text-white fixed top-0 left-0 right-0 transition-all"
                :class="{ 'bg-black/40': scrolled, '!bg-black/70': showNav }">
                <div class="flex justify-between w-full md:w-auto">
                    <Link href="/">
                    <img src="/assets/logo.png" alt="" class="w-36">
                    </Link>
                    <button class="md:hidden" @click="showNav = !showNav">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-7">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
                <div class="flex-col md:flex-row gap-4 lg:gap-10 items-center uppercase font-bold pt-6 md:pt-0 mb-4 md:mb-0"
                    :class="{ 'hidden md:flex': !showNav, 'flex': showNav }">
                    <Link href="/" class="px-6 py-2 rounded-lg border border-transparent hover:border-white"
                        :class="{ 'border-white': $page.url === '/' }">Home</Link>
                    <Link href="/explore" class="px-6 py-2 rounded-lg border border-transparent hover:border-white"
                        :class="{ 'border-white': $page.url === '/explore' }">Explore
                    </Link>
                </div>
                <Link href="/register" class=" bg-primary text-white px-6 py-2 rounded-lg uppercase font-bold"
                    :class="{ 'hidden md:block': !showNav, 'block': showNav }">Daftar
                </Link>
            </div>
            <div class="mt-30">
                <slot />
            </div>
        </div>
        <div class="absolute top-0 right-0 overflow-hidden z-1 max-h-full" v-if="$page.url == '/s'">
            <img src="/assets/vector-yellow.png" alt="" class="w-40 sm:w-80">
        </div>
        <img src="/assets/vector-yellow-2.png" alt="" class="absolute top-0 right-0 w-240 z-1"
            v-else-if="$page.url == '/'">
        <img src="/assets/vector-yellow-3.png" alt="" class="absolute top-0 right-0 w-120 z-1" v-else>
        <div class="absolute top-0 right-0 bottom-0 overflow-hidden z-0">
            <img src="/assets/bg-earth.png" alt="" class="w-60 sm:w-100 md:w-240">
        </div>
    </div>
</template>
