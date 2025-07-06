<script setup lang="ts">
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogClose
  // DialogTrigger,
} from '@/components/ui/dialog'
import Button from './ui/button/Button.vue';

defineProps<{
  open: boolean,
  title?: string,
  text?: string,
  confirmButton?: string,
  cancelButton?: string,
}>()
defineEmits(['update-open', 'confirm'])
</script>
<template>
  <Dialog :open="open" @update:open="opened => $emit('update-open', opened)">
    <DialogContent>
      <DialogHeader>
        <DialogTitle v-if="title">{{ title }}</DialogTitle>
        <DialogDescription v-if="text">
          {{ text }}
        </DialogDescription>
      </DialogHeader>
      <slot />
      <DialogFooter class="flex gap-6 w-full justify-end">
        <DialogClose as-child>
          <Button variant="secondary">{{ cancelButton ?? 'Batal' }}</Button>
        </DialogClose>
        <Button @click="$emit('confirm')" v-if="confirmButton">{{ confirmButton ?? 'Ya' }}</Button>
      </DialogFooter>
    </DialogContent>
  </Dialog>
</template>