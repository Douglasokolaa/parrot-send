<script setup>
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import AuthLayout from "../../Layouts/AuthLayout.vue";

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register"/>
    <AuthLayout>
        <template #illustrationTitle>
            <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                A few more clicks to
                <br>
                sign up to your account.
            </div>
            <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">
                Manage all your SMS Campaigns in one place
            </div>
        </template>

        <template #cardTitle>
            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                Sign Up
            </h2>
            <div class="intro-x mt-2 text-slate-400 dark:text-slate-400 xl:hidden text-center">
                A few more clicks to sign in to your account. Manage all your SMS Campaigns in one place
            </div>
        </template>

        <form @submit.prevent="submit">
            <div class="intro-x mt-8">
                <input
                    id="name"
                    type="text"
                    class="intro-x login__input form-control py-3 px-4 block"
                    placeholder="First Name"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                >
                <input
                    id="email"
                    v-model="form.email"
                    type="email"
                    required
                    class="intro-x login__input form-control py-3 px-4 block mt-4"
                    placeholder="Last Name"
                >
                <input
                    class="intro-x login__input form-control py-3 px-4 block mt-4"
                    placeholder="Password"
                    id="password"
                    v-model="form.password"
                    type="password"
                    required
                    autocomplete="new-password"
                >
                <input
                    class="intro-x login__input form-control py-3 px-4 block mt-4"
                    placeholder="Password Confirmation"
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                >

                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                    <div class="intro-x flex items-center text-slate-600 dark:text-slate-500 mt-4 text-xs sm:text-sm">
                        <JetCheckbox id="terms" v-model:checked="form.terms" name="terms"/>
                        <label for="terms" class="cursor-pointer select-none pl-2">
                            I agree to the
                            <a target="_blank" :href="route('terms.show')"
                               class="text-primary dark:text-slate-200 ml-1">Terms of Service</a>.
                            and <a target="_blank" :href="route('policy.show')"
                                   class="text-primary dark:text-slate-200 ml-1" href="">Privacy Policy</a>.
                        </label>
                    </div>
                </div>
                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                    <button
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Register
                    </button>
                    <Link
                        :href="route('login')"
                        class="btn btn-outline-secondary py-3 px-4 w-full xl:w-72 mt-3 xl:mt-0 align-top"
                    >
                        Already registered? Sign in
                    </Link>
                </div>
            </div>
        </form>
    </AuthLayout>
</template>
