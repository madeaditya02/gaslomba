<?php

namespace Database\Seeders;

use Carbon\Carbon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Lomba;
use App\Models\Peserta;
use App\Models\Tingkatan;
use App\Models\Penyelenggara;
use App\Models\JenisPerlombaan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user1 = User::factory()->create(['email' => 'test@example.com']);
        $user2 = User::factory()->create(['email' => 'imadeaditya4@gmail.com']);
        $users = User::factory(2)->create();
        $penyelenggara = Penyelenggara::factory()->create([
            'nama_penyelenggara' => 'HIMAIF Udayana',
        ]);
        $user1->penyelenggara()->save($penyelenggara);

        $sma = Tingkatan::create(['id_tingkatan' => 'sma', 'nama_tingkatan' => 'SMA/SMK Sederajat']);
        $mhs = Tingkatan::create(['id_tingkatan' => 'mahasiswa', 'nama_tingkatan' => 'Mahasiswa']);
        $umum = Tingkatan::create(['id_tingkatan' => 'umum', 'nama_tingkatan' => 'Umum']);
        $kategoriIT = JenisPerlombaan::create(['id_kategori' => 'it', 'nama_kategori' => 'IT']);
        $kategoriDesign = JenisPerlombaan::create(['id_kategori' => 'design', 'nama_kategori' => 'Design']);
        $peserta1 = Peserta::factory()->create();
        $user2->peserta()->save($peserta1);
        $peserta2 = Peserta::factory()->create();
        $users[0]->peserta()->save($peserta2);
        $peserta3 = Peserta::factory()->create();
        $users[1]->peserta()->save($peserta3);
        $lomba = Lomba::create([
            'nama_perlombaan' => 'INVENTION Udayana 2025',
            'tempat_perlombaan' => 'Online',
            'deskripsi' => fake()->realText(),
            'tanggal_mulai' => new Carbon('2025-06-12'),
            'tanggal_selesai' => new Carbon('2025-09-12'),
            'pamflet_perlombaan' => asset('storage/pamflet-lomba/poster1.jpg'),
            'rekening' => 'BNI : 123456789',
            'id_penyelenggara' => $penyelenggara->id_penyelenggara
        ]);
        $lomba->jenis_perlombaan()->attach([$kategoriIT, $kategoriDesign]);
        $cablom1 = $lomba->cabang_lomba()->create([
            'nama_cablom' => 'Poster Digital',
            'jumlah_anggota' => 1,
            'biaya' => 40000,
        ]);
        $cablom1->tingkatan()->attach($sma);
        $cablom2 = $lomba->cabang_lomba()->create([
            'nama_cablom' => 'UI/UX Design',
            'jumlah_anggota' => 3,
            'biaya' => 60000,
        ]);
        $cablom2->tingkatan()->attach([$sma, $mhs]);

        $pendaftaran = $cablom2->pendaftaran()->create([
            'bukti_pembayaran' => 'bukti.pdf',
            'status' => 'Accepted',
        ]);
        $pendaftaran->peserta()->attach($peserta1->id, ['berkas_identitas' => 'berkas.pdf', 'role' => 'Ketua']);
        $pendaftaran->peserta()->attach($peserta2->id, ['berkas_identitas' => 'berkas.pdf', 'role' => 'Anggota']);
        $pendaftaran->peserta()->attach($peserta3->id, ['berkas_identitas' => 'berkas.pdf', 'role' => 'Anggota']);
    }
}
