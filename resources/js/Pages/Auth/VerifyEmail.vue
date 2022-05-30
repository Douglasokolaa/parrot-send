<script setup>
import {computed} from 'vue';
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import AuthLayout from "../../Layouts/AuthLayout";

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head title="Email Verification"/>
    <AuthLayout>
        <template #illustrationTitle>
            <div class="intro-x text-white font-medium text-4xl leading-tight mt-10">
                Verify Email
            </div>
            <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">
                Manage all your sms campaign in one place
            </div>
        </template>
        <template #cardTitle>
            <div class="intro-x mt-2 text-slate-400 text-center">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the
                link we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </div>
            <div class="intro-x mt-8">
                <div v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-green-600">
                    A new verification link has been sent to the email address you provided during registration.
                </div>
            </div>
        </template>

        <form @submit.prevent="submit">
            <div class="intro-x mt-8">
                <input
                    id="email"
                    placeholder="Email"
                    v-model="form.email"
                    type="email"
                    class="intro-x login__input form-control py-3 px-4 block mt-4"
                    required
                    autofocus
                    data-cy="email"
                >
            </div>
            <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                <button
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                    class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">
                    Resend Verification Email
                </button>
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="underline text-sm justify-end text-gray-600 hover:text-gray-900 mt-4"
                >
                    Log Out
                </Link>
            </div>
        </form>
    </AuthLayout>
</template>
