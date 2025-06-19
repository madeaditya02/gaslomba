<script setup>
import AppLayout from "@/layouts/AppLayout.vue";
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import {
  Pagination,
  PaginationContent,
  PaginationEllipsis,
  PaginationItem,
  PaginationNext,
  PaginationPrevious,
} from '@/components/ui/pagination'
</script>
<template>
    <AppLayout>
        <div class="items-center justify-center flex flex-row gap-5 pt-5">
            <div class="w-fit relative">
                <img src="/assets/kaca.png" class="w-[16px] h-[16px] absolute top-1/2 left-4 -translate-y-1/2" />
                <Input placeholder="Cari Lomba" class="w-[260px] bg-silver pl-10 text-blue-950 placeholder:text-blue-950 placeholder:font-semibold font-semibold" />
            </div>
            <div class="w-fit relative">
                <img src="/assets/org.png" class="w-[16px] h-[16px] absolute top-1/2 left-4 -translate-y-1/2" />
                <Select>
                    <SelectTrigger class="w-[260px] bg-silver pl-10 text-blue-950 placeholder:text-blue-950 placeholder:font-semibold font-semibold">
                    <SelectValue placeholder="Jenjang" class="text-blue-950"/>
                    </SelectTrigger>
                    <SelectContent>
                    <SelectGroup class="text-blue-950 bg-silver">
                        <SelectItem value="1">
                        1
                        </SelectItem>
                        <SelectItem value="2">
                        2
                        </SelectItem>
                        <SelectItem value="3">
                        3
                        </SelectItem>
                    </SelectGroup>
                    </SelectContent>
                </Select>             
            </div>

            <div class="w-fit relative">
                <img src="/assets/segi.png" class="w-[16px] h-[16px] absolute top-1/2 left-4 -translate-y-1/2" />
                <Select>
                    <SelectTrigger class="w-[260px] bg-silver pl-10 text-blue-950 placeholder:text-blue-950 placeholder:font-semibold font-semibold">
                    <SelectValue placeholder="Kategori" class="text-blue-950"/>
                    </SelectTrigger>
                    <SelectContent>
                    <SelectGroup class="text-blue-950 bg-silver">
                        <SelectItem value="1">
                        1
                        </SelectItem>
                        <SelectItem value="2">
                        2
                        </SelectItem>
                        <SelectItem value="3">
                        3
                        </SelectItem>
                    </SelectGroup>
                    </SelectContent>
                </Select>
            </div>

            <Button class="border-2 border-slate-300 w-[260px] text-white bg-0 hover:bg-white/10">Search</Button>
        </div>
        <div class="flex flex-row items-center justify-center gap-5 pt-15">
            <div class="w-[260px] h-[405px] bg-silver rounded-lg mt-5 items-center flex flex-col hover:shadow-[0_0_20px_4px_rgba(59,130,246,0.5)] transition-shadow duration-300">
                <img src="/assets/poster1.jpg" class="w-[220px] h-[320px] mt-5 rounded-md"/>
                <Button class="w-[220px] h-[30px] bg-blue-950 text-white mt-5 hover:bg-blue-900">Lihat Detail</Button>
            </div>
            <div class="w-[260px] h-[405px] bg-silver rounded-lg mt-5 items-center flex flex-col hover:shadow-[0_0_20px_4px_rgba(59,130,246,0.5)] transition-shadow duration-300">
                <img src="/assets/poster2.jpg" class="w-[220px] h-[320px] mt-5 rounded-md"/>
                <Button class="w-[220px] h-[30px] bg-blue-950 text-white mt-5 hover:bg-blue-900">Lihat Detail</Button>
            </div>
            <div class="w-[260px] h-[405px] bg-silver rounded-lg mt-5 items-center flex flex-col hover:shadow-[0_0_20px_4px_rgba(59,130,246,0.5)] transition-shadow duration-300">
                <img src="/assets/poster3.jpg" class="w-[220px] h-[320px] mt-5 rounded-md"/>
                <Button class="w-[220px] h-[30px] bg-blue-950 text-white mt-5 hover:bg-blue-900">Lihat Detail</Button>
            </div>
            <div class="w-[260px] h-[405px] bg-silver rounded-lg mt-5 items-center flex flex-col hover:shadow-[0_0_20px_4px_rgba(59,130,246,0.5)] transition-shadow duration-300">
                <img src="/assets/poster4.jpg" class="w-[220px] h-[320px] mt-5 rounded-md"/>
                <Button class="w-[220px] h-[30px] bg-blue-950 text-white mt-5 hover:bg-blue-900">Lihat Detail</Button>
            </div>
        </div>
        <Pagination v-slot="{ page }" :items-per-page="10" :total="30" :default-page="2" class="py-15">
            <PaginationContent v-slot="{ items }"class="flex items-center justify-center gap-2">
            <PaginationPrevious class="px-3 py-1 rounded bg-silver hover:shadow-[0_0_20px_2px_rgba(59,130,246,0.5)] transition-shadow duration-300"/>

            <template v-for="(item, index) in items" :key="index">
                <PaginationItem
                    v-if="item.type === 'page'"
                    :value="item.value"
                    :is-active="item.value === page"
                    :class="[
                    'px-3 py-1 rounded hover:shadow-[0_0_20px_2px_rgba(59,130,246,0.5)]  transition-shadow duration-300',
                    item.value === page
                        ? 'bg-gray-400 text-white font-semibold !border-white !border-1'
                        : 'bg-silver text-blue-950'
                    ]"
                >
                {{ item.value }}
                </PaginationItem>
            </template>

            <PaginationEllipsis :index="4" />

            <PaginationNext class="px-3 py-1 rounded bg-silver hover:shadow-[0_0_20px_2px_rgba(59,130,246,0.5)] transition-shadow duration-300"/>
            </PaginationContent>
        </Pagination>       
    </AppLayout>
</template>