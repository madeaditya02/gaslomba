<template>
    <AuthLayout>
        <div class="items-center justify-center space-y-6 text-white">
            <div v-if="!tipeRegister">
                <!-- Subjudul -->
                <h2 class="text-base font-semibold sm:text-lg text-center">Daftar Sebagai Peserta atau Penyelenggara?
                </h2>

                <!-- Tombol Horizontal -->
                <div class="flex flex-col items-center justify-center w-full gap-4 sm:flex-row mt-4">
                    <!-- Tombol Peserta -->
                    <button @click="tipeRegister = 'peserta'"
                        class="flex h-[60px] w-[240px] items-center justify-center gap-3 rounded-xl border border-white/40 bg-white/10 transition hover:bg-white/20">
                        <img src="https://img.icons8.com/ios-filled/24/ffffff/graduation-cap.png" alt="Peserta"
                            class="h-5 w-5" />
                        <span class="text-sm font-medium">Daftar Peserta</span>
                    </button>

                    <!-- Tombol Penyelenggara -->
                    <button @click="tipeRegister = 'penyelenggara'"
                        class="flex h-[60px] w-[240px] items-center justify-center gap-3 rounded-xl border border-white/40 bg-white/10 transition hover:bg-white/20">
                        <img src="https://img.icons8.com/ios-filled/24/ffffff/administrator-male.png"
                            alt="Penyelenggara" class="h-5 w-5" />
                        <span class="text-sm font-medium">Daftar Penyelenggara</span>
                    </button>
                </div>
            </div>

            <!-- Form Register Peserta -->
            <!-- Form Register Peserta -->
            <form v-if="tipeRegister === 'peserta'" class="w-full px-4">
                <!-- Grid 2 Kolom -->
                <!-- Form Grid 2 Kolom -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 w-full">
                    <!-- Email -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">Email</label>
                        <input type="email" v-model="formPeserta.email" placeholder="Masukkan Email"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none" />
                    </div>

                    <!-- Nama -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">Nama</label>
                        <input type="text" v-model="formPeserta.nama" placeholder="Masukkan Nama"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none" />
                    </div>

                    <!-- Nomor Telpon -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">Nomor Telepon</label>
                        <input type="tel" v-model="formPeserta.telpon" placeholder="Masukkan No Telepon"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none" />
                    </div>

                    <!-- Tingkatan -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">Tingkatan</label>
                        <select v-model="formPeserta.tingkatan"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black focus:outline-none">
                            <option value="" disabled selected>Masukkan Tingkatan</option>
                            <option value="sma">SMA</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="umum">Umum</option>
                        </select>
                    </div>

                    <!-- Asal Instansi -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">Asal Instansi</label>
                        <input type="text" v-model="formPeserta.instansi" placeholder="Masukkan Asal Instansi"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none" />
                    </div>

                    <!-- NISN -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">{{ jenisIdentitas }}</label>
                        <input type="text" :disabled="!formPeserta.tingkatan" v-model="formPeserta.identitas"
                            :placeholder="formPeserta.tingkatan ? `Masukkan ${jenisIdentitas}` : 'Pilih tingkatan terlebih dahulu'"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none" />
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">Password</label>
                        <input type="password" v-model="formPeserta.password" placeholder="Masukkan Password"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">Konfirmasi Password</label>
                        <input type="password" v-model="formPeserta.password_confirmation"
                            placeholder="Masukkan Ulang Password"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none" />
                    </div>
                    <!-- Tombol Register -->
                    <div class="col-span-1 mt-2 flex justify-center md:col-span-2">
                        <button type="submit"
                            class="h-[50px] w-[300px] rounded-xl border border-white/40 font-semibold text-white transition hover:bg-white/20">
                            REGISTER
                        </button>
                    </div>
                </div>

            </form>

            <!-- Form Register Penyelenggara -->
            <!-- Form Register Penyelenggara -->
            <form v-if="tipeRegister === 'penyelenggara'" class="w-full px-4">
                <!-- Grid 2 Kolom -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Email -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Email</label>
                        <input type="email" v-model="formPeserta.email" placeholder="Masukkan Email"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none" />
                    </div>

                    <!-- Nama Penyelenggara -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Nama Penyelenggara</label>
                        <input type="text" v-model="formPeserta.namaPenyelenggara"
                            placeholder="Masukkan Nama Penyelenggara"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none" />
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Nomor Telepon</label>
                        <input type="text" v-model="formPeserta.noTelpon" placeholder="Masukkan No Telepon"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none" />
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Alamat</label>
                        <input type="text" v-model="formPeserta.alamat" placeholder="Masukkan Alamat"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Password</label>
                        <input type="password" v-model="formPeserta.password" placeholder="Masukkan Password"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Konfirmasi Password</label>
                        <input type="password" v-model="formPeserta.password_confirmation"
                            placeholder="Masukkan Ulang Password"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none" />
                    </div>
                    <!-- Tombol Register -->
                    <div class="col-span-1 flex justify-center md:col-span-2">
                        <button type="submit"
                            class="h-[50px] w-[300px] rounded-xl border border-white/40 font-semibold text-white transition hover:bg-white/20">
                            REGISTER
                        </button>
                    </div>
                </div>

            </form>

            <!-- Login -->
            <p class="text-xs text-center">
                Sudah memiliki akun?
                <Link href="/login" class="font-semibold underline"> LOGIN </Link>
            </p>
        </div>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const tipeRegister = ref();
const formPeserta = useForm({
    email: '',
    nama: '',
    telpon: '',
    tingkatan: '',
    instansi: '',
    identitas: '',
    password: '',
    password_confirmation: '',
});
const jenisIdentitas = computed(() => {
    if (formPeserta.tingkatan == 'sma')
        return 'NISN'
    else if (formPeserta.tingkatan == 'mahasiswa')
        return 'NIM'
    else if (formPeserta.tingkatan == 'umum')
        return 'NIK'
    return 'Nomor Identitas'
})
const formPenyelenggara = useForm({
    email: '',
    nama: '',
    telpon: '',
    tingkatan: '',
    instansi: '',
    identitas: '',
    password: '',
    password_confirmation: '',
});
</script>

<style scoped></style>
