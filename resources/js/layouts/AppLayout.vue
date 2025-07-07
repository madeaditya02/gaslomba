<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue'
import { assertIsNode } from "@/lib/utils";
const showNav = ref(false)
const scrolled = ref(false)
document.body.classList.remove('dashboard')
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
            <div class="navbar px-8 sm:px-12 md:px-20 py-8 flex flex-col md:flex-row justify-between items-center text-white fixed top-0 left-0 right-0 transition-all z-40"
                :class="{ 'bg-black/70': scrolled, '!bg-black/70': showNav }">
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
                <Link href="/register" v-if="!$page.props.auth.user"
                    class=" bg-primary text-white px-6 py-2 rounded-lg uppercase font-bold"
                    :class="{ 'hidden md:block': !showNav, 'block': showNav }">Daftar
                </Link>
                <Link href="/dashboard" v-if="$page.props.auth.user"
                    class=" bg-primary text-white px-6 py-2 rounded-lg uppercase font-bold"
                    :class="{ 'hidden md:block': !showNav, 'block': showNav }">Dashboard
                </Link>
            </div>
            <div class="mt-30">
                <slot />
            </div>
            <div class="md:px-8">
                <div
                    class="md:w-[1200px] w-full max-w-full md:h-[250px] bg-silver flex flex-col md:items-center md:justify-between md:mx-auto py-8 md:mt-10 md:mb-20 md:rounded-lg shadow-lg md:gap-10 gap-10 md:px-15 px-8">
                    <div class="flex md:flex-row flex-col md:items-center justify-between w-full gap-10">
                        <div class="flex flex-col md:gap-10 gap-7">
                            <Link href="/">
                            <img src="/assets/iconfooter.png" alt="" class="md:w-36">
                            </Link>
                            <div class="flex flex-row gap-5">
                                <Link href="facebook.com">
                                <img src="/assets/facebook.png" alt="" class="md:w-8 w-9">
                                </Link>
                                <Link href="whatsapp.com">
                                <img src="/assets/wa.png" alt="" class="md:w-8 w-9">
                                </Link>
                                <Link href="instagram.com">
                                <img src="/assets/ig.png" alt="" class="md:w-8 w-9">
                                </Link>
                            </div>
                        </div>
                        <div class="flex flex-col gap-4">
                            <Link href="/" class="text-blue-950 hover:text-blue-700 font-semibold md:text-lg text-xl">
                            Home</Link>
                            <Link href="/explore"
                                class="text-blue-950 hover:text-blue-700 font-semibold md:text-lg text-xl">Explore
                            </Link>
                            <Link href="/register"
                                class="text-blue-950 hover:text-blue-700 font-semibold md:text-lg text-xl">Daftar</Link>
                        </div>
                        <div class="flex flex-col gap-4 pr-5">
                            <Link href="/" class="text-blue-950 hover:text-blue-700 font-semibold md:text-lg text-xl">
                            Terms</Link>
                            <Link href="/" class="text-blue-950 hover:text-blue-700 font-semibold md:text-lg text-xl">
                            Privacy</Link>
                            <Link href="/" class="text-blue-950 hover:text-blue-700 font-semibold md:text-lg text-xl">
                            Cookies</Link>
                        </div>
                    </div>
                    <div class="border-t border-blue-950 w-full flex items-center justify-center">
                        <h1 class="my-5 text-blue-950">© 2025 Kelompok 3C. All rights reserved</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 overflow-hidden z-1 max-h-full" v-if="$page.url == '/'">
            <img src="/assets/vector-yellow.png" alt="" class="w-40 md:w-70 lg:w-80">
        </div>
        <img src="/assets/vector-yellow-2.png" alt="" class="absolute top-0 right-0 w-240 z-1"
            v-else-if="$page.url == '/explore'">
        <img src="/assets/vector-yellow-3.png" alt="" class="absolute top-0 right-0 w-120 z-1" v-else>
        <div class="absolute top-0 right-0 bottom-0 overflow-hidden z-0">
            <img src="/assets/bg-earth.png" alt="" class="w-60 sm:w-100 md:w-240">
        </div>
    </div>
</template>
