<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import DarkModeSwitcher from "@/Components/dark-mode-switcher/Main.vue";
import {computed, onMounted, provide, ref, watch} from "vue";
import {helper as $h} from "@/utils/helper";
import {useSideMenuStore} from "@/stores/side-menu";
import TopBar from "@/Components/top-bar/Main.vue";
import MobileMenu from "@/Components/mobile-menu/Main.vue";
import {nestedMenu} from "./appLayout";
import dom from "@left4code/tw-starter/dist/js/dom";
import route from "ziggy-js/src/js";

const formattedMenu = ref([]);
const sideMenuStore = useSideMenuStore();
const sideMenu = computed(() => nestedMenu(sideMenuStore.menu));
const showingNavigationDropdown = ref(false);
const enter = (el, done) => {
  dom(el).slideDown(300);
};
const leave = (el, done) => {
  dom(el).slideUp(300);
};

defineProps({
  title: String,
});

onMounted(() => {
  dom("body").removeClass("error-page").removeClass("login").addClass("main");
  formattedMenu.value = $h.toRaw(sideMenu.value);
});
</script>

<template>
  <div class="py-5 md:py-0">
    <div v-if="title">
      <Head :title="title"/>
    </div>
    <DarkModeSwitcher/>
    <MobileMenu/>
    <TopBar/>
    <div class="flex overflow-hidden">
      <!-- BEGIN: Side Menu -->
      <nav class="side-nav">
        <ul>
          <!-- BEGIN: First Child -->
          <template v-for="(menu, menuKey) in formattedMenu">
            <li
                v-if="menu == 'devider'"
                :key="menu + menuKey"
                class="side-nav__devider my-6"
            ></li>
            <li v-else :key="menu + menuKey">
              <Link
                  v-if="!menu.subMenu"
                  :href="menu.subMenu ? 'javascript:;' : route(menu.routeName)"
                  class="side-menu"
                  :class="{
                  'side-menu--active': route().current(menu.routeName),
                  'side-menu--open': menu.activeDropdown,
                }"
              >
                <div class="side-menu__icon">
                  <component :is="menu.icon"/>
                </div>
                <div class="side-menu__title">
                  {{ menu.title }}
                </div>
              </Link>
              <a
                  v-if="menu.subMenu"
                  href="javascript:;"
                  class="side-menu"
                  :class="{
                  'side-menu--active': menu.active,
                  'side-menu--open': menu.activeDropdown,
                }"
                  @click="menu.activeDropdown = true;"
              >
                <div class="side-menu__icon">
                  <component :is="menu.icon"/>
                </div>
                <div class="side-menu__title">
                  {{ menu.title }}
                  <div
                      class="side-menu__sub-icon"
                      :class="{ 'transform rotate-180': menu.activeDropdown }"
                  >
                    <ChevronDownIcon/>
                  </div>
                </div>
              </a>
              <!-- BEGIN: Second Child -->
              <transition @enter="enter" @leave="leave">
                <ul v-if="menu.subMenu && menu.activeDropdown">
                  <li
                      v-for="(subMenu, subMenuKey) in menu.subMenu"
                      :key="subMenuKey"
                  >
                    <Link
                        :href=" subMenu.subMenu ? 'javascript:;' : route(subMenu.routeName)"
                        class="side-menu"
                        :class="{ 'side-menu--active': subMenu.active }"
                    >
                      <div class="side-menu__icon">
                        <ActivityIcon/>
                      </div>
                      <div class="side-menu__title">
                        {{ subMenu.title }}
                        <div
                            v-if="subMenu.subMenu"
                            class="side-menu__sub-icon"
                            :class="{
                            'transform rotate-180': subMenu.activeDropdown,
                          }"
                        >
                          <ChevronDownIcon/>
                        </div>
                      </div>
                    </Link>
                    <!-- END: Third Child -->
                  </li>
                </ul>
              </transition>
              <!-- END: Second Child -->
            </li>
          </template>
          <!-- END: First Child -->
        </ul>
      </nav>
      <!-- END: Side Menu -->
      <!-- BEGIN: Content -->
      <div class="content">
        <slot/>
      </div>
      <!-- END: Content -->
    </div>
  </div>
</template>
