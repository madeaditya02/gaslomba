<script setup lang="ts">
import { Link, router, usePage } from '@inertiajs/vue3';
// import { computed, ref } from 'vue';

defineProps<{ show: boolean }>()
defineEmits(['close'])
const page = usePage()

// const username = computed(() => page.props.auth.user.mahasiswa ? page.props.auth.user.mahasiswa.nama : (page.props.auth.user.dosen ? page.props.auth.user.dosen.nama : page.props.auth.user.admin.nama))
// const role = computed(() => page.props.auth.user.mahasiswa ? "Mahasiswa" : (page.props.auth.user.dosen ? "Dosen" : "Admin"))

// const confirmLogout = ref(false)
</script>
<template>
  <div
    class="sidebar w-72 text-white bg-primary rounded-r-[3rem] fixed left-0 top-0 bottom-0 px-8 py-8 max-h-screen flex flex-col transition-all duration-200 z-30"
    :class="!show ? '-ml-72 lg:ml-0' : 'ml-0'">
    <Link href="/">
    <img src="/assets/logo.png" alt="" class="w-52 max-w-full mx-auto mt-5">
    </Link>
    <div class="mt-7">
      <h2 class="text-lg text-center">
        {{ page.props.auth.user.penyelenggara?.nama_penyelenggara ?? page.props.auth.user.peserta?.nama }}
      </h2>
      <hr class="h-0.5 bg-white mt-2">
    </div>
    <div class="mt-12 flex flex-col justify-between grow">
      <div>
        <Link href="/dashboard" class="inline-flex gap-3 items-center w-full mb-5.5 last:mb-0"
          :class="$page.url == '/dashboard' ? 'text-white' : 'text-white/50'">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
          <path fill-rule="evenodd"
            d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
            clip-rule="evenodd" />
        </svg>
        Profil
        </Link>
        <Link href="/dashboard/lomba" class="inline-flex gap-3 items-center w-full mb-5.5 last:mb-0"
          :class="$page.url.startsWith('/dashboard/lomba') ? 'text-white' : 'text-white/50'">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
          <path fill-rule="evenodd"
            d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 0 0-.584.859 6.753 6.753 0 0 0 6.138 5.6 6.73 6.73 0 0 0 2.743 1.346A6.707 6.707 0 0 1 9.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 0 0-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 0 1-1.112-3.173 6.73 6.73 0 0 0 2.743-1.347 6.753 6.753 0 0 0 6.139-5.6.75.75 0 0 0-.585-.858 47.077 47.077 0 0 0-3.07-.543V2.62a.75.75 0 0 0-.658-.744 49.22 49.22 0 0 0-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 0 0-.657.744Zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 0 1 3.16 5.337a45.6 45.6 0 0 1 2.006-.343v.256Zm13.5 0v-.256c.674.1 1.343.214 2.006.343a5.265 5.265 0 0 1-2.863 3.207 6.72 6.72 0 0 0 .857-3.294Z"
            clip-rule="evenodd" />
        </svg>
        Perlombaan
        </Link>
      </div>
      <div class="h-full flex flex-col justify-end">
        <button class="inline-flex gap-3 items-center w-full cursor-pointer" @click="router.post('/logout')">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
            <path fill-rule="evenodd"
              d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z"
              clip-rule="evenodd" />
          </svg>
          Log Out
        </button>
      </div>
    </div>
  </div>
  <div class="sidebar-overlay fixed inset-0 bg-[rgba(0,0,0,0.3)] z-20" :class="show ? 'block lg:hidden' : 'hidden'"
    @click="$emit('close')">
  </div>

  <!-- <ConfirmModal :open="confirmLogout" @update-open="opened => confirmLogout = opened" title="Logout"
    text="Anda yakin ingin logout?" confirm-button="Logout" @confirm="router.post('/logout')" /> -->
</template>