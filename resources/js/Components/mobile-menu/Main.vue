<template>
  <!-- BEGIN: Mobile Menu -->
  <div
    class="mobile-menu md:hidden"
    :class="{
      'mobile-menu--active': activeMobileMenu,
    }"
  >
    <div class="mobile-menu-bar">
      <a href="" class="flex mr-auto">
        <img
          alt="Enigma Tailwind HTML Admin Template"
          class="w-6"
          src="@/../images/logo.svg"
        />
      </a>
      <a href="javascript:;" class="mobile-menu-toggler">
        <BarChart2Icon
          class="w-8 h-8 text-white transform -rotate-90"
          @click="toggleMobileMenu"
        />
      </a>
    </div>
    <div class="scrollable">
      <a href="javascript:;" class="mobile-menu-toggler">
        <XCircleIcon
          class="w-8 h-8 text-white transform -rotate-90"
          @click="toggleMobileMenu"
        />
      </a>
      <ul class="scrollable__content py-2">
        <!-- BEGIN: First Child -->
        <template v-for="(menu, menuKey) in formattedMenu">
          <li
            v-if="menu == 'devider'"
            :key="menu + menuKey"
            class="menu__devider my-6"
          ></li>
          <li v-else :key="menu + menuKey">
              <Link
                  v-if="!menu.subMenu"
                  :href="menu.subMenu ? 'javascript:;' : route(menu.routeName)"
                  class="menu"
                  :class="{
                  'side-menu--active': route().current(menu.routeName),
                  'side-menu--open': menu.activeDropdown,
                }"
                  @click="toggleMobileMenu"
              >
              <div class="menu__icon">
                <component :is="menu.icon" />
              </div>
              <div class="menu__title">
                {{ menu.title }}
              </div>
            </Link>
            <a
                v-if="menu.subMenu"
                href="javascript:;"
                class="menu"
                :class="{
                  'side-menu--active': menu.active ,
                  'side-menu--open': menu.activeDropdown,
                }"
                @click="menu.activeDropdown = true;"
            >
              <div class="menu__icon">
                <component :is="menu.icon" />
              </div>
              <div class="menu__title">
                {{ menu.title }}
                <div
                    class="menu__sub-icon"
                    :class="{ 'transform rotate-180': menu.activeDropdown }"
                >
                  <ChevronDownIcon />
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
                    :href="route(menu.routeName)"
                    class="menu"
                    :class="{ 'menu--active': route().current(subMenu.routeName) }"
                    @click="toggleMobileMenu"
                  >
                    <div class="menu__icon">
                      <ActivityIcon />
                    </div>
                    <div class="menu__title">
                      {{ subMenu.title }}
                      <div
                        v-if="subMenu.subMenu"
                        class="menu__sub-icon"
                        :class="{
                          'transform rotate-180': subMenu.activeDropdown,
                        }"
                      >
                        <ChevronDownIcon />
                      </div>
                    </div>
                  </Link>
                </li>
              </ul>
            </transition>
            <!-- END: Second Child -->
          </li>
        </template>
        <!-- END: First Child -->
      </ul>
    </div>
  </div>
  <!-- END: Mobile Menu -->
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import {Link} from '@inertiajs/inertia-vue3';
import { helper as $h } from "@/utils/helper";
import { useSideMenuStore } from "@/stores/side-menu";
import {
  activeMobileMenu,
  toggleMobileMenu,
  enter,
  leave,
} from "./index";
import { nestedMenu } from "@/Layouts/appLayout";
import dom from "@left4code/tw-starter/dist/js/dom";
import SimpleBar from "simplebar";

const formattedMenu = ref([]);
const sideMenuStore = useSideMenuStore();
const mobileMenu = computed(() => nestedMenu(sideMenuStore.menu));

onMounted(() => {
  new SimpleBar(dom(".mobile-menu .scrollable")[0]);
  formattedMenu.value = $h.toRaw(mobileMenu.value);
});
</script>
