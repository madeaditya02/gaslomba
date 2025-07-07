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
            <form v-if="tipeRegister === 'peserta'" class="w-full px-4" @submit.prevent="formPeserta.post('/register')">
                <!-- Grid 2 Kolom -->
                <!-- Form Grid 2 Kolom -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 w-full">
                    <!-- Email -->
                    <div>
                        <label class="mb-1 font-semibold text-white">Email</label>
                        <input type="email" name="email" v-model="formPeserta.email" placeholder="Masukkan Email"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none" />
                        <InputError :message="formPeserta.errors.email" class="mt-1 font-medium" />
                    </div>

                    <!-- Nama -->
                    <div>
                        <label class="mb-1 font-semibold text-white">Nama</label>
                        <input type="text" v-model="formPeserta.nama" placeholder="Masukkan Nama"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none" />
                        <InputError :message="formPeserta.errors.nama" class="mt-1 font-medium" />
                    </div>

                    <!-- Nomor Telpon -->
                    <div>
                        <label class="mb-1 font-semibold text-white">Nomor Telepon</label>
                        <input type="tel" v-model="formPeserta.telpon" placeholder="Masukkan No Telepon"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none" />
                        <InputError :message="formPeserta.errors.telpon" class="mt-1 font-medium" />
                    </div>

                    <!-- Tingkatan -->
                    <div>
                        <label class="mb-1 font-semibold text-white">Tingkatan</label>
                        <select v-model="formPeserta.tingkatan"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black focus:outline-none">
                            <option value="" disabled selected>Masukkan Tingkatan</option>
                            <option value="sma">SMA</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="umum">Umum</option>
                        </select>
                        <InputError :message="formPeserta.errors.tingkatan" class="mt-1 font-medium" />
                    </div>

                    <!-- Asal Instansi -->
                    <div>
                        <label class="mb-1 font-semibold text-white">Asal Instansi</label>
                        <input type="text" v-model="formPeserta.instansi" placeholder="Masukkan Asal Instansi"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none" />
                        <InputError :message="formPeserta.errors.instansi" class="mt-1 font-medium" />
                    </div>

                    <!-- NISN -->
                    <div>
                        <label class="mb-1 font-semibold text-white">{{ jenisIdentitas }}</label>
                        <input type="text" :disabled="!formPeserta.tingkatan" v-model="formPeserta.identitas"
                            :placeholder="formPeserta.tingkatan ? `Masukkan ${jenisIdentitas}` : 'Pilih tingkatan terlebih dahulu'"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none" />
                        <InputError :message="formPeserta.errors.identitas" class="mt-1 font-medium" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="mb-1 font-semibold text-white">Password</label>
                        <input type="password" v-model="formPeserta.password" placeholder="Masukkan Password"
                            class="w-full min-w-0 flex-1 rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder-gray-500 focus:outline-none" />
                        <InputError :message="formPeserta.errors.password" class="mt-1 font-medium" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
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
            <form v-if="tipeRegister === 'penyelenggara'" class="w-full px-4"
                @submit.prevent="formPenyelenggara.post('/register')">
                <!-- Grid 2 Kolom -->
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Email -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Email</label>
                        <input type="email" name="email" v-model="formPenyelenggara.email" placeholder="Masukkan Email"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none" />
                        <InputError :message="formPenyelenggara.errors.email" class="mt-1" />
                    </div>

                    <!-- Nama Penyelenggara -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Nama Penyelenggara</label>
                        <input type="text" v-model="formPenyelenggara.nama_penyelenggara"
                            placeholder="Masukkan Nama Penyelenggara"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none" />
                        <InputError :message="formPenyelenggara.errors.nama_penyelenggara" class="mt-1" />
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Nomor Telepon</label>
                        <input type="text" v-model="formPenyelenggara.nomor_telepon" placeholder="Masukkan No Telepon"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none" />
                        <InputError :message="formPenyelenggara.errors.nomor_telepon" class="mt-1" />
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Alamat</label>
                        <input type="text" v-model="formPenyelenggara.alamat" placeholder="Masukkan Alamat"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none" />
                        <InputError :message="formPenyelenggara.errors.alamat" class="mt-1" />
                    </div>

                    <!-- Asal Instansi -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Asal Instansi</label>
                        <input type="text" v-model="formPenyelenggara.asal_instansi"
                            placeholder="Masukkan asal instansi"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none" />
                        <InputError :message="formPenyelenggara.errors.asal_instansi" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Password</label>
                        <input type="password" v-model="formPenyelenggara.password" placeholder="Masukkan Password"
                            class="w-full rounded-xl bg-gradient-to-b from-[#F3F3F3] to-[#C9C9C9] px-4 py-3 text-black placeholder:text-gray-500 focus:outline-none" />
                        <InputError :message="formPenyelenggara.errors.password" class="mt-1" />
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label class="mb-1 block font-semibold text-white">Konfirmasi Password</label>
                        <input type="password" v-model="formPenyelenggara.password_confirmation"
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
import InputError from '@/components/InputError.vue';
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
    tipe: 'peserta'
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
    nama_penyelenggara: '',
    alamat: '',
    asal_instansi: '',
    nomor_telepon: '',
    provinsi: '',
    password: '',
    password_confirmation: '',
    tipe: 'penyelenggara'
});
</script>