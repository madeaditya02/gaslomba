<script setup lang="ts">
defineProps < {
  placeholder: string,
  options: { id: any, value: any }[]
} > ()
const values = defineModel < { id: any, value: any }[] > ()
</script>
<template>
  <Popover class="w-full">
    <PopoverTrigger as-child>
      <Button variant="outline" class="w-full mt-2 justify-start font-normal">
        {{ placeholder }}
      </Button>
    </PopoverTrigger>
    <PopoverContent align="start">
      <div class="flex gap-2 items-center mt-3 first:mt-0" v-for="option in options" :key="option.id">
        <Checkbox :id="option.id" :value="option.id" :model-value="!!options.find(o => o.id == option.id)"
          @update:model-value="value => value ? values?.push(option) : form.mata_kuliah = form.mata_kuliah.filter(m => m.kode != matkul.kode)" />
        <Label :for="matkul.kode">{{ matkul.kode }} - {{ matkul.nama_matakuliah }}</Label>
      </div>
    </PopoverContent>
  </Popover>
</template>