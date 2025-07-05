<script setup lang="ts">
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input'
</script>

<template>
    <DashboardLayout>
        <div class="border bg-white border-gray-300 rounded-md px-5 py-3">
            <h1 class="text-slate-800 font-semibold md:text-xl text-md">Selamat Datang, I Made Aditya Koding !</h1>
        </div>
        <div class="mt-15 flex lg:flex-row flex-col justify-between px-30 items-center">
            <div class="border border-primary rounded-full w-40 shadow-[0_0_15px_rgba(0,0,0,0.3)] shadow-primary">
                <img src="/assets/adit.png" alt="Profile Image" class="w-40 h-40 " />
                <!--BLOM ISI ICON BUAT EDIT FOTO-->
            </div>
            <div class="flex md:flex-row flex-col md:gap-10 gap-5 mt-10">
                <div class="flex flex-col md:gap-7 gap-5">
                    <div>
                        <h1 class="text-slate-800 font-semibold text-lg">Nama</h1>
                        <Input placeholder="I Made Aditya Koding"class="w-[300px] button-white placeholder:text-slate-600 mt-2"/>
                    </div>
                    <div>
                        <h1 class="text-slate-800 font-semibold text-lg">Tingkatan</h1>
                        <Input placeholder="Mahasiswa"class="w-[300px] button-white placeholder:text-slate-600 mt-2"/>
                    </div>
                    <div>
                        <h1 class="text-slate-800 font-semibold text-lg">Nomor Telepon</h1>
                        <Input placeholder="08123456789"class="w-[300px] button-white placeholder:text-slate-600 mt-2"/>
                    </div>
                </div>
                <div class="flex flex-col md:gap-7 gap-5">
                    <div>
                        <h1 class="text-slate-800 font-semibold text-lg">Email</h1>
                        <Input placeholder="IMADEADITYA15@GMAIL.COM"class="w-[300px] button-white placeholder:text-slate-600 mt-2"/>
                    </div>
                    <div>
                        <h1 class="text-slate-800 font-semibold text-lg">NIM</h1>
                        <Input placeholder="123456789"class="w-[300px] button-white placeholder:text-slate-600 mt-2"/>
                    </div>
                    <div>
                        <h1 class="text-slate-800 font-semibold text-lg">Asal Instansi</h1>
                        <Input placeholder="Universitas Udayana"class="w-[300px] button-white placeholder:text-slate-600 mt-2"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex lg:justify-end justify-center px-30 mb-10 md:mb-0">
            <Button class="text-white w-[300px] mt-10">SIMPAN</Button>
        </div>
    </DashboardLayout>
</template>