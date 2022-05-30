<script setup>
import {computed} from 'vue';
import {usePage} from '@inertiajs/inertia-vue3';

const errors = computed(() => usePage().props.value.errors);
const hasErrors = computed(() => Object.keys(errors.value).length > 0);

</script>

<template>
    <div v-if="hasErrors">
        <div id="failed-notification-content" class="content hidden flex">
            <i class="text-danger" data-lucide="x-circle"></i>
            <div class="ml-4 mr-4">
                <div class="font-medium"> Whoops! Something went wrong.!</div>
                <div class="text-slate-500 mt-1">
                    <ul>
                        <li v-for="(error, key) in errors" :key="key">
                            {{ error }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
