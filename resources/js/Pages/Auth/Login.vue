<script>
import BlankLayout from "../../Layouts/BlankLayout.vue";

export default {
  layout: BlankLayout
}
</script>
<script setup>
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import AuthLayout from "../../Layouts/AuthLayout.vue";

defineProps({
  canResetPassword: Boolean,
  status: String,
  canRegister: Boolean,
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
  <Head title="Log in"/>
  <AuthLayout>
    <template #cardTitle>
      <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
        Sign In
      </h2>
      <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">
        A few more clicks to sign in to your account.
      </div>
    </template>
    <template #illustrationTitle>
      <div class="intro-x text-white font-medium text-4xl leading-tight mt-10">
        A few more clicks to
        <br>
        sign in to your account.
      </div>
      <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">
        Manage all your sms campaign in one place
      </div>

    </template>

    <form @submit.prevent="submit">
      <div class="intro-x mt-8">
        <input
            id="email"
            name="email"
            type="text"
            class="intro-x login__input form-control py-3 px-4 block"
            placeholder="Email"
            v-model="form.email"
            required
            autofocus
            data-cy="email"
        >
        <input
            type="password"
            class="intro-x login__input form-control py-3 px-4 block mt-4"
            placeholder="Password"
            name="password"
            required
            autocomplete="password"
            v-model="form.password"
            data-cy="password"
        >
      </div>
      <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
        <div class="flex items-center mr-auto">
          <input
              id="remember-me"
              type="checkbox"
              class="form-check-input border mr-2"
              v-model="form.remember"
              name="remember"
              data-cy="remember-me"
          >
          <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
        </div>
        <Link
            v-if="canResetPassword"
            :href="route('password.request')"
            class="underline text-sm  hover:text-gray-900"
            datacy="forgot-password"
        >
          Forgot your password?
        </Link>
      </div>
      <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
        <button
            :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
            class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top"
            data-cy="login"
        >Login
        </button>
        <Link
            :href="route('register')"
            v-if="canRegister"
            class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">
          Register
        </Link>
      </div>
    </form>
  </AuthLayout>
</template>
