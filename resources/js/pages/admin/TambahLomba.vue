<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import InputFile from '@/components/InputFile.vue';
import { Alert, AlertDescription } from '@/components/ui/alert';
import Button from '@/components/ui/button/Button.vue';
import { Checkbox } from '@/components/ui/checkbox';
import { Combobox, ComboboxAnchor, ComboboxInput, ComboboxItem, ComboboxList, ComboboxTrigger } from '@/components/ui/combobox';
// import ComboboxEmpty from '@/components/ui/combobox/ComboboxEmpty.vue';
import ComboboxGroup from '@/components/ui/combobox/ComboboxGroup.vue';
import { Input } from '@/components/ui/input';
import Label from '@/components/ui/label/Label.vue';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import Textarea from '@/components/ui/textarea/Textarea.vue';
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { Kategori, Tingkatan } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { AlertCircle, ChevronsUpDown, Search } from 'lucide-vue-next';
import { computed, ref } from 'vue';

const props = defineProps<{
  list_kategori: Kategori[],
  list_tingkatan: Tingkatan[],
}>()
const form = useForm({
  nama_perlombaan: '',
  kategori: [] as Kategori[],
  pamflet_perlombaan: undefined,
  tempat_perlombaan: '',
  tanggal_mulai: '',
  tanggal_selesai: '',
  rekening: '',
  deskripsi: '',
  jumlah_cablom: 1,
  nama_cablom: [] as string[],
  tingkatan: [[]] as Tingkatan[][],
  jumlah_anggota: [] as number[],
  biaya: [] as number[],
})

const listCategories = ref(props.list_kategori)
const textKategori = ref('')
const dataKategori = computed(() => textKategori.value && !listCategories.value.find(k => k.id_kategori == textKategori.value) ? [...listCategories.value, { id_kategori: textKategori.value, nama_kategori: `Tambah "${textKategori.value}"` }] : [...listCategories.value])
const addKategori = (val: Kategori) => {
  if (val.nama_kategori.includes('Tambah "')) {
    const newKategori = { ...val, nama_kategori: val.id_kategori.charAt(0).toUpperCase() + val.id_kategori.slice(1) }
    form.kategori.push(newKategori)
    listCategories.value.push(newKategori)
  } else {
    form.kategori.push(val)
  }
}
</script>
<template>
  <DashboardLayout>
    <form @submit.prevent="form.transform(data => ({
      ...data,
      kategori: form.kategori.map(k => k.id_kategori),
      tingkatan: form.tingkatan.map(ti => ti.map(t => t.id_tingkatan))
    })).post('')" class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
      <!-- Informasi Perlombaan Section -->
      <div class="mb-8">
        <h2 class="mb-6 text-lg font-semibold text-gray-800">Informasi Perlombaan</h2>

        <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-3">
          <!-- Nama Perlombaan -->
          <div>
            <Label class="mb-2">Nama Perlombaan</Label>
            <Input v-model="form.nama_perlombaan" type="text" placeholder="Masukkan Nama Perlombaan" />
            <InputError :message="form.errors.nama_perlombaan" class="mt-1" />
          </div>
          <!-- Kategori -->
          <div>
            <Label class="mb-2">Kategori</Label>
            <!-- <Popover class="w-full">
              <PopoverTrigger as-child>
                <Button variant="outline" class="w-full justify-start font-normal">
                  Pilih Kategori
                </Button>
              </PopoverTrigger>
              <PopoverContent align="start">
                <div class="flex gap-2 items-center mt-3 first:mt-0" v-for="kategori in list_kategori"
                  :key="kategori.id_kategori">
                  <Checkbox :id="kategori.id_kategori" :value="kategori.id_kategori"
                    :model-value="!!form.kategori.find(m => m.id_kategori == kategori.id_kategori)"
                    @update:model-value="value => value ? form.kategori.push(kategori) : form.kategori = form.kategori.filter(m => m.id_kategori != kategori.id_kategori)" />
                  <Label :for="kategori.id_kategori" class="block w-full">{{ kategori.nama_kategori }}</Label>
                </div>
              </PopoverContent>
            </Popover> -->
            <Combobox by="label"
              @update:model-value="(val) => form.kategori?.find(v => v == val) ? '' : addKategori(val as Kategori)"
              class="w-full">
              <ComboboxAnchor as-child>
                <ComboboxTrigger as-child>
                  <Button variant="outline" class="justify-between w-full font-normal">
                    {{ 'Pilih Kategori' }}

                    <ChevronsUpDown class="ml-2 h-4 w-4 shrink-0 opacity-50" />
                  </Button>
                </ComboboxTrigger>
              </ComboboxAnchor>

              <ComboboxList class="!w-full px-0">
                <div class="relative w-full items-center">
                  <ComboboxInput class="pl-3 w-full focus-visible:ring-0 border-0 border-b rounded-none h-10"
                    placeholder="Cari kategori..." v-model="textKategori" />
                  <span class="absolute start-0 inset-y-0 flex items-center justify-center px-3">
                    <Search class="size-4 text-muted-foreground" />
                  </span>
                </div>

                <!-- <ComboboxEmpty>
                  Add "{{ textKategori }}"
                </ComboboxEmpty> -->

                <ComboboxGroup class="w-full">
                  <ComboboxItem v-for="framework in dataKategori" :key="framework.id_kategori" :value="framework">
                    {{ framework.nama_kategori }}
                    <!-- <ComboboxItemIndicator>
            <Check :class="cn('ml-auto h-4 w-4')" />
          </ComboboxItemIndicator> -->
                  </ComboboxItem>
                </ComboboxGroup>
              </ComboboxList>
            </Combobox>
            <div class="mt-2 flex gap-2 flex-wrap">
              <span class="rounded-full bg-blue-100 px-2 py-1 text-xs text-blue-800 cursor-pointer"
                v-for="kategori in form.kategori" :key="kategori.id_kategori">
                {{ kategori.nama_kategori }}
              </span>
            </div>
            <InputError :message="form.errors.kategori" class="mt-1" />
          </div>
          <!-- Pamflet -->
          <div>
            <Label class="mb-2">Pamflet Perlombaan</Label>
            <InputFile v-model="form.pamflet_perlombaan" />
            <InputError :message="form.errors.pamflet_perlombaan" class="mt-1" />
          </div>
          <div>
            <Label class="mb-2">Tempat Perlombaan</Label>
            <Input v-model="form.tempat_perlombaan" type="text" placeholder="Masukkan tempat perlombaan" />
            <InputError :message="form.errors.tempat_perlombaan" class="mt-1" />
          </div>
          <div class="sm:col-span-2">
            <Label class="mb-2">Tanggal Perlombaan</Label>
            <div class="flex flex-col sm:flex-row items-center gap-x-3 gap-y-0 mt-4 sm:mt-0 w-full">
              <div>
                <Input v-model="form.tanggal_mulai" type="date" class="block w-full"
                  placeholder="Masukkan tanggal mulai" />
                <InputError :message="form.errors.tanggal_mulai" class="mt-1" />
              </div>
              <span>-</span>
              <div>
                <Input v-model="form.tanggal_selesai" type="date" class="block w-full"
                  placeholder="Masukkan tanggal seleatanggal_selesai" />
                <InputError :message="form.errors.tanggal_selesai" class="mt-1" />
              </div>
            </div>
          </div>
          <div>
            <Label class="mb-2">Informasi Rekening</Label>
            <Input v-model="form.rekening" type="text" placeholder="Masukkan informasi rekening" />
            <InputError :message="form.errors.rekening" class="mt-1" />
          </div>
          <div class="col-span-full">
            <Label class="mb-2">Deskripsi</Label>
            <Textarea v-model="form.deskripsi" placeholder="Masukkan deskripsi lomba"></Textarea>
            <InputError :message="form.errors.deskripsi" class="mt-1" />
          </div>
        </div>
      </div>
      <div class="">
        <div class="flex items-center gap-6 mb-6">
          <h2 class="text-lg font-semibold text-gray-800">Informasi Perlombaan</h2>
          <Button type="button" size="sm" @click="form.jumlah_cablom++">Tambah Cablom</Button>
        </div>
        <Alert variant="destructive"
          v-if="form.errors.nama_cablom || form.errors.tingkatan || form.errors.biaya || form.errors.jumlah_anggota">
          <AlertCircle class="w-4 h-4" />
          <!-- <AlertTitle>Error</AlertTitle> -->
          <AlertDescription>
            <div v-if="form.errors.nama_cablom" class="mb-2">{{ form.errors.nama_cablom }}</div>
            <div v-if="form.errors.tingkatan" class="mb-2">{{ form.errors.tingkatan }}</div>
            <div v-if="form.errors.jumlah_anggota" class="mb-2">{{ form.errors.jumlah_anggota }}</div>
            <div v-if="form.errors.biaya" class="mb-2">{{ form.errors.biaya }}</div>
          </AlertDescription>
        </Alert>
        <template v-for="i in form.jumlah_cablom" :key="i">
          <hr>
          <div class="grid grid-cols-1 gap-6 md:grid-cols-3 my-6">
            <div>
              <Label class="mb-2">Nama Cabang Lomba</Label>
              <Input v-model="form.nama_cablom[i - 1]" type="text" placeholder="Masukkan nama cabang lomba" />
            </div>
            <div>
              <Label class="mb-2">Tingkatan</Label>
              <Popover class="w-full">
                <PopoverTrigger as-child>
                  <Button variant="outline" class="w-full justify-start font-normal">
                    Pilih Tingkatan
                  </Button>
                </PopoverTrigger>
                <PopoverContent align="start">
                  <div class="flex gap-2 items-center mt-3 first:mt-0" v-for="tingkatan in list_tingkatan"
                    :key="tingkatan.id_tingkatan">
                    <Checkbox :id="tingkatan.id_tingkatan" :value="tingkatan.id_tingkatan"
                      :model-value="!!form.tingkatan[i - 1]?.find(m => m.id_tingkatan == tingkatan.id_tingkatan)"
                      @update:model-value="value => value ? form.tingkatan[i - 1].push(tingkatan) : form.tingkatan[i - 1] = form.tingkatan[i - 1].filter(m => m.id_tingkatan != tingkatan.id_tingkatan)" />
                    <Label :for="tingkatan.id_tingkatan" class="block w-full">{{ tingkatan.nama_tingkatan }}</Label>
                  </div>
                </PopoverContent>
              </Popover>
              <div class="mt-2 flex gap-2 flex-wrap">
                <span class="rounded-full bg-blue-100 px-2 py-1 text-xs text-blue-800 cursor-pointer"
                  v-for="tingkatan in form.tingkatan[i - 1]" :key="tingkatan.id_tingkatan">
                  {{ tingkatan.nama_tingkatan }}
                </span>
              </div>
            </div>
            <div>
              <Label class="mb-2">Jumlah Maksimal Anggota</Label>
              <Input v-model="form.jumlah_anggota[i - 1]" type="number"
                placeholder="Masukkan jumlah maksimal anggota" />
            </div>
            <div>
              <Label class="mb-2">Biaya Pendaftaran</Label>
              <Input v-model="form.biaya[i - 1]" type="number" placeholder="Masukkan biaya pendaftaran" />
            </div>
          </div>
        </template>
      </div>
      <div class="grid grid-cols-1 gap-6 md:grid-cols-3 my-6">
        <Button>Simpan</Button>
      </div>
    </form>
  </DashboardLayout>
</template>