<template>
    <AuthLayout>
        <div class="flex flex-col items-center justify-center space-y-6 text-center text-white">
            <!-- Subjudul -->
            <h2 class="text-base font-semibold sm:text-lg">Daftar Sebagai Peserta atau Penyelenggara?</h2>

            <!-- Tombol Horizontal -->
            <div class="flex flex-col items-center gap-4 sm:flex-row">
                <!-- Tombol Peserta -->
                <button
                    @click="tipeRegister = 'peserta'"
                    class="flex h-[60px] w-[240px] items-center justify-center gap-3 rounded-xl border border-white/40 bg-white/10 transition hover:bg-white/20"
                >
                    <img src="https://img.icons8.com/ios-filled/24/ffffff/graduation-cap.png" alt="Peserta" class="h-5 w-5" />
                    <span class="text-sm font-medium">Daftar Peserta</span>
                </button>

                <!-- Tombol Penyelenggara -->
                <button
                    @click="tipeRegister = 'penyelenggara'"
                    class="flex h-[60px] w-[240px] items-center justify-center gap-3 rounded-xl border border-white/40 bg-white/10 transition hover:bg-white/20"
                >
                    <img src="https://img.icons8.com/ios-filled/24/ffffff/administrator-male.png" alt="Penyelenggara" class="h-5 w-5" />
                    <span class="text-sm font-medium">Daftar Penyelenggara</span>
                </button>
            </div>

            <!-- Form Register Peserta -->
            <!-- Form Register Peserta -->
            <form v-if="tipeRegister === 'peserta'" class="mx-auto w-full max-w-5xl px-4 py-8">
                <!-- Grid 2 Kolom -->
                <!-- Form Grid 2 Kolom -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Email -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">Email</label>
                        <input
                            type="email"
                            v-model="formPeserta.email"
                            placeholder="Masukkan Email"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none"
                        />
                    </div>

                    <!-- Nama -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">Nama</label>
                        <input
                            type="text"
                            v-model="formPeserta.nama"
                            placeholder="Masukkan Nama"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none"
                        />
                    </div>

                    <!-- Nomor Telpon -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">Nomor Telepon</label>
                        <input
                            type="tel"
                            v-model="formPeserta.telpon"
                            placeholder="Masukkan No Telepon"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none"
                        />
                    </div>

                    <!-- Tingkatan -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">Tingkatan</label>
                        <select
                            v-model="formPeserta.tingkatan"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black focus:outline-none"
                        >
                            <option value="" disabled selected>Masukkan Tingkatan</option>
                            <option>SMA</option>
                            <option>Mahasiswa</option>
                            <option>Umum</option>
                        </select>
                    </div>

                    <!-- Asal Instansi -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">Asal Instansi</label>
                        <input
                            type="text"
                            v-model="formPeserta.instansi"
                            placeholder="Masukkan Asal Instansi"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none"
                        />
                    </div>

                    <!-- NISN -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">NISN</label>
                        <input
                            type="text"
                            v-model="formPeserta.nisn"
                            placeholder="Masukkan NISN"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none"
                        />
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">Password</label>
                        <input
                            type="password"
                            v-model="formPeserta.password"
                            placeholder="Masukkan Password"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none"
                        />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="flex flex-col">
                        <label class="mb-1 font-semibold text-white">Konfirmasi Password</label>
                        <input
                            type="password"
                            v-model="formPeserta.confirmPassword"
                            placeholder="Masukkan Ulang Password"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none"
                        />
                    </div>
                </div>

                <!-- Tombol Register -->
                <div class="col-span-1 mt-2 flex justify-center md:col-span-2">
                    <button
                        type="submit"
                        class="h-[50px] w-[300px] rounded-xl border border-white/40 font-semibold text-white transition hover:bg-white/20"
                    >
                        REGISTER
                    </button>
                </div>
            </form>

            <!-- Form Register Penyelenggara -->
            <!-- Form Register Penyelenggara -->
            <form v-if="tipeRegister === 'penyelenggara'" class="mx-auto w-full max-w-4xl px-4 md:px-0">
                <!-- Grid 2 Kolom -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Email -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Email</label>
                        <input
                            type="email"
                            v-model="formPeserta.email"
                            placeholder="Masukkan Email"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none"
                        />
                    </div>

                    <!-- Nama Penyelenggara -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Nama Penyelenggara</label>
                        <input
                            type="text"
                            v-model="formPeserta.namaPenyelenggara"
                            placeholder="Masukkan Nama Penyelenggara"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none"
                        />
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Nomor Telepon</label>
                        <input
                            type="text"
                            v-model="formPeserta.noTelpon"
                            placeholder="Masukkan No Telepon"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none"
                        />
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Alamat</label>
                        <input
                            type="text"
                            v-model="formPeserta.alamat"
                            placeholder="Masukkan Alamat"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none"
                        />
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Password</label>
                        <input
                            type="password"
                            v-model="formPeserta.password"
                            placeholder="Masukkan Password"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none"
                        />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Konfirmasi Password</label>
                        <input
                            type="password"
                            v-model="formPeserta.confirmPassword"
                            placeholder="Masukkan Ulang Password"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none"
                        />
                    </div>
                </div>

                <!-- Tombol Register -->
                <div class="col-span-1 mt-2 flex justify-center md:col-span-2">
                    <button
                        type="submit"
                        class="h-[50px] w-[300px] rounded-xl border border-white/40 font-semibold text-white transition hover:bg-white/20"
                    >
                        REGISTER
                    </button>
                </div>
            </form>

            <!-- Login -->
            <p class="text-xs">
                Sudah memiliki akun?
                <Link href="/login" class="font-semibold underline"> LOGIN </Link>
            </p>
        </div>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Link } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';

const tipeRegister = ref();
const formPeserta = reactive({
    email: '',
    nama: '',
    telpon: '',
    tingkatan: '',
    instansi: '',
    nisn: '',
    password: '',
    confirmPassword: '',
});
</script>

<style scoped></style>
