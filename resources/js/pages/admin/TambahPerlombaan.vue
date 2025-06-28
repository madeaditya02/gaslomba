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

        <!-- Content -->
        <main class="flex-1 p-8">
            <div class="mb-6 rounded-xl bg-white p-6 shadow-md">
                <h2 class="mb-4 text-xl font-bold text-black">Selamat Datang, HIMAIF UDAYANA!</h2>
            </div>

            <div class="mb-4 flex justify-end">
                <button class="rounded-lg bg-[#001f5f] px-6 py-2 font-semibold text-white shadow hover:bg-blue-800">Tambah Perlombaan</button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto rounded-xl bg-white shadow">
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gray-100 text-left text-black">
                        <tr>
                            <th class="px-6 py-4">Nama Perlombaan</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Tingkatan</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in lombaList" :key="index" class="border-t hover:bg-gray-50">
                            <td class="px-6 py-4 text-black">{{ item.nama }}</td>
                            <td class="px-6 py-4 text-black">{{ item.tanggal }}</td>
                            <td class="px-6 py-4 text-black">{{ item.kategori }}</td>
                            <td class="px-6 py-4 text-black">{{ item.tingkatan }}</td>
                            <td class="px-6 py-4">
                                <select
                                    v-model="item.status"
                                    class="rounded-full px-3 py-1 text-sm font-semibold text-white"
                                    :class="item.status === 'Aktif' ? 'bg-blue-600' : 'bg-blue-400'"
                                >
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non Aktif">Non Aktif</option>
                                </select>
                            </td>
                            <td class="relative px-6 py-4 text-right">
                                <button @click="toggleDropdown(index)">
                                    <i class="fas fa-ellipsis-h text-gray-700"></i>
                                </button>
                                <!-- Dropdown -->
                                <div
                                    v-if="dropdownIndex === index"
                                    class="absolute right-0 z-10 mt-2 w-40 rounded-xl border border-gray-200 bg-white shadow-lg"
                                >
                                    <ul class="text-sm text-gray-800">
                                        <li class="cursor-pointer px-4 py-2 hover:bg-gray-100">👥 Peserta</li>
                                        <li class="cursor-pointer px-4 py-2 hover:bg-gray-100">✏️ Edit</li>
                                        <li class="cursor-pointer px-4 py-2 hover:bg-gray-100">🗑️ Hapus</li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dropdownIndex: null,
            lombaList: [
                {
                    nama: 'Invention Udayana 2025',
                    tanggal: '1 MEI - 1 Oktober 2025',
                    kategori: 'Teknologi, Ilmiah',
                    tingkatan: 'SMA, Mahasiswa',
                    status: 'Aktif',
                },
                {
                    nama: 'Invention Udayana 2024',
                    tanggal: '1 MEI - 1 Oktober 2024',
                    kategori: 'Teknologi, Ilmiah',
                    tingkatan: 'SMA, Mahasiswa',
                    status: 'Non Aktif',
                },
                {
                    nama: 'Invention Udayana 2023',
                    tanggal: '1 MEI - 1 Oktober 2023',
                    kategori: 'Teknologi, Ilmiah',
                    tingkatan: 'SMA, Mahasiswa',
                    status: 'Non Aktif',
                },
                {
                    nama: 'Invention Udayana 2022',
                    tanggal: '1 MEI - 1 Oktober 2022',
                    kategori: 'Teknologi, Ilmiah',
                    tingkatan: 'SMA, Mahasiswa',
                    status: 'Non Aktif',
                },
                {
                    nama: 'Invention Udayana 2021',
                    tanggal: '1 MEI - 1 Oktober 2021',
                    kategori: 'Teknologi, Ilmiah',
                    tingkatan: 'SMA, Mahasiswa',
                    status: 'Non Aktif',
                },
            ],
        };
    },
    methods: {
        toggleDropdown(index) {
            this.dropdownIndex = this.dropdownIndex === index ? null : index;
        },
    },
};
</script>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
</style>
