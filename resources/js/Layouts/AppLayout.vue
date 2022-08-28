<script setup>
import {Inertia} from '@inertiajs/inertia';
import {Head, Link} from '@inertiajs/inertia-vue3';
import Logo from '@/Jetstream/ApplicationMark.vue';
import DarkModeSwitcher from "@/Components/dark-mode-switcher/Main.vue";
import {computed, onMounted, provide, ref, watch} from "vue";
import {helper as $h} from "@/utils/helper";
import {useSideMenuStore} from "@/stores/side-menu";
import TopBar from "@/Components/top-bar/Main.vue";
// import MobileMenu from "@/Components/mobile-menu/Main.vue";
import MainColorSwitcher from "@/Components/main-color-switcher/Main.vue";
import SideMenuTooltip from "@/Components/side-menu-tooltip/Main.vue";
import {nestedMenu} from "./appLayout";
import dom from "@left4code/tw-starter/dist/js/dom";

const formattedMenu = ref([]);
const sideMenuStore = useSideMenuStore();
const sideMenu = computed(() => nestedMenu(sideMenuStore.menu));

provide("forceActiveMenu", (pageName) => {
  route.forceActiveMenu = pageName;
  formattedMenu.value = $h.toRaw(sideMenu.value);
});

onMounted(() => {
  dom("body").removeClass("error-page").removeClass("login").addClass("main");
});

defineProps({
  title: String,
});

const showingNavigationDropdown = ref(false);

</script>

<template>
  <div class="py-5 md:py-0">
    <Head :title="title"/>
    <DarkModeSwitcher/>
    <!--    <MobileMenu/>-->
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
              <SideMenuTooltip
                  tag="a"
                  :content="menu.title"
                  :href="route(menu.routeName)"
                  class="side-menu"
                  :class="{
                  'side-menu--active': menu.active,
                  'side-menu--open': menu.activeDropdown,
                }"
              >
                <div class="side-menu__icon">
                  <component :is="menu.icon"/>
                </div>
                <div class="side-menu__title">
                  {{ menu.title }}
                  <div
                      v-if="menu.subMenu"
                      class="side-menu__sub-icon"
                      :class="{ 'transform rotate-180': menu.activeDropdown }"
                  >
                    <ChevronDownIcon/>
                  </div>
                </div>
              </SideMenuTooltip>
              <!-- BEGIN: Second Child -->
              <transition @enter="enter" @leave="leave">
                <ul v-if="menu.subMenu && menu.activeDropdown">
                  <li
                      v-for="(subMenu, subMenuKey) in menu.subMenu"
                      :key="subMenuKey"
                  >
                    <SideMenuTooltip
                        tag="a"
                        :content="subMenu.title"
                        :href="
                        subMenu.subMenu
                          ? 'javascript:;'
                          : router.resolve({ name: subMenu.pageName }).path
                      "
                        class="side-menu"
                        :class="{ 'side-menu--active': subMenu.active }"
                        @click="linkTo(subMenu, router, $event)"
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
                    </SideMenuTooltip>
                    <!-- BEGIN: Third Child -->
                    <transition @enter="enter" @leave="leave">
                      <ul v-if="subMenu.subMenu && subMenu.activeDropdown">
                        <li
                            v-for="(
                            lastSubMenu, lastSubMenuKey
                          ) in subMenu.subMenu"
                            :key="lastSubMenuKey"
                        >
                          <SideMenuTooltip
                              tag="a"
                              :content="lastSubMenu.title"
                              :href="
                              lastSubMenu.subMenu
                                ? 'javascript:;'
                                : router.resolve({
                                    name: lastSubMenu.pageName,
                                  }).path
                            "
                              class="side-menu"
                              :class="{
                              'side-menu--active': lastSubMenu.active,
                            }"
                              @click="linkTo(lastSubMenu, router, $event)"
                          >
                            <div class="side-menu__icon">
                              <ZapIcon/>
                            </div>
                            <div class="side-menu__title">
                              {{ lastSubMenu.title }}
                            </div>
                          </SideMenuTooltip>
                        </li>
                      </ul>
                    </transition>
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
