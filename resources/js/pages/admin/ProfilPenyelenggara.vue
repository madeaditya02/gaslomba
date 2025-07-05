<template>
    <div class="flex min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <aside class="flex w-64 flex-col items-center rounded-r-3xl bg-[#001f5f] py-8 text-white">
            <h1 class="mb-6 text-2xl font-bold">GasLomba <span class="text-yellow-400">⚙️</span></h1>
            <p class="mb-8 text-center font-semibold">HIMAIF UDAYANA</p>

            <nav class="flex flex-col gap-4">
                <button class="flex items-center gap-2 rounded-lg px-4 py-2 hover:bg-white/10">
                    <i class="fas fa-user"></i>
                    <span>Profil</span>
                </button>
                <button class="flex items-center gap-2 rounded-lg px-4 py-2 hover:bg-white/10">
                    <i class="fas fa-trophy"></i>
                    <span>Perlombaan</span>
                </button>
            </nav>

            <div class="mt-auto pt-10">
                <button class="flex items-center gap-2 rounded-lg px-4 py-2 hover:bg-white/10">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log Out</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <!-- Header -->
            <div class="mb-6 rounded-xl bg-white p-6 shadow-md">
                <h2 class="text-xl font-bold text-black">Selamat Datang, HIMAIF UDAYANA!</h2>
            </div>

            <!-- Profile and Form -->
            <div class="flex items-start gap-10">
                <!-- Profile Image -->
                <div class="relative">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/commons/9/99/Sample_User_Icon.png"
                        alt="Profile"
                        class="h-40 w-40 rounded-full border-2 border-gray-300 shadow"
                    />
                    <button
                        class="absolute right-2 bottom-2 flex h-8 w-8 items-center justify-center rounded-full bg-[#001f5f] text-white shadow hover:bg-blue-800"
                    >
                        <i class="fas fa-pen text-sm"></i>
                    </button>
                </div>

                <!-- Form -->
                <form class="w-full max-w-4xl space-y-6">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label class="mb-1 block font-semibold text-black">Nama Penyelenggara</label>
                            <input
                                type="text"
                                v-model="form.namaPenyelenggara"
                                class="border-gray- w-full rounded-md border px-4 py-2 text-black shadow-sm focus:border-blue-500 focus:outline-none"
                            />
                        </div>
                        <div>
                            <label class="mb-1 block font-semibold text-black">Email</label>
                            <input
                                type="email"
                                v-model="form.email"
                                class="w-full rounded-md border border-gray-300 px-4 py-2 text-black shadow-sm focus:border-blue-500 focus:outline-none"
                            />
                        </div>
                        <div>
                            <label class="mb-1 block font-semibold text-black">Alamat</label>
                            <input
                                type="text"
                                v-model="form.alamat"
                                class="w-full rounded-md border border-gray-300 px-4 py-2 text-black shadow-sm focus:border-blue-500 focus:outline-none"
                            />
                        </div>
                        <div>
                            <label class="mb-1 block font-semibold text-black">Nomor Telepon</label>
                            <input
                                type="text"
                                v-model="form.noTelp"
                                class="w-full rounded-md border border-gray-300 px-4 py-2 text-black shadow-sm focus:border-blue-500 focus:outline-none"
                            />
                        </div>
                        <div>
                            <label class="mb-1 block font-semibold text-black">Asal Instansi</label>
                            <input
                                type="text"
                                v-model="form.instansi"
                                class="w-full rounded-md border border-gray-300 px-4 py-2 text-black shadow-sm focus:border-blue-500 focus:outline-none"
                            />
                        </div>
                        <div>
                            <label class="mb-1 block font-semibold text-black">Provinsi</label>
                            <input
                                type="text"
                                v-model="form.provinsi"
                                class="w-full rounded-md border border-gray-300 px-4 py-2 text-black shadow-sm focus:border-blue-500 focus:outline-none"
                            />
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="rounded-lg bg-[#001f5f] px-10 py-2 font-bold text-white shadow hover:bg-blue-800">SIMPAN</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                namaPenyelenggara: 'HIMAIF UDAYANA',
                email: 'himaifudayana@gmail.com',
                alamat: 'Jl. Kampus Udayana. Jimbaran',
                noTelp: '08123456789',
                instansi: 'Universitas Udayana',
                provinsi: 'Bali',
            },
        };
    },
};
</script>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
</style>
