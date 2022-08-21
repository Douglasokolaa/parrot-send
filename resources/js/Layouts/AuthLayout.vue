<script setup>
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue';
import 'mosha-vue-toastify/dist/style.css';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import DarkModeSwitcher from "@/Components/dark-mode-switcher/Main.vue";

defineProps({
    title: String,
});
</script>

<template>
    <div>
      <DarkModeSwitcher />
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a
                        :href="route('home')"
                        class="-intro-x flex items-center pt-5">
                        <jet-application-mark class="w-6"/>
                        <span class="text-white text-lg ml-3"> {{ $page.props.app.name }} </span>
                    </a>
                    <div class="my-auto">
                        <img
                            alt="i"
                            class="-intro-x w-1/2 -mt-16"
                            src="/dist/images/illustration.svg">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            <slot name="illustrationTitle"></slot>
                        </div>
                    </div>
                </div>
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div
                        class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <div class="flex xl:hidden justify-center intro-x font-bold mb-4">
                            <a
                                :href="route('home')"
                                class="-intro-x flex items-center pt-5">
                                <jet-application-mark class="w-6"/>
                            </a>
                        </div>
                        <slot name="cardTitle"></slot>
                        <jet-validation-errors class="mb-4"/>
                        <slot/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
