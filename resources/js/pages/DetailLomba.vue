<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
</script>
<template>
    <AppLayout>
        <div class="flex flex-col lg:px-40 md:px-8 px-8">
            <Link href="/explore">
                <img src="/assets/back.png" class="w-12" alt=""/>
            </Link>
            <div class="mt-10 flex md:flex-row flex-col lg:gap-10 gap-6 justify-between">
                <div class="lg:w-[332px] md:w-[500px] lg:h-[470px] md:h-[390px] w-full items-center justify-center flex bg-silver rounded-lg ">
                    <img src="/assets/poster1.jpg" class="lg:w-[304px] md:w-[250px] w-[340px] my-3 mx-auto rounded-md"/>
                </div>
                <div class="bg-silver rounded-lg md:w-[780px] w-full lg:h-[470px] md:h-[390px]">
                    <div class="flex items-center justify-center">
                        <h1 class="text-blue-950 font-semibold lg:text-3xl md:text-2xl text-xl md:mt-5 mt-4">SCOUT FESTIVAL 2025</h1>
                    </div>
                    <div class="border-t-2 border-blue-950 md:mx-10 mx-6 md:mt-5 mt-4">
                        <div class="flex flex-row items-center gap-5 lg:mt-5 md:mt-3 mt-4">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#162456" class="lg:size-10 md:size-7 size-8"><path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" /></svg>
                            <h1 class="text-blue-950 font-semibold lg:text-2xl md:text-lg text-xl">SD & SMP</h1>
                        </div>
                        <div class="flex flex-row items-center gap-5 lg:mt-5 md:mt-3 mt-4">
                            <img src="/assets/segi2.png" class="lg:w-9 md:w-6 w-7" alt=""/>
                            <h1 class="text-blue-950 font-semibold lg:text-2xl md:text-lg text-xl">Pramuka</h1>
                        </div>
                        <div class="flex flex-row items-center gap-5 lg:mt-5 md:mt-3 mt-4">
                            <img src="/assets/duid.png" class="lg:w-9 md:w-6 w-7" alt=""/>
                            <h1 class="text-blue-950 font-semibold lg:text-2xl md:text-lg text-xl">Rp 40.000 - 75.000</h1>
                        </div>
                        <div class="flex flex-row items-center gap-5 lg:mt-5 md:mt-3 mt-4">
                            <img src="/assets/map.png" class="lg:w-7 md:w-4 w-5" alt=""/>
                            <h1 class="text-blue-950 font-semibold lg:text-2xl md:text-lg text-xl ml-2">Insan Cendekia Mandiri School, Sidoarjo</h1>
                        </div>
                        <h1 class="mt-5 text-blue-950 font-semibold lg:text-xl md:text-sm text-md">Diselenggarakan Oleh Insan Cendekia Mandiri School</h1>
                        <div class="flex justify-end">
                            <Button class="text-white px-12 lg:mt-10 md:mt-4 mt-5 mb-5">Daftar Sekarang</Button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-silver rounded-lg w-full lg:mt-20 md:mt-10 mt-6 md:mb-5 mb-10">
                <p class="text-blue-950 font-semibold text-lg mx-5 my-5 text-justify">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>
            </div>
        </div>
    </AppLayout>
</template>