<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ButtonLogin from '@/Components/ButtonLogin.vue';


defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

<div class="w-full h-full bg-no-repeat bg-cover">
    <Head title="Log in" />

    <AuthenticationCard>
        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="w-full mb-4 -ml-8 text-4xl text-blue-800 txt_titulo font-Montserrat">
                Iniciar Sesión
            </div>
            <div class="mb-24 -ml-8 text-lg text-gray-400 font-Montserra">
                PLATAFORMA MANIOBRAS P&G.
            </div>
            <div>
                <div class="w-full text-lg duration-300 transform bg-transparent border-b-2 focus-within:border-indigo-500">
                    <TextInput id="email" v-model="form.email" type="email" required autofocus
                        placeholder="Usuario"
                        class="w-full bg-transparent border-none outline-none placeholder:italic focus:outline-none" />
                </div>
                <InputError class="mt-2 font-Montserrat" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <div class="w-full text-lg duration-300 transform bg-transparent border-b-2 focus-within:border-indigo-500">
                    <TextInput id="password" v-model="form.password" type="password" required
                    placeholder="Contraseña"
                    autocomplete="current-password" class="w-full bg-transparent border-none outline-none placeholder:italic focus:outline-none" />
            </div>
            <InputError class="mt-2 font-Montserrat" :message="form.errors.password" />
            </div>


            <div class="flex items-center justify-end mt-4">

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>

            
        </form>
    </AuthenticationCard>


</div>
</template>
