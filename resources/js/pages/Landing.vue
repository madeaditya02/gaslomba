<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <AppLayout>
    <div class="items-center justify-center flex flex-col gap-5 pt-5">
      <div class="flex justify-start pt-5">
        <img src="/assets/rokettt.png" class="relative w-180 mr-150"/>
      </div>
      <div class="mt-20 flex flex-col items-center justify-center">
        <h1 class="grobold-font text-4xl">Kompetensi Tepat untuk Potensi Hebatmu !</h1>
        <div class="flex flex-row items-center justify-center gap-5 pt-15">
          <div class="w-[260px] h-[405px] bg-silver rounded-lg mt-5 items-center flex flex-col hover:shadow-[0_0_20px_4px_rgba(59,130,246,0.5)] transition-shadow duration-300">
              <img src="/assets/poster1.jpg" class="w-[220px] h-[320px] mt-5 rounded-md"/>
              <Button href="/lomba"class="w-[220px] h-[30px] bg-blue-950 text-white mt-5 hover:bg-blue-900">Lihat Detail</Button>
          </div>
          <div class="w-[260px] h-[405px] bg-silver rounded-lg mt-5 items-center flex flex-col hover:shadow-[0_0_20px_4px_rgba(59,130,246,0.5)] transition-shadow duration-300">
              <img src="/assets/poster2.jpg" class="w-[220px] h-[320px] mt-5 rounded-md"/>
              <Button class="w-[220px] h-[30px] bg-blue-950 text-white mt-5 hover:bg-blue-900">Lihat Detail</Button>
          </div>
          <div class="w-[260px] h-[405px] bg-silver rounded-lg mt-5 items-center flex flex-col hover:shadow-[0_0_20px_4px_rgba(59,130,246,0.5)] transition-shadow duration-300">
              <img src="/assets/poster3.jpg" class="w-[220px] h-[320px] mt-5 rounded-md"/>
              <Button class="w-[220px] h-[30px] bg-blue-950 text-white mt-5 hover:bg-blue-900">Lihat Detail</Button>
          </div>
        </div>
        <Link href="/explore" class="px-10 py-2 my-10 mb-15 rounded-md bg-silver font-semibold hover:shadow-[0_0_20px_2px_rgba(59,130,246,0.5)] transition-shadow duration-300">Explore Lebih Banyak! > </Link>
      </div>
    </div>
  </AppLayout>
</template> 

<style scoped>
@font-face {
  font-family: 'Grobold';
  src: url('/fonts/Grobold.ttf') format('truetype');
  font-weight: normal;
  font-style: normal;
}

.grobold-font {
  font-family: 'Grobold', sans-serif;
  text-shadow: 0 0 10px rgba(255,170,1,1);
}

</style>