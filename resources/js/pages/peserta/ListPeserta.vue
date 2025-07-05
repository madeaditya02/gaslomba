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
        <div class="flex flex-1 flex-col">
            <!-- Main Section -->
            <div class="flex-1 p-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-800">Peserta Perlombaan : INVENTION Udayana 2025</h1>
                </div>

                <!-- Table -->
                <div class="rounded-lg border border-gray-200 bg-white shadow-sm">
                    <!-- Table Header -->
                    <div class="grid grid-cols-6 gap-4 border-b border-gray-200 bg-gray-50 p-4 font-medium text-gray-700">
                        <div>Cabang Lomba</div>
                        <div>Tanggal Pendaftaran</div>
                        <div>Cabang Lomba</div>
                        <div>Ketua Tim</div>
                        <div>Status Berkas</div>
                        <div></div>
                    </div>

                    <!-- Table Rows -->
                    <div class="divide-y divide-gray-200">
                        <!-- LOOP ROWS -->
                        <div v-for="(participant, index) in participants" :key="index" class="grid grid-cols-6 items-center gap-4 p-4">
                            <div class="text-gray-800">UI/UX Design</div>
                            <div class="text-gray-600">{{ getTanggal(index) }}</div>
                            <div class="text-gray-800">KTI</div>
                            <div class="text-gray-600">I Made Aditya</div>
                            <div class="relative">
                                <button
                                    @click="toggleStatusDropdown(index)"
                                    :class="getStatusClass(participant.status)"
                                    class="cursor-pointer rounded-full px-3 py-1 text-sm font-medium transition-opacity hover:opacity-80"
                                >
                                    {{ participant.status }}
                                </button>
                                <!-- Status Dropdown -->
                                <div
                                    v-if="showStatusDropdown === index"
                                    class="absolute top-8 left-0 z-20 w-32 rounded-md border border-gray-200 bg-white shadow-lg"
                                >
                                    <div class="py-1">
                                        <button
                                            v-for="status in statusOptions"
                                            :key="status"
                                            @click="updateStatus(index, status)"
                                            class="w-full px-3 py-2 text-left text-sm hover:bg-gray-50"
                                            :class="participant.status === status ? 'bg-blue-50 text-blue-700' : 'text-gray-700'"
                                        >
                                            {{ status }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="relative flex justify-end">
                                <button @click="toggleDropdown(index)" class="text-gray-400 hover:text-gray-600">
                                    <div class="flex gap-1">
                                        <div class="h-1 w-1 rounded-full bg-gray-400"></div>
                                        <div class="h-1 w-1 rounded-full bg-gray-400"></div>
                                        <div class="h-1 w-1 rounded-full bg-gray-400"></div>
                                    </div>
                                </button>
                                <!-- Dropdown menu -->
                                <div
                                    v-if="showDropdown === index"
                                    class="absolute top-8 right-0 z-10 w-48 rounded-md border border-gray-200 bg-white shadow-lg"
                                >
                                    <div class="py-1">
                                        <button
                                            @click="viewMembers(index)"
                                            class="flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                                        >
                                            <span>👥</span>
                                            Anggota & Berkas
                                        </button>
                                        <button
                                            @click="changeStatus(index)"
                                            class="flex w-full items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                                        >
                                            <span>📝</span>
                                            Ubah Status
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END LOOP -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'GasLombaDashboard',
    data() {
        return {
            showDropdown: null,
            showStatusDropdown: null,
            statusOptions: ['Pending', 'Ditolak', 'Diterima'],
            participants: [{ status: 'Pending' }, { status: 'Ditolak' }, { status: 'Diterima' }, { status: 'Diterima' }, { status: 'Diterima' }],
        };
    },
    methods: {
        toggleDropdown(rowIndex) {
            this.showDropdown = this.showDropdown === rowIndex ? null : rowIndex;
            this.showStatusDropdown = null;
        },
        toggleStatusDropdown(rowIndex) {
            this.showStatusDropdown = this.showStatusDropdown === rowIndex ? null : rowIndex;
            this.showDropdown = null;
        },
        updateStatus(rowIndex, newStatus) {
            this.participants[rowIndex].status = newStatus;
            this.showStatusDropdown = null;
            console.log(`Status baris ${rowIndex + 1} diubah menjadi: ${newStatus}`);
        },
        getStatusClass(status) {
            switch (status) {
                case 'Pending':
                    return 'bg-orange-100 text-orange-800';
                case 'Ditolak':
                    return 'bg-red-100 text-red-800';
                case 'Diterima':
                    return 'bg-green-100 text-green-800';
                default:
                    return 'bg-gray-100 text-gray-800';
            }
        },
        viewMembers(rowIndex) {
            alert(`Menampilkan anggota & berkas untuk peserta baris ${rowIndex + 1}`);
            this.showDropdown = null;
        },
        changeStatus(rowIndex) {
            this.showDropdown = null;
            this.toggleStatusDropdown(rowIndex);
        },
        getTanggal(index) {
            const tanggal = ['1 MEI 2025', '1 MEI 2024', '1 MEI 2023', '1 MEI 2022', '2 MEI 2021'];
            return tanggal[index] || 'Unknown';
        },
    },
    mounted() {
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.relative')) {
                this.showDropdown = null;
                this.showStatusDropdown = null;
            }
        });
    },
};
</script>
