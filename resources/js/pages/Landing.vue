<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';

defineProps<{
  data: {
    id_lomba: number,
    nama_perlombaan: string,
    pamflet_perlombaan: string
  }[]
}>()
</script>

<template>
  <AppLayout>
    <div class="items-center justify-center flex flex-col gap-5 md:pt-5 pt-50">
      <div class="flex justify-start w-full md:pt-10">
        <img src="/assets/rokettt.png" class="relative lg:w-180 md:w-110 w-95 md:ml-12 mx-auto" />
      </div>
      <div class="mt-30 flex flex-col items-center justify-center">
        <h1 class="grobold-font md:text-3xl lg:text-4xl">Kompetensi Tepat untuk Potensi Hebatmu !</h1>
        <div class="flex md:flex-row flex-col items-center justify-center md:gap-3 gap-5 md:pt-15 pt-8">
          <div
            class="lg:w-[260px] md:w-[220px] w-[310px] lg:h-[405px] md:h-[370px] h-[450px] bg-silver rounded-lg mt-5 items-center flex flex-col hover:shadow-[0_0_20px_4px_rgba(59,130,246,0.5)] transition-shadow duration-300"
            v-for="lomba in data" :key="lomba.id_lomba">
            <img :src="lomba.pamflet_perlombaan"
              class="lg:w-[220px] lg:h-[320px] md:w-[190px] md:h-[290px] w-[270px] h-[370px] mt-5 rounded-md" />
            <Button
              class="lg:w-[220px] md:w-[190px] w-[270px] h-[30px] bg-blue-950 text-white md:mt-5 mt-3 hover:bg-blue-900"
              as-child>
              <Link :href="`/lomba/${lomba.id_lomba}`">Lihat Detail</Link>
            </Button>
          </div>
          <!-- <div class="lg:w-[260px] md:w-[220px] w-[310px] lg:h-[405px] md:h-[370px] h-[450px] bg-silver rounded-lg mt-5 items-center flex flex-col hover:shadow-[0_0_20px_4px_rgba(59,130,246,0.5)] transition-shadow duration-300">
              <img src="/assets/poster2.jpg" class="lg:w-[220px] lg:h-[320px] md:w-[190px] md:h-[290px] w-[270px] h-[370px] mt-5 rounded-md"/>
              <Button class="lg:w-[220px] md:w-[190px] w-[270px] h-[30px] bg-blue-950 text-white md:mt-5 mt-3 hover:bg-blue-900">Lihat Detail</Button>
          </div>
          <div class="lg:w-[260px] md:w-[220px] w-[310px] lg:h-[405px] md:h-[370px] h-[450px] bg-silver rounded-lg mt-5 items-center flex flex-col hover:shadow-[0_0_20px_4px_rgba(59,130,246,0.5)] transition-shadow duration-300">
              <img src="/assets/poster3.jpg" class="lg:w-[220px] lg:h-[320px] md:w-[190px] md:h-[290px] w-[270px] h-[370px] mt-5 rounded-md"/>
              <Button class="lg:w-[220px] md:w-[190px] w-[270px] h-[30px] bg-blue-950 text-white md:mt-5 mt-3 hover:bg-blue-900">Lihat Detail</Button>
          </div> -->
        </div>
        <Link href="/explore"
          class="px-10 py-2 mt-15 mb-15 rounded-md bg-silver font-semibold hover:shadow-[0_0_20px_2px_rgba(59,130,246,0.5)] transition-shadow duration-300">
        Explore Lebih Banyak! > </Link>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
@font-face {
  font-family: 'Grobold';
  src: url('/assets/Grobold.ttf') format('truetype');
  font-weight: normal;
  font-style: normal;
}

.grobold-font {
  font-family: 'Grobold', sans-serif;
  color: white;
  text-shadow: 0 0 10px rgba(255, 170, 1, 1);
}
</style>