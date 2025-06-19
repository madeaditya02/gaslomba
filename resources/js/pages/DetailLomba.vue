<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
</script>
<template>
    <AppLayout>
        <div class="flex flex-col px-40">
            <Link href="/explore">
                <img src="/assets/back.png" class="w-12" alt=""/>
            </Link>
            <div class="mt-10 flex flex-row gap=10 justify-between">
                <div class="w-[332px] h-[470px] items-center flex bg-silver rounded-lg ">
                    <img src="/assets/poster1.jpg" class="w-[304px] mx-auto rounded-md"/>
                </div>
                <div class="bg-silver rounded-lg w-[780px] h-[470px]">
                    <div class="flex items-center justify-center">
                        <h1 class="text-blue-950 font-semibold text-3xl mt-5">SCOUT FESTIVAL 2025</h1>
                    </div>
                    <div class="border-t-2 border-blue-950 mx-10 mt-5">
                        <div class="flex flex-row items-center gap-5 mt-5">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#162456" class="size-10"><path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" /></svg>
                            <h1 class="text-blue-950 font-semibold text-2xl">SD & SMP</h1>
                        </div>
                        <div class="flex flex-row items-center gap-5 mt-5">
                            <img src="/assets/segi2.png" class="w-9" alt=""/>
                            <h1 class="text-blue-950 font-semibold text-2xl">Pramuka</h1>
                        </div>
                        <div class="flex flex-row items-center gap-5 mt-5">
                            <img src="/assets/duid.png" class="w-9" alt=""/>
                            <h1 class="text-blue-950 font-semibold text-2xl">Rp 40.000 - 75.000</h1>
                        </div>
                        <div class="flex flex-row items-center gap-5 mt-5">
                            <img src="/assets/map.png" class="w-7" alt=""/>
                            <h1 class="text-blue-950 font-semibold text-2xl ml-2">Insan Cendekia Mandiri School, Sidoarjo</h1>
                        </div>
                        <h1 class="mt-5 text-blue-950 font-semibold text-xl">Diselenggarakan Oleh Insan Cendekia Mandiri School</h1>
                        <div class="flex justify-end">
                            <Button class="text-white px-12 mt-5">Daftar Sekarang</Button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-silver rounded-lg w-full mt-10 mb-5">
                <p class="text-blue-950 font-semibold text-lg mx-5 my-5 text-justify">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>
    </AppLayout>
</template>