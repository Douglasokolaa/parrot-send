<script setup>
import {Head, useForm} from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import AuthLayout from "../../Layouts/AuthLayout.vue";

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password"/>
    <auth-layout>
        <template #illustrationTitle>
            <div class="intro-x text-white font-medium text-4xl leading-tight mt-10">
                Forgot Password
            </div>
            <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">
                Manage all your sms campaign in one place
            </div>
        </template>
        <template #cardTitle>
            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                Forgot Password?
            </h2>
            <div v-if="status" class="intro-x mt-2 text-center font-medium text-green-600">
                {{ status }}
            </div>
            <div v-else class="intro-x mt-2 text-slate-400 text-center">

                Forgot your password? No problem. Just let us know your email address and we will email you a password
                reset link that will allow you to choose a new one.

            </div>
        </template>

        <form @submit.prevent="submit">
            <div class="intro-x mt-8">
                <input
                    id="email"
                    placeholder="Email"
                    v-model="form.email"
                    type="email"
                    class="intro-x login__input form-control py-3 px-4 block"
                    required
                    autofocus
                    data-cy="email"
                >
            </div>
            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                <button
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                    class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">
                    Email Password Reset Link
                </button>
            </div>
        </form>
    </auth-layout>
</template>
