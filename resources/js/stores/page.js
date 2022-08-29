import { defineStore } from "pinia";

export default defineStore('page', {
    state: () => {
        return {
            title: null
        }
    }
});
