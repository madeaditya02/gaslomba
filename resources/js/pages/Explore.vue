<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    //   SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'
import {
    Pagination,
    PaginationContent,
    PaginationItem,
    PaginationNext,
    PaginationPrevious,
} from '@/components/ui/pagination'
import { Link, useForm } from '@inertiajs/vue3';
import { Kategori, Lomba, Tingkatan, Paginator } from "@/types";

const props = defineProps<{
    data: Paginator<Lomba>,
    tingkatan: Tingkatan[],
    kategori: Kategori[],
    filter: {
        search: string,
        tingkatan: string,
        kategori: string,
    }
}>()

const formFilter = useForm({
    search: props.filter.search ?? '',
    tingkatan: props.filter.tingkatan ?? '',
    kategori: props.filter.kategori ?? '',
})
</script>
<template>
    <AppLayout>
        <form @submit.prevent="formFilter.get('')"
            class="items-center justify-center flex lg:flex-row flex-col gap-5 pt-5">
            <div class="w-fit relative">
                <img src="/assets/kaca.png" class="w-[16px] h-[16px] absolute top-1/2 left-4 -translate-y-1/2" />
                <Input placeholder="Cari Lomba" v-model="formFilter.search"
                    class="lg:w-[260px] w-[310px] text-sm bg-silver pl-10 text-blue-950 placeholder:text-blue-950 placeholder:font-semibold font-semibold" />
            </div>
            <div class="w-fit relative">
                <img src="/assets/org.png" class="w-[16px] h-[16px] absolute top-1/2 left-4 -translate-y-1/2" />
                <Select v-model="formFilter.tingkatan">
                    <SelectTrigger
                        class="lg:w-[260px] w-[310px] bg-silver pl-10 text-blue-950 placeholder:text-blue-950 placeholder:font-semibold font-semibold">
                        <SelectValue placeholder="Jenjang" class="text-blue-950" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup class="text-blue-950 bg-silver">
                            <SelectItem :value="t.id_tingkatan" v-for="t in tingkatan" :key="t.id_tingkatan">{{
                                t.nama_tingkatan }}</SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>

            <div class="w-fit relative">
                <img src="/assets/segi.png" class="w-[16px] h-[16px] absolute top-1/2 left-4 -translate-y-1/2" />
                <Select v-model="formFilter.kategori">
                    <SelectTrigger
                        class="lg:w-[260px] w-[310px] bg-silver pl-10 text-blue-950 placeholder:text-blue-950 placeholder:font-semibold font-semibold">
                        <SelectValue placeholder="Kategori" class="text-blue-950" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup class="text-blue-950 bg-silver">
                            <SelectItem :value="k.id_kategori" v-for="k in kategori" :key="k.id_kategori">{{
                                k.nama_kategori }}</SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>

            <Button
                class="border-2 border-slate-300 lg:w-[260px] w-[310px] text-white bg-0 hover:bg-white/10">Search</Button>
        </form>

        <div class="flex md:flex-row flex-col items-center justify-center md:gap-3 gap-5 md:pt-15 pt-8">
            <div class="lg:w-[260px] md:w-[220px] w-[310px] lg:h-[405px] md:h-[370px] h-[450px] bg-silver rounded-lg mt-5 items-center flex flex-col hover:shadow-[0_0_20px_4px_rgba(59,130,246,0.5)] transition-shadow duration-300"
                v-for="lomba in data.data" :key="lomba.id_lomba">
                <img :src="lomba.pamflet_perlombaan"
                    class="lg:w-[220px] lg:h-[320px] md:w-[190px] md:h-[290px] w-[270px] h-[370px] mt-5 rounded-md" />
                <Button href="/lomba"
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

        <Pagination v-slot="{ page }" :items-per-page="data.meta.per_page" :total="data.meta.total"
            :default-page="data.meta.current_page" class="py-20">
            <PaginationContent v-slot="{ items }" class="flex items-center justify-center gap-2">
                <PaginationPrevious
                    class="px-3 py-1 rounded bg-silver hover:shadow-[0_0_20px_2px_rgba(59,130,246,0.5)] transition-shadow duration-300" />

                <template v-for="(item, index) in items" :key="index">
                    <PaginationItem v-if="item.type === 'page'" :value="item.value" :is-active="item.value === page"
                        :class="[
                            'px-3 py-1 rounded hover:shadow-[0_0_20px_2px_rgba(59,130,246,0.5)]  transition-shadow duration-300',
                            item.value === page
                                ? 'bg-gray-400 text-white font-semibold !border-white !border-1'
                                : 'bg-silver text-blue-950'
                        ]">
                        <Link :href="data.meta.links[index + 1].url">
                        {{ item.value }}
                        </Link>
                    </PaginationItem>
                </template>

                <!-- <PaginationEllipsis :index="4" class="text-white" /> -->

                <PaginationNext
                    class="px-3 py-1 rounded bg-silver hover:shadow-[0_0_20px_2px_rgba(59,130,246,0.5)] transition-shadow duration-300" />
            </PaginationContent>
        </Pagination>
    </AppLayout>
</template>