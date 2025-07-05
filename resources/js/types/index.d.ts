import type { LucideIcon } from 'lucide-vue-next';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export type AppPageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
};

export type Penyelenggara = {
    id_penyelenggara: number,
    nama_penyelenggara: number,
    alamat: string,
    nomor_telepon: string,
    provinsi: string,
    profile: string,
}
export type Peserta = {
    id_peserta: number,
    nama: number,
    kode_identitas: string,
    no_telepon: string,
    tingkatan: string,
    asal_instansi: string,
    profile: string,
}
export type Tingkatan = {
    id_tingkatan: string,
    nama_tingkatan: string,
}
export type Kategori = {
    id_kategori: string,
    nama_kategori: string,
}
export type Lomba = {
    id_lomba: number,
    nama_perlombaan: string,
    tempat_perlombaan: string,
    pamflet_perlombaan: string,
    nama_penyelenggara: string,
    range_harga: [number, number],
    tingkatan: Tingkatan[],
    kategori: Kategori[],
    deskripsi: string,
    rekening: string,
    cabang_lomba: {
        id_cablom: string,
        nama_cablom: string,
        jumlah_anggota: number,
        biaya: number,
    }[]
}

export interface User {
    id: number;
    nama?: string;
    penyelenggara?: Penyelenggara;
    peserta?: Peserta;
    email: string;
    // avatar?: string;
    // email_verified_at: string | null;
    // created_at: string;
    // updated_at: string;
}

export type Paginator<T> = {
    data: T[],
    links: {
        first: string,
        last: string,
        next?: string | null,
        prev?: string | null,
    },
    meta: {
        current_page: number,
        from: number,
        last_page: number,
        links: Array,
        path: string,
        per_page: number,
        to: number,
        total: number,
    }
}

export type BreadcrumbItemType = BreadcrumbItem;
