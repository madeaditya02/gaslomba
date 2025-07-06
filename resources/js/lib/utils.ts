import { BadgeVariants } from '@/components/ui/badge';
import { clsx, type ClassValue } from 'clsx';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
    return twMerge(clsx(inputs));
}

export function assertIsNode(e: EventTarget | null): asserts e is Node {
    if (!e || !("nodeType" in e)) {
        throw new Error(`Node expected`);
    }
}
export function jenisIdentitas(tingkatan: string) {
    if (tingkatan == 'sma')
        return 'NISN'
    else if (tingkatan == 'mahasiswa')
        return 'NIM'
    else if (tingkatan == 'umum')
        return 'NIK'
    return 'Nomor Identitas'
}
export const badgeType = (status: string): BadgeVariants['variant'] => {
    if (status == 'Rejected')
        return 'destructive'
    else if (status == 'Accepted')
        return 'accepted'
    else if (status == 'Pending')
        return 'pending'
    else if (status == 'Non Aktif')
        return 'tertiary'
    return 'default'
}