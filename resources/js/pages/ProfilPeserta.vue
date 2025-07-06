<script setup lang="ts">
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input'
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import InputError from '@/components/InputError.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { Peserta } from '@/types';
import { jenisIdentitas } from '@/lib/utils';
import InputFile from '@/components/InputFile.vue';
import { computed } from 'vue';
import { toast } from 'vue-sonner';

const props = defineProps<{
    peserta: Peserta,
    tingkatan: {
        id_tingkatan: string,
        nama_tingkatan: string,
    }[]
}>()

const page = usePage()
const form = useForm({
    nama: props.peserta.nama,
    // email: props.peserta.nama,
    tingkatan: props.peserta.tingkatan,
    kode: props.peserta.kode_identitas,
    nomor_telepon: props.peserta.no_telepon,
    asal_instansi: props.peserta.asal_instansi,
    profile_picture: null
})
const previewImage = computed(() => {
    if (form.profile_picture) {
        return URL.createObjectURL(form.profile_picture)
    }
    return props.peserta.profile_picture
})
const clickInput = () => {
    document.querySelector<HTMLInputElement>('.profile-input')?.click()
}
</script>

<template>
    <DashboardLayout>
        <div class="border bg-white border-gray-300 rounded-md px-5 py-3">
            <h1 class="text-slate-800 font-semibold md:text-xl text-md">Selamat Datang, {{ peserta.nama }} !</h1>
        </div>
        <form action=""
            @submit.prevent="form.post('', { onSuccess: () => toast.success('Profil berhasil diperbarui') })">
            <div class="mt-15 flex lg:flex-row flex-col justify-between items-start">
                <div class="border border-primary rounded-full w-40 shadow-[0_0_15px_rgba(0,0,0,0.3)] shadow-primary">
                    <img :src="previewImage" alt="Profile Image" class="w-40 h-40 rounded-full" @click="clickInput" />
                    <InputFile v-model="form.profile_picture" class="hidden profile-input" />
                    <!--BLOM ISI ICON BUAT EDIT FOTO-->
                </div>
                <div class="flex sm:flex-row flex-col md:gap-10 gap-5">
                    <div class="flex flex-col md:gap-7 gap-5">
                        <div>
                            <h1 class="text-slate-800 font-semibold text-lg">Nama</h1>
                            <Input placeholder="Masukkan nama lengkap" v-model="form.nama"
                                class="w-[300px] button-white placeholder:text-slate-600 mt-2" />
                            <InputError :message="form.errors.nama" />
                        </div>
                        <div>
                            <h1 class="text-slate-800 font-semibold text-lg">Tingkatan</h1>
                            <Select v-model="form.tingkatan" class="w-full bg-white">
                                <SelectTrigger class="font-semibold w-full">
                                    <SelectValue placeholder="Pilih Cabang Lomba" class="text-blue-950" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup class="text-blue-950 w-full">
                                        <SelectItem :value="t.id_tingkatan" v-for="t in tingkatan"
                                            :key="t.id_tingkatan">{{
                                                t.nama_tingkatan }}</SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <InputError :message="form.errors.tingkatan" />
                        </div>
                        <div>
                            <h1 class="text-slate-800 font-semibold text-lg">Nomor Telepon</h1>
                            <Input placeholder="Masukkan no. telepon" v-model="form.nomor_telepon"
                                class="w-[300px] button-white placeholder:text-slate-600 mt-2" />
                            <InputError :message="form.errors.nomor_telepon" />
                        </div>
                    </div>
                    <div class="flex flex-col md:gap-7 gap-5">
                        <div>
                            <h1 class="text-slate-800 font-semibold text-lg">Email</h1>
                            <Input placeholder="Masukkan email" disabled :default-value="page.props.auth.user.email"
                                class="w-[300px] button-white placeholder:text-slate-600 mt-2" />
                        </div>
                        <div>
                            <h1 class="text-slate-800 font-semibold text-lg">{{ jenisIdentitas(peserta.tingkatan) }}
                            </h1>
                            <Input v-model="form.kode" :placeholder="`Masukkan ${jenisIdentitas(peserta.tingkatan)}`"
                                class="w-[300px] button-white placeholder:text-slate-600 mt-2" />
                            <InputError :message="form.errors.kode" />
                        </div>
                        <div>
                            <h1 class="text-slate-800 font-semibold text-lg">Asal Instansi</h1>
                            <Input placeholder="Masukkan nama instansi" v-model="form.asal_instansi"
                                class="w-[300px] button-white placeholder:text-slate-600 mt-2" />
                            <InputError :message="form.errors.asal_instansi" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex lg:justify-end justify-center px-30 mb-10 md:mb-0">
                <Button class="text-white w-[300px] mt-10">SIMPAN</Button>
            </div>
        </form>
    </DashboardLayout>
</template>