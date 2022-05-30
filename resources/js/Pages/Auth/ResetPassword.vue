<script setup>
import {Head, useForm} from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetLabel from '@/Jetstream/Label.vue';
import AuthLayout from "../../Layouts/AuthLayout";

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Reset Password"/>
    <auth-layout>
        <template #illustrationTitle>
            <div class="intro-x text-white font-medium text-4xl leading-tight mt-10">
                Set Password
            </div>
            <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">
                Manage all your sms campaign in one place
            </div>
        </template>
        <template #cardTitle>
            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                Set New Password
            </h2>
        </template>

        <form @submit.prevent="submit">
            <div class="intro-x mt-8">
                <input
                    placeholder="Email"
                    class="intro-x login__input form-control py-3 px-4 block mt-4"
                    id="email"
                    v-model="form.email"
                    type="email"
                    required
                    readonly
                    autofocus
                >
                <input
                    placeholder="Password"
                    class="intro-x login__input form-control py-3 px-4 block mt-4"
                    id="password"
                    v-model="form.password"
                    type="password"
                    required
                    autocomplete="new-password"
                >
                <input
                    placeholder="Confirm Password"
                    class="intro-x login__input form-control py-3 px-4 block mt-4"
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                >
                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                    <button
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Reset Password
                    </button>
                </div>
            </div>
        </form>
    </auth-layout>
</template>
