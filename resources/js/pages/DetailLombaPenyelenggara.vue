<script setup lang="ts">
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import Badge from '@/components/ui/badge/Badge.vue';
import { badgeType } from '@/lib/utils';
import { Lomba, Pendaftaran } from '@/types';
import CustomModal from '@/components/CustomModal.vue';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { Ellipsis, Pencil, UsersRound } from 'lucide-vue-next';
import { ref, watch } from 'vue';
import Label from '@/components/ui/label/Label.vue';
import { Select, SelectContent, SelectGroup, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { useForm } from '@inertiajs/vue3';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import { toast } from 'vue-sonner';
import { PopoverClose } from 'reka-ui';

defineProps<{
    lomba: Lomba,
    pendaftaran: Pendaftaran[]
}>()
const selected = ref<Pendaftaran>()
const selectedForStatus = ref<Pendaftaran>()

const formStatus = useForm({
    id_pendaftaran: undefined as number | undefined,
    status: undefined as string | undefined,
    catatan_panitia: undefined as string | undefined,
})
watch(selectedForStatus, (val) => {
    formStatus.id_pendaftaran = val?.id_pendaftaran
    formStatus.status = val?.status
    formStatus.catatan_panitia = val?.catatan_panitia
})
</script>

<template>
    <DashboardLayout>
        <h2 class="text-2xl font-medium mt-8">Peserta Perlombaan: {{ lomba.nama_perlombaan }}</h2>
        <Table class="mt-5 border border-gray-300 bg-white rounded-md" v-if="pendaftaran.length > 0">
            <!-- <TableCaption></TableCaption> -->
            <TableHeader>
                <TableRow class="border-b border-gray-300">
                    <TableHead class="text-slate-800 w-[126px] text-center py-4">Cabang Lomba</TableHead>
                    <TableHead class="text-slate-800 w-[126px] text-center py-4">Tanggal Pendaftaran</TableHead>
                    <TableHead class="text-slate-800 w-[126px] text-center py-4">Bukti Pembayaran</TableHead>
                    <TableHead class="text-slate-800 w-[126px] text-center py-4">Nama Ketua</TableHead>
                    <TableHead class="text-slate-800 w-[126px] text-center py-4">Status</TableHead>
                    <TableHead class="text-slate-800 w-[126px] text-center py-4"></TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow class="border-b border-gray-300" v-for="lomba in pendaftaran" :key="lomba.id_pendaftaran">
                    <TableCell class="text-slate-800 text-center">{{ lomba.cabang_lomba }}</TableCell>
                    <TableCell class="text-slate-800 text-center">
                        {{ lomba.tanggal_perlombaan_string[0] }}
                    </TableCell>
                    <TableCell class="text-slate-800 text-center">
                        <a :href="lomba.bukti_pembayaran" target="_blank" class="text-blue-600 hover:underline">
                            Bukti Pembayaran
                        </a>
                    </TableCell>
                    <TableCell class="text-slate-800 text-center">
                        {{ lomba.anggota[0]?.nama }}
                    </TableCell>
                    <TableCell class="text-center">
                        <Badge :variant="badgeType(lomba.status)">{{ lomba.status }}</Badge>
                    </TableCell>
                    <TableCell>
                        <Popover>
                            <PopoverTrigger>
                                <Button variant="ghost">
                                    <Ellipsis />
                                </Button>
                            </PopoverTrigger>
                            <PopoverContent align="end" class="w-50 p-0">
                                <PopoverClose>
                                    <Button class="w-full justify-start" variant="ghost" size="lg"
                                        @click="selected = lomba">
                                        <UsersRound class="size-4 mr-1.5" />
                                        Anggota & Berkas
                                    </Button>
                                </PopoverClose>
                                <PopoverClose>
                                    <Button class="w-full justify-start" variant="ghost" size="lg"
                                        @click="selectedForStatus = lomba">
                                        <Pencil class="size-4 mr-1.5" />
                                        Ubah Status
                                    </Button>
                                </PopoverClose>
                            </PopoverContent>
                        </Popover>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
        <h2 class="text-2xl font-medium text-center mt-10" v-else>Tidak ada peserta pada perlombaan ini</h2>

        <CustomModal :open="!!selected" @update-open="opened => selected = (opened ? selected : undefined)"
            title="Anggota & Berkas Lomba">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Kode Identitas</TableHead>
                        <TableHead>Nama</TableHead>
                        <TableHead>Berkas</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="peserta in selected?.anggota" :key="peserta.id_peserta">
                        <TableCell class="font-medium">{{ peserta.kode_identitas }}</TableCell>
                        <TableCell>{{ peserta.nama }}</TableCell>
                        <TableCell>
                            <a :href="peserta.pivot.berkas_identitas" target="_blank"
                                class="text-blue-600 hover:underline">Buka
                                Berkas</a>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </CustomModal>

        <!-- Form Ubah Status -->
        <CustomModal :open="!!selectedForStatus" confirm-button="Ubah" @confirm="() => formStatus.post(`/dashboard/lomba/${lomba.id_lomba}/peserta/${selectedForStatus?.id_pendaftaran}`, {
            onSuccess: () => {
                toast.success('Status pendaftaran berhasil diubah')
                selectedForStatus = undefined
            }
        })" @update-open="opened => selectedForStatus = (opened ? selectedForStatus : undefined)"
            title="Anggota & Berkas Lomba">
            <div class="mt-3">
                <Label for="status" class="mb-1.5">Status</Label>
                <Select class="bg-white" v-model="formStatus.status">
                    <SelectTrigger class="w-28 sm:w-32">
                        <SelectValue placeholder="Pilih Status" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectItem value="Pending">Pending</SelectItem>
                            <SelectItem value="Accepted">Accepted</SelectItem>
                            <SelectItem value="Rejected">Rejected</SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>
            <div class="mt-3">
                <Label for="catatan" class="mb-1.5">Catatan Panitia</Label>
                <Textarea placeholder="Masukkan catatan untuk berkas" v-model="formStatus.catatan_panitia"
                    :disabled="formStatus.status != 'Rejected'" />
            </div>
        </CustomModal>
    </DashboardLayout>
</template>