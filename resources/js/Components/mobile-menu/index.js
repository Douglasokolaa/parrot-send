import { ref } from "vue";
import dom from "@left4code/tw-starter/dist/js/dom";

// Toggle mobile menu
const activeMobileMenu = ref(false);
const toggleMobileMenu = () => {
  activeMobileMenu.value = !activeMobileMenu.value;
};

const enter = (el, done) => {
  dom(el).slideDown(300);
};

const leave = (el, done) => {
  dom(el).slideUp(300);
};

export { activeMobileMenu, toggleMobileMenu, enter, leave };
