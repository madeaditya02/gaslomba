<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const showPassword = ref(false);
const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
<template>
    <AuthLayout>

        <Head title="Login" />

        <div class="flex items-center justify-center bg-cover bg-center px-4"
            :style="{ backgroundImage: 'url(/images/background.png)' }">
            <div class="w-120 max-w-full bg-transparent p-6">
                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Email -->
                    <div>
                        <label for="email" class="mb-1 block text-lg font-extrabold text-white">Email</label>
                        <input id="email" v-model="form.email" type="email" placeholder="Masukkan Email" required
                            class="w-full rounded-2xl bg-white/90 px-5 py-3 font-semibold text-gray-700 shadow-[inset_0_4px_8px_rgba(0,0,0,0.2)] focus:outline-none" />
                        <InputError :message="form.errors.email" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="mb-1 block text-lg font-extrabold text-white">Password</label>
                        <div class="relative">
                            <input id="password" v-model="form.password" :type="showPassword ? 'text' : 'password'"
                                placeholder="Masukkan Password" required
                                class="w-full rounded-2xl bg-white/90 px-5 py-3 font-semibold text-gray-700 shadow-[inset_0_4px_8px_rgba(0,0,0,0.2)] focus:outline-none" />
                            <InputError :message="form.errors.password" class="mt-1" />
                            <span class="absolute inset-y-0 right-3 flex cursor-pointer items-center"
                                @click="togglePassword">
                                <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M2.458 10C3.732 6.943 6.94 5 10 5c3.06 0 6.268 1.943 7.542 5-1.274 3.057-4.482 5-7.542 5-3.06 0-6.268-1.943-7.542-5zM10 7a3 3 0 100 6 3 3 0 000-6z" />
                                </svg>
                                <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                        class="w-full rounded-2xl border-2 border-white py-2 text-lg font-extrabold text-white transition hover:bg-white/10">
                        LOGIN
                    </button>

                    <!-- Register -->
                    <p class="text-center text-sm text-white">
                        Belum memiliki akun?
                        <a :href="route('register')" class="font-bold underline">REGISTER</a>
                    </p>
                </form>
            </div>
        </div>
    </AuthLayout>
</template>

<style scoped>
body {
    font-family: 'Poppins', sans-serif;
}
</style>
