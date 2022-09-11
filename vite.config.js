import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { splitVendorChunkPlugin } from 'vite'

export default defineConfig({
    plugins: [
        splitVendorChunkPlugin(),
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources/js',
            '@images': '/resources/images',
            'ziggy': '/vendor/tightenco/ziggy/src/js',
            'ziggy-vue': '/vendor/tightenco/ziggy/src/js/vue',
        }
    },
    options: {
        __VUE_PROD_DEVTOOLS__: true,
    },
    build: {
        chunkSizeWarningLimit: 3000,
    },
});
