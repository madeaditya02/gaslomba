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
import { Lomba } from '@/types';
import CustomModal from '@/components/CustomModal.vue';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { Link, router } from '@inertiajs/vue3';
import { Ellipsis, Pencil, Trash, UsersRound } from 'lucide-vue-next';
import { PopoverClose } from 'reka-ui';
import { ref } from 'vue';
import { toast } from 'vue-sonner';

defineProps<{
    perlombaan: Lomba[]
}>()
const confirmDelete = ref()
</script>

<template>
    <DashboardLayout>
        <div class="border bg-white border-gray-300 rounded-md px-5 py-3">
            <h1 class="text-slate-800 font-semibold md:text-xl text-md">Selamat Datang, {{
                $page.props.auth.user.penyelenggara.nama_penyelenggara }}</h1>
        </div>
        <div class="flex justify-between items-center gap-4 mt-8">
            <h2 class="text-2xl font-medium">Daftar Perlombaan</h2>
            <Button as-child>
                <Link href="/dashboard/lomba/tambah">Tambah Lomba</Link>
            </Button>
        </div>
        <Table class="mt-5 border border-gray-300 bg-white rounded-md" v-if="perlombaan.length > 0">
            <!-- <TableCaption></TableCaption> -->
            <TableHeader>
                <TableRow class="border-b border-gray-300">
                    <TableHead class="text-slate-800 w-[126px] text-center py-4">Nama Perlombaan</TableHead>
                    <TableHead class="text-slate-800 w-[126px] text-center py-4">Tanggal</TableHead>
                    <TableHead class="text-slate-800 w-[126px] text-center py-4">Kategori</TableHead>
                    <TableHead class="text-slate-800 w-[126px] text-center py-4">Tingkatan</TableHead>
                    <TableHead class="text-slate-800 w-[126px] text-center py-4">Status</TableHead>
                    <TableHead class="text-slate-800 w-[126px] text-center py-4"></TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                <TableRow class="border-b border-gray-300" v-for="lomba in perlombaan" :key="lomba.id_lomba">
                    <TableCell class="text-slate-800 text-center">{{ lomba.nama_perlombaan }}</TableCell>
                    <TableCell class="text-slate-800 text-center">
                        {{ lomba.tanggal_string[0] }} - {{ lomba.tanggal_string[1] }}
                    </TableCell>
                    <TableCell class="text-slate-800 text-center">{{lomba.kategori.map(k => k.nama_kategori).join(', ')
                        }}</TableCell>
                    <TableCell class="text-slate-800 text-center">
                        {{lomba.tingkatan.map(jenjang => jenjang.nama_tingkatan).join(', ')}}
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
                                <Button as-child class="w-full justify-start" variant="ghost" size="lg">
                                    <Link :href="`/dashboard/lomba/${lomba.id_lomba}/peserta`">
                                    <UsersRound class="size-4 mr-1.5" />
                                    Peserta
                                    </Link>
                                </Button>
                                <Button as-child class="w-full justify-start" variant="ghost" size="lg">
                                    <Link :href="`/dashboard/lomba/${lomba.id_lomba}/edit`">
                                    <Pencil class="size-4 mr-1.5" />
                                    Edit
                                    </Link>
                                </Button>
                                <PopoverClose class="w-full">
                                    <Button class="!w-full justify-start" variant="ghost" size="lg"
                                        @click="confirmDelete = lomba.id_lomba">
                                        <Trash class="size-4 mr-1.5" />
                                        Hapus
                                    </Button>
                                </PopoverClose>
                            </PopoverContent>
                        </Popover>
                    </TableCell>
                </TableRow>
            </TableBody>
        </Table>
        <h2 class="text-2xl font-medium text-center mt-10" v-else>Tidak ada perlombaan yang anda ikuti</h2>

        <CustomModal :open="!!confirmDelete"
            @update-open="opened => confirmDelete = (opened ? confirmDelete : undefined)" title="Hapus Lomba"
            confirm-button="Hapus" @confirm="router.delete('/dashboard/lomba/' + confirmDelete, {
                onSuccess: () => {
                    confirmDelete = undefined
                    toast.success('Lomba berhasil dihapus')
                }
            })">
            <p class="mt-4 text-xl">Anda yakin ingin menghapus lomba tersebut?</p>
        </CustomModal>
    </DashboardLayout>
</template>