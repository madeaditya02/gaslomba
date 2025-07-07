<script setup lang="ts">
import DashboardLayout from '@/layouts/DashboardLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input'
import InputError from '@/components/InputError.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { Penyelenggara } from '@/types';
import InputFile from '@/components/InputFile.vue';
import { computed } from 'vue';
import { toast } from 'vue-sonner';

const props = defineProps<{
  penyelenggara: Penyelenggara,
}>()

const page = usePage()
const form = useForm({
  nama_penyelenggara: props.penyelenggara.nama_penyelenggara,
  // email: props.penyelenggara.nama,
  alamat: props.penyelenggara.alamat,
  provinsi: props.penyelenggara.provinsi,
  nomor_telepon: props.penyelenggara.nomor_telepon,
  asal_instansi: props.penyelenggara.asal_instansi,
  profile_picture: null
})
const previewImage = computed(() => {
  if (form.profile_picture) {
    return URL.createObjectURL(form.profile_picture)
  }
  return props.penyelenggara.profile_picture
})
const clickInput = () => {
  document.querySelector<HTMLInputElement>('.profile-input')?.click()
}
</script>

<template>
  <DashboardLayout>
    <div class="border bg-white border-gray-300 rounded-md px-5 py-3">
      <h1 class="text-slate-800 font-semibold md:text-xl text-md">Selamat Datang, {{ penyelenggara.nama_penyelenggara }}
        !</h1>
    </div>
    <form action="" @submit.prevent="form.post('', { onSuccess: () => toast.success('Profil berhasil diperbarui') })">
      <div class="mt-15 flex lg:flex-row flex-col justify-between items-start">
        <div
          class="border border-primary rounded-full size-40 flex justify-center items-center shadow-[0_0_15px_rgba(0,0,0,0.3)] shadow-primary">
          <img :src="previewImage" alt="Profile Image" class="w-40 rounded-full" @click="clickInput" />
          <InputFile v-model="form.profile_picture" accept="image/*" class="hidden profile-input" />
        </div>
        <div class="flex md:flex-row flex-col md:gap-10 gap-5">
          <div class="flex flex-col md:gap-7 gap-5">
            <div>
              <h1 class="text-slate-800 font-semibold text-lg">Nama Penyelenggara</h1>
              <Input placeholder="Masukkan nama penyelenggara" v-model="form.nama_penyelenggara"
                class="w-[300px] button-white placeholder:text-slate-600 mt-2" />
              <InputError :message="form.errors.nama_penyelenggara" />
            </div>
            <div>
              <h1 class="text-slate-800 font-semibold text-lg">Alamat
              </h1>
              <Input v-model="form.alamat" :placeholder="`Masukkan alamat`"
                class="w-[300px] button-white placeholder:text-slate-600 mt-2" />
              <InputError :message="form.errors.alamat" />
            </div>
            <div>
              <h1 class="text-slate-800 font-semibold text-lg">Asal Instansi</h1>
              <Input placeholder="Masukkan nama instansi" v-model="form.asal_instansi"
                class="w-[300px] button-white placeholder:text-slate-600 mt-2" />
              <InputError :message="form.errors.asal_instansi" />
            </div>
          </div>
          <div class="flex flex-col md:gap-7 gap-5">
            <div>
              <h1 class="text-slate-800 font-semibold text-lg">Email</h1>
              <Input placeholder="Masukkan email" disabled :default-value="page.props.auth.user.email"
                class="w-[300px] button-white placeholder:text-slate-600 mt-2" />
            </div>
            <div>
              <h1 class="text-slate-800 font-semibold text-lg">Nomor Telepon</h1>
              <Input placeholder="Masukkan no. telepon" v-model="form.nomor_telepon"
                class="w-[300px] button-white placeholder:text-slate-600 mt-2" />
              <InputError :message="form.errors.nomor_telepon" />
            </div>
            <div>
              <h1 class="text-slate-800 font-semibold text-lg">Provinsi
              </h1>
              <Input v-model="form.provinsi" :placeholder="`Masukkan asal provinsi`"
                class="w-[300px] button-white placeholder:text-slate-600 mt-2" />
              <InputError :message="form.errors.provinsi" />
            </div>
          </div>
        </div>
      </div>
      <div class="flex lg:justify-end justify-center px-30 mb-10 md:mb-0">
        <Button class="text-white w-[300px] mt-10">SIMPAN</Button>
      </div>
    </form>
  </DashboardLayout>
</template>