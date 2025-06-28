<template>
    <div class="flex min-h-screen bg-gray-50">
        <!-- Sidebar -->
        <aside class="flex w-64 flex-col items-center rounded-r-3xl bg-[#001f5f] py-8 text-white">
            <h1 class="mb-6 text-2xl font-bold">GasLomba <span class="text-yellow-400">🏆</span></h1>
            <p class="mb-8 text-center font-semibold">HIMAIF UDAYANA</p>

            <nav class="flex flex-col gap-4">
                <button class="flex items-center gap-2 rounded-lg px-4 py-2 hover:bg-white/10">
                    <i class="fas fa-user"></i>
                    <span>Profil</span>
                </button>
                <button class="flex items-center gap-2 rounded-lg bg-white/10 px-4 py-2">
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
        <div class="flex-1 p-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Edit Perlombaan</h1>
            </div>

            <!-- Form Container -->
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <!-- Informasi Perlombaan Section -->
                <div class="mb-8">
                    <h2 class="mb-6 text-lg font-semibold text-gray-800">Informasi Perlombaan</h2>

                    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-3">
                        <!-- Nama Perlombaan -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700">Nama Perlombaan</label>
                            <input
                                v-model="formData.namaPerlombaan"
                                type="text"
                                placeholder="Masukkan Nama Perlombaan"
                                class="w-full rounded-md border border-gray-300 px-3 py-2 text-black focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700">Kategori</label>
                            <div class="relative">
                                <select
                                    v-model="formData.kategori"
                                    class="w-full appearance-none rounded-md border px-3 py-2 text-black focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                >
                                    <option value="">Pilih Kategori Lomba</option>
                                    <option value="teknologi">Teknologi</option>
                                    <option value="seni">Seni</option>
                                    <option value="olahraga">Olahraga</option>
                                    <option value="akademik">Akademik</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                            <!-- Tags -->
                            <div class="mt-2 flex gap-2">
                                <span class="rounded-full bg-blue-100 px-2 py-1 text-xs text-blue-800">Teknologi</span>
                                <span class="rounded-full bg-blue-100 px-2 py-1 text-xs text-blue-800">Kompetisi</span>
                            </div>
                        </div>

                        <!-- Pamflet Perlombaan -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700">Pamflet Perlombaan</label>
                            <div class="rounded-md border-2 border-dashed border-gray-300 p-4 text-center">
                                <input type="file" @change="handleFileUpload" class="hidden" ref="fileInput" accept="image/*" />
                                <button @click="$refs.fileInput.click()" class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-upload mb-2"></i>
                                    <p class="text-sm">Upload Pamflet Perlombaan</p>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                        <!-- Tempat Perlombaan -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700">Tempat Perlombaan</label>
                            <input
                                v-model="formData.tempatPerlombaan"
                                type="text"
                                placeholder="Masukkan Lokasi Perlombaan"
                                class="w-full rounded-md border px-3 py-2 text-black focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                        </div>

                        <!-- Tanggal Perlombaan -->
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700">Tanggal Perlombaan</label>
                            <div class="grid grid-cols-2 gap-2">
                                <input
                                    v-model="formData.tanggalMulai"
                                    type="date"
                                    placeholder="Masukkan Tanggal Mulai"
                                    class="rounded-md border px-3 py-2 text-black focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                />
                                <span class="flex items-center justify-center">—</span>
                                <input
                                    v-model="formData.tanggalBerakhir"
                                    type="date"
                                    placeholder="Masukkan Tanggal Berakhir"
                                    class="rounded-md border px-3 py-2 text-black focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Rekening -->
                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-medium text-gray-700">Informasi Rekening</label>
                        <input
                            v-model="formData.informasiRekening"
                            type="text"
                            placeholder="Contoh: BNI: 1234567890"
                            class="w-full rounded-md border px-3 py-2 text-black focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        />
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <label class="mb-2 block text-sm font-medium text-black">Deskripsi</label>
                        <div class="rounded-md border text-black">
                            <!-- Toolbar -->
                            <div class="0 flex items-center gap-2 border-b border-gray-300 px-3 py-2 text-black">
                                <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-bold"></i></button>
                                <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-italic"></i></button>
                                <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-underline"></i></button>
                                <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-strikethrough"></i></button>
                                <div class="h-4 w-px bg-gray-300"></div>
                                <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-align-left"></i></button>
                                <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-align-center"></i></button>
                                <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-list-ul"></i></button>
                                <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-list-ol"></i></button>
                                <div class="h-4 w-px bg-gray-300"></div>
                                <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-link"></i></button>
                                <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-image"></i></button>
                                <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-smile"></i></button>
                                <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-plus"></i></button>
                                <div class="ml-auto flex gap-2">
                                    <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-undo"></i></button>
                                    <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-redo"></i></button>
                                    <button class="rounded p-1 hover:bg-gray-200"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                            <!-- Text Area -->
                            <textarea
                                v-model="formData.deskripsi"
                                placeholder="Masukkan Deskripsi atau Caption Lebih Lengkap"
                                rows="6"
                                class="w-full resize-none px-3 py-2 focus:outline-none"
                            ></textarea>
                        </div>
                    </div>
                </div>

                <!-- Cabang Lomba Section -->
                <div class="mb-8">
                    <div class="mb-6 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800">Cabang Lomba</h2>
                        <button @click="addCabangLomba" class="text-balck flex items-center gap-2 rounded-md bg-blue-600 px-4 py-2 hover:bg-blue-700">
                            <i class="fas fa-plus"></i>
                            Tambah Cablom
                        </button>
                    </div>

                    <!-- Cabang Lomba Items -->
                    <div v-for="(cabang, index) in formData.cabangLomba" :key="index" class="mb-6">
                        <div class="mb-4 grid grid-cols-1 gap-6 md:grid-cols-3">
                            <!-- Nama Cabang Lomba -->
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Nama Cabang Lomba</label>
                                <input
                                    v-model="cabang.nama"
                                    type="text"
                                    placeholder="Masukkan Nama Perlombaan"
                                    class="text-blackpx-3 w-full rounded-md border py-2 text-black focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                />
                            </div>

                            <!-- Tingkatan -->
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Tingkatan</label>
                                <div class="relative">
                                    <select
                                        v-model="cabang.tingkatan"
                                        class="w-full appearance-none rounded-md border px-3 py-2 text-black focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                    >
                                        <option value="">Pilih Tingkatan</option>
                                        <option value="sma">SMA</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                        <option value="umum">Umum</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                                        <i class="fas fa-chevron-down text-gray-400"></i>
                                    </div>
                                </div>
                                <!-- Tags -->
                                <div class="mt-2 flex gap-2">
                                    <span class="rounded-full bg-blue-100 px-2 py-1 text-xs text-blue-800">SMA</span>
                                    <span class="rounded-full bg-blue-100 px-2 py-1 text-xs text-blue-800">Mahasiswa</span>
                                </div>
                            </div>

                            <!-- Jumlah Maksimal Anggota -->
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700">Jumlah Maksimal Anggota</label>
                                <input
                                    v-model="cabang.jumlahMaksimal"
                                    type="number"
                                    placeholder="Jumlah Anggota termasuk Ketua"
                                    class="w-full rounded-md border px-3 py-2 text-black focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                />
                            </div>
                        </div>

                        <!-- Biaya Pendaftaran -->
                        <div class="mb-4">
                            <label class="mb-2 block text-sm font-medium text-gray-700">Biaya Pendaftaran</label>
                            <input
                                v-model="cabang.biayaPendaftaran"
                                type="text"
                                placeholder="Masukkan Nama Perlombaan"
                                class="w-full rounded-md border px-3 py-2 text-black focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            />
                        </div>

                        <!-- Remove button for multiple cabang lomba -->
                        <div v-if="formData.cabangLomba.length > 1" class="flex justify-end">
                            <button @click="removeCabangLomba(index)" class="text-sm text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i> Hapus Cabang Lomba
                            </button>
                        </div>

                        <!-- Divider -->
                        <hr v-if="index < formData.cabangLomba.length - 1" class="my-6 border-gray-200" />
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button @click="submitForm" class="rounded-md bg-[#001f5f] px-8 py-3 font-semibold text-white hover:bg-[#002f7f]">SIMPAN</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TambahPerlombaan',
    data() {
        return {
            formData: {
                namaPerlombaan: '',
                kategori: '',
                pamflet: null,
                tempatPerlombaan: '',
                tanggalMulai: '',
                tanggalBerakhir: '',
                informasiRekening: '',
                deskripsi: '',
                cabangLomba: [
                    {
                        nama: '',
                        tingkatan: '',
                        jumlahMaksimal: '',
                        biayaPendaftaran: '',
                    },
                ],
            },
        };
    },
    methods: {
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.formData.pamflet = file;
                console.log('File uploaded:', file.name);
            }
        },
        addCabangLomba() {
            this.formData.cabangLomba.push({
                nama: '',
                tingkatan: '',
                jumlahMaksimal: '',
                biayaPendaftaran: '',
            });
        },
        removeCabangLomba(index) {
            if (this.formData.cabangLomba.length > 1) {
                this.formData.cabangLomba.splice(index, 1);
            }
        },
        submitForm() {
            console.log('Form submitted:', this.formData);
            // Validate form data
            if (!this.formData.namaPerlombaan) {
                alert('Nama Perlombaan harus diisi');
                return;
            }

            // Process form submission
            alert('Data perlombaan berhasil disimpan!');
        },
    },
};
</script>

<style>
/* Import Font Awesome for icons */
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
</style>
