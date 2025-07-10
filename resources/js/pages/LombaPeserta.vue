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
import { Pendaftaran } from '@/types';
import { ref } from 'vue';
import CustomModal from '@/components/CustomModal.vue';
import { router, usePage } from "@inertiajs/vue3";

defineProps<{
    perlombaan: Pendaftaran[]
}>()

const page = usePage()

const selected = ref<Pendaftaran>()
</script>

<template>
    <DashboardLayout>
        <div class="border bg-white border-gray-300 rounded-md px-5 py-3">
            <h1 class="text-slate-800 font-semibold md:text-xl text-md">Selamat Datang, {{
                page.props.auth.user.peserta?.nama }}
                !</h1>
        </div>
        <Table class="mt-10 border border-gray-300 bg-white rounded-md" v-if="perlombaan.length > 0">
            <!-- <TableCaption></TableCaption> -->
            <TableHeader>
                <TableRow class="border-b border-gray-300">
                    <TableHead class="text-slate-800 text-center py-4">Nama Perlombaan</TableHead>
                    <TableHead class="text-slate-800 text-center py-4">Tanggal Pendaftaran</TableHead>
                    <TableHead class="text-slate-800 text-center py-4">Cabang Lomba</TableHead>
                    <TableHead class="text-slate-800 text-center py-4">Anggota</TableHead>
                    <TableHead class="text-slate-800 text-center py-4">Status Berkas</TableHead>
                    <TableHead class="text-slate-800 text-center py-4"></TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow class="border-b border-gray-300" v-for="lomba in perlombaan" :key="lomba.id_lomba">
                    <TableCell class="text-slate-800 text-center">{{ lomba.nama_perlombaan }}</TableCell>
                    <TableCell class="text-slate-800 text-center">{{ lomba.tanggal_perlombaan_string[0] }} - {{
                        lomba.tanggal_perlombaan_string[1] }}</TableCell>
                    <TableCell class="text-slate-800 text-center">{{ lomba.cabang_lomba }}</TableCell>
                    <TableCell class="text-slate-800 text-center">
                        <div v-for="anggota in lomba.anggota" :key="anggota.id_peserta">{{ anggota.nama }}</div>
                    </TableCell>
                    <TableCell>
                        <Badge :variant="badgeType(lomba.status)">{{ lomba.status }}</Badge>
                    </TableCell>
                    <TableCell>
                        <Button v-if="lomba.status == 'Rejected'" @click="selected = lomba">Catatan</Button>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
        <h2 class="text-2xl font-medium text-center mt-10" v-else>Tidak ada perlombaan yang anda ikuti</h2>

        <CustomModal :open="!!selected" @update-open="opened => selected = (opened ? selected : undefined)"
            title="Catatan Panitia" confirm-button="Perbaiki Berkas"
            @confirm="router.get(`/lomba/perbaikan/${selected?.id_pendaftaran}`)">
            <p class="mt-4 text-lg">{{ selected?.catatan_panitia }}</p>
        </CustomModal>
    </DashboardLayout>
</template>