<script setup lang="ts">
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table';
import { Button } from '@/components/ui/button';
</script>

<template>
    <DashboardLayout>
        <div class="border bg-white border-gray-300 rounded-md px-5 py-3">
            <h1 class="text-slate-800 font-semibold md:text-xl text-md">Selamat Datang, I Made Aditya Koding !</h1>
        </div>
        <Table class="mt-10 border border-gray-300 bg-white rounded-md">
            <TableCaption></TableCaption>
            <TableHeader>
            <TableRow class="border-b border-gray-300">
                <TableHead class="text-slate-800 w-[126px] text-center py-4">Nama Perlombaan</TableHead>
                <TableHead class="text-slate-800 w-[126px] text-center py-4">Tanggal Pendaftaran</TableHead>
                <TableHead class="text-slate-800 w-[126px] text-center py-4">Cabang Lomba</TableHead>
                <TableHead class="text-slate-800 w-[126px] text-center py-4">Anggota</TableHead>
                <TableHead class="text-slate-800 w-[126px] text-center py-4">Status Berkas</TableHead>
                <TableHead class="text-slate-800 w-[126px] text-center py-4"></TableHead>
            </TableRow>
            </TableHeader>
            <TableBody>
            <TableRow class="border-b border-gray-300">
                <TableCell class="text-slate-800 text-center">Invention Udayana 2025</TableCell>
                <TableCell class="text-slate-800 text-center">1 MEI 2025</TableCell>
                <TableCell class="text-slate-800 text-center">UIUX Design</TableCell>
                <TableCell class="text-slate-800 text-center">I Made Aditya,...</TableCell>
                <TableCell class="flex items-center justify-center">
                    <h1 class="bg-[#FF9500] text-center py-2 px-5 w-[100px] rounded-md">Pending</h1>
                </TableCell>
            </TableRow>
            <TableRow class="border-b border-gray-300">
                <TableCell class="text-slate-800 text-center">Invention Udayana 2024</TableCell>
                <TableCell class="text-slate-800 text-center">1 MEI 2024</TableCell>
                <TableCell class="text-slate-800 text-center">KTI</TableCell>
                <TableCell class="text-slate-800 text-center">I Made Aditya,...</TableCell>
                <TableCell class="flex items-center justify-center">
                    <h1 class="bg-[#BD2915] text-center py-2 px-5 w-[100px] rounded-md">Ditolak</h1>
                </TableCell>
                <TableCell class="text-center">
                    <Button class="text-white bg-[#012B89]">Catatan</Button>
                </TableCell>
            </TableRow>
            <TableRow class="border-b border-gray-300">
                <TableCell class="text-slate-800 text-center">Invention Udayana 2023</TableCell>
                <TableCell class="text-slate-800 text-center">1 MEI 2023</TableCell>
                <TableCell class="text-slate-800 text-center">KTI</TableCell>
                <TableCell class="text-slate-800 text-center">I Made Aditya,...</TableCell>
                <TableCell class="flex items-center justify-center">
                    <h1 class="bg-[#57DC46] text-center py-2 px-5 w-[100px] rounded-md">Diterima</h1>
                </TableCell>
            </TableRow>
            </TableBody>
        </Table>
    </DashboardLayout>
</template>