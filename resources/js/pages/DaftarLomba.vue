<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import InputFile from '@/components/InputFile.vue';
import Button from '@/components/ui/button/Button.vue';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import Select from '@/components/ui/select/Select.vue';
import SelectContent from '@/components/ui/select/SelectContent.vue';
import SelectGroup from '@/components/ui/select/SelectGroup.vue';
import SelectItem from '@/components/ui/select/SelectItem.vue';
import SelectTrigger from '@/components/ui/select/SelectTrigger.vue';
import SelectValue from '@/components/ui/select/SelectValue.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Lomba } from '@/types';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed, onUpdated } from 'vue';

const props = defineProps<{
  lomba: Lomba
}>()
const page = usePage()
const form = useForm({
  cabang_lomba: '',
  berkas: undefined,
  bukti_pembayaran: undefined,
  kode_anggota: [],
  berkas_anggota: [],
  id_lomba: props.lomba.id_lomba,
})
const selectedCablom = computed(() => {
  return props.lomba.cabang_lomba.find(cablom => cablom.id_cablom == form.cabang_lomba)
})

const jenisIdentitas = computed(() => {
  if (page.props.auth.user.peserta?.tingkatan == 'sma')
    return 'NISN'
  else if (page.props.auth.user.peserta?.tingkatan == 'mahasiswa')
    return 'NIM'
  else if (page.props.auth.user.peserta?.tingkatan == 'umum')
    return 'NIK'
  return 'Nomor Identitas'
})
const jenisBerkas = computed(() => {
  if (page.props.auth.user.peserta?.tingkatan == 'sma')
    return 'Kartu Pelajar'
  else if (page.props.auth.user.peserta?.tingkatan == 'mahasiswa')
    return 'Kartu Tanda Mahasiswa'
  else if (page.props.auth.user.peserta?.tingkatan == 'umum')
    return 'KTP'
  return 'Nomor Identitas'
})
const banyakAnggota = computed(() => {
  if (form.berkas_anggota.length == 0 || form.kode_anggota.length == 0) {
    return 1
  }
  return form.kode_anggota.length > form.berkas_anggota.length ? form.kode_anggota.length : form.berkas_anggota.length
})
onUpdated(() => {
  console.log(form.errors)
})
</script>
<template>
  <AppLayout>
    <div class="lg:px-40 px-8 text-white">
      <Link href="/explore">
      <img src="/assets/back.png" class="w-12" alt="" />
      </Link>
      <h2 class="mt-6 mb-10 text-3xl font-semibold">Pendaftaran Lomba: {{ lomba.nama_perlombaan }}</h2>
      <form action="" class="mb-16"
        @submit.prevent="form.transform(data => ({ ...data, jumlah_anggota: (selectedCablom?.jumlah_anggota ?? 1) - 1 })).post('')">
        <div class="grid grid-cols-6 gap-x-10 gap-y-5">
          <div class="col-span-2">
            <Label class="mb-2">Cabang Lomba</Label>
            <Select v-model="form.cabang_lomba" class="w-full">
              <SelectTrigger
                class="bg-silver text-blue-950 placeholder:text-blue-950 placeholder:font-semibold font-semibold w-full">
                <SelectValue placeholder="Pilih Cabang Lomba" class="text-blue-950" />
              </SelectTrigger>
              <SelectContent>
                <SelectGroup class="text-blue-950 bg-silver w-full">
                  <SelectItem :value="cablom.id_cablom" v-for="cablom in lomba.cabang_lomba" :key="cablom.id_cablom">{{
                    cablom.nama_cablom }}</SelectItem>
                </SelectGroup>
              </SelectContent>
            </Select>
            <InputError :message="form.errors.cabang_lomba" />
          </div>
        </div>
        <template v-if="form.cabang_lomba">
          <div class="grid grid-cols-3 mt-5">
            <div class="col-span-2 px-8 py-4 rounded-2xl bg-silver flex items-center gap-8 text-primary">
              <img src="/assets/dompet.png" alt="" class="w-28">
              <div>
                <h3 class="text-xl font-semibold mb-2">Pembayaran Biaya Pendaftaran</h3>
                <p>Rp {{ selectedCablom?.biaya }}/{{ (selectedCablom?.jumlah_anggota ?? 1) > 1 ? 'tim' : 'orang' }}</p>
                <p class="text-sm mt-2">{{ lomba.rekening }}</p>
              </div>
            </div>
          </div>
          <div class="grid grid-cols-6 gap-x-10 gap-y-5">
            <div class="row-start-3 col-span-2">
              <Label for="email" class="mb-2">Email</Label>
              <Input disabled :default-value="page.props.auth.user.email" id="email" class="bg-silver" />
            </div>
            <div class="row-start-3 col-span-2">
              <Label for="nama_ketua" class="mb-2">Nama Ketua</Label>
              <Input disabled :default-value="page.props.auth.user.peserta?.nama" id="nama_ketua" class="bg-silver" />
            </div>
            <div class="row-start-3 col-span-2">
              <Label for="kode_identitas" class="mb-2">{{ jenisIdentitas }}</Label>
              <Input disabled :default-value="page.props.auth.user.peserta?.kode_identitas" id="kode_identitas"
                class="bg-silver" />
            </div>
            <div class="row-start-4 col-span-2">
              <Label for="nomor_telepon" class="mb-2">Nomor Telepon</Label>
              <Input disabled :default-value="page.props.auth.user.peserta?.no_telepon" id="nomor_telepon"
                class="bg-silver" />
            </div>
            <div class="row-start-4 col-span-2">
              <Label for="asal_instansi" class="mb-2">Asal Instansi</Label>
              <Input disabled :default-value="page.props.auth.user.peserta?.asal_instansi" id="asal_instansi"
                class="bg-silver" />
            </div>
            <div class="row-start-4 col-span-2">
              <Label for="berkas" class="mb-2">Scan {{ jenisBerkas }}</Label>
              <InputFile accept="application/pdf" id="berkas" class="bg-silver" v-model="form.berkas" />
              <InputError :message="form.errors.berkas" />
            </div>
            <div class="row-start-5 col-span-2" v-if="(selectedCablom?.biaya ?? 0) > 0">
              <Label for="bukti_pembayaran" class="mb-2">Bukti Pembayaran</Label>
              <!-- <Input id="berkas" class="bg-silver" type="file" v-model="form.bukti_pembayaran" /> -->
              <InputFile accept="application/pdf" id="bukti_pembayaran" class="bg-silver"
                v-model="form.bukti_pembayaran" />
              <InputError :message="form.errors.bukti_pembayaran" />
            </div>
          </div>
        </template>
        <div class="mt-6" v-for="i in (selectedCablom?.jumlah_anggota ?? 1) - 1" :key="i">
          <h3 class="text-2xl font-semibold mb-4">Data Anggota {{ i }}</h3>
          <div class="grid grid-cols-6 gap-x-10 gap-y-5">
            <div class="col-span-2">
              <Label for="kode_anggota" class="mb-2">{{ jenisIdentitas }}</Label>
              <Input id="kode_anggota" v-model="form.kode_anggota[i - 1]" class="bg-silver"
                :placeholder="`Identitas Anggota ${i}`" />
              <InputError v-if="banyakAnggota == i" :message="form.errors.kode_anggota" />
            </div>
            <div class="col-span-2">
              <Label for="berkas_anggota" class="mb-2">Scan {{ jenisBerkas }}</Label>
              <InputFile accept="application/pdf" id="berkas_anggota" class="bg-silver"
                v-model="form.berkas_anggota[i - 1]" />
              <InputError v-if="banyakAnggota == i" :message="form.errors.berkas_anggota" />
            </div>
          </div>
        </div>
        <Button class="w-64 max-w-full block mx-auto border-2 border-slate-300 mt-8">Daftar</Button>
      </form>
    </div>
  </AppLayout>
</template>