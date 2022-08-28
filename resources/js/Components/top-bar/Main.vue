<script setup>
import {ref} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {Link} from '@inertiajs/inertia-vue3';

const logout = () => {
  Inertia.post(route('logout'));
};


const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
  Inertia.put(route('current-team.update'), {
    team_id: team.id,
  }, {
    preserveState: false,
  });
};

const searchDropdown = ref(false);
const showSearchDropdown = () => {
  searchDropdown.value = true;
};
const hideSearchDropdown = () => {
  searchDropdown.value = false;
};
</script>

<template>
  <!-- BEGIN: Top Bar -->
  <div
      class="top-bar-boxed h-[70px] md:h-[65px] z-[51] border-b border-white/[0.08] mt-12 md:mt-0 -mx-3 sm:-mx-8 md:-mx-0 px-3 md:border-b-0 relative md:fixed md:inset-x-0 md:top-0 sm:px-8 md:px-10 md:pt-10 md:bg-gradient-to-b md:from-slate-100 md:to-transparent dark:md:from-darkmode-700"
  >
    <div class="h-full flex items-center">
      <!-- BEGIN: Logo -->
      <a href="" class="logo -intro-x hidden md:flex xl:w-[180px] block">
        <img
            alt="Logo"
            class="logo__image w-6"
            src="@/../images/logo.svg"
        />
        <span class="logo__text text-white text-lg ml-3">{{ $page.props.app.name }}</span>
      </a>
      <!-- END: Logo -->
      <!-- BEGIN: Breadcrumb -->
      <nav aria-label="breadcrumb" class="-intro-x h-[45px] mr-auto">
        <ol class="breadcrumb breadcrumb-light">
          <li class="breadcrumb-item"><a :href="route('dashboard')">{{ $page.props.app.name }}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $parent.$props.title }}</li>
        </ol>
      </nav>
      <!-- END: Breadcrumb -->
      <!-- BEGIN: Search -->
      <div class="intro-x relative mr-3 sm:mr-6">
        <div class="search hidden sm:block">
          <input
              type="text"
              class="search__input form-control border-transparent"
              placeholder="Search..."
              @focus="showSearchDropdown"
              @blur="hideSearchDropdown"
          />
          <SearchIcon class="search__icon dark:text-slate-500"/>
        </div>
        <a class="notification notification--light sm:hidden" href="">
          <SearchIcon class="notification__icon dark:text-slate-500"/>
        </a>
        <div class="search-result" :class="{ show: searchDropdown }">
          <div class="search-result__content">
            <div class="search-result__content__title">Pages</div>
            <div class="mb-5">
              <a href="" class="flex items-center">
                <div
                    class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full"
                >
                  <InboxIcon class="w-4 h-4"/>
                </div>
                <div class="ml-3">Mail Settings</div>
              </a>
              <a href="" class="flex items-center mt-2">
                <div
                    class="w-8 h-8 bg-pending/10 text-pending flex items-center justify-center rounded-full"
                >
                  <UsersIcon class="w-4 h-4"/>
                </div>
                <div class="ml-3">Users & Permissions</div>
              </a>
              <a href="" class="flex items-center mt-2">
                <div
                    class="w-8 h-8 bg-primary/10 dark:bg-primary/20 text-primary/80 flex items-center justify-center rounded-full"
                >
                  <CreditCardIcon class="w-4 h-4"/>
                </div>
                <div class="ml-3">Transactions Report</div>
              </a>
            </div>
            <div class="search-result__content__title">Users</div>
            <div class="mb-5">
              <a
                  v-for="(faker, fakerKey) in $_.take($f(), 4)"
                  :key="fakerKey"
                  href
                  class="flex items-center mt-2"
              >
                <div class="w-8 h-8 image-fit">
                  <img
                      alt="Image-alt"
                      class="rounded-full"
                      :src="faker.photos[0]"
                  />
                </div>
                <div class="ml-3">{{ faker.users[0].name }}</div>
                <div
                    class="ml-auto w-48 truncate text-slate-500 text-xs text-right"
                >
                  {{ faker.users[0].email }}
                </div>
              </a>
            </div>
            <div class="search-result__content__title">Products</div>
            <a
                v-for="(faker, fakerKey) in $_.take($f(), 4)"
                :key="fakerKey"
                href
                class="flex items-center mt-2"
            >
              <div class="w-8 h-8 image-fit">
                <img
                    alt="Image-alt"
                    class="rounded-full"
                    :src="faker.images[0]"
                />
              </div>
              <div class="ml-3">{{ faker.products[0].name }}</div>
              <div
                  class="ml-auto w-48 truncate text-slate-500 text-xs text-right"
              >
                {{ faker.products[0].category }}
              </div>
            </a>
          </div>
        </div>
      </div>
      <!-- END: Search -->
      <!-- BEGIN: Notifications -->
      <Dropdown class="intro-x mr-4 sm:mr-6">
        <DropdownToggle
            tag="div"
            role="button"
            class="notification notification--bullet cursor-pointer"
        >
          <BellIcon class="notification__icon dark:text-slate-500"/>
        </DropdownToggle>
        <DropdownMenu class="notification-content pt-2">
          <DropdownContent tag="div" class="notification-content__box bg-primary">
            <div class="notification-content__title">Notifications</div>
            <div
                v-for="(faker, fakerKey) in $_.take($f(), 5)"
                :key="fakerKey"
                class="cursor-pointer relative flex items-center"
                :class="{ 'mt-5': fakerKey }"
            >
              <div class="w-12 h-12 flex-none image-fit mr-1">
                <img
                    alt="Image-alt"
                    class="rounded-full"
                    :src="faker.photos[0]"
                />
                <div
                    class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white"
                ></div>
              </div>
              <div class="ml-2 overflow-hidden">
                <div class="flex items-center">
                  <a href="javascript:;" class="font-medium truncate mr-5">{{
                      faker.users[0].name
                    }}</a>
                  <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">
                    {{ faker.times[0] }}
                  </div>
                </div>
                <div class="w-full truncate text-slate-500 mt-0.5">
                  {{ faker.news[0].shortContent }}
                </div>
              </div>
            </div>
          </DropdownContent>
        </DropdownMenu>
      </Dropdown>
      <!-- END: Notifications -->

      <!-- BEGIN: Teams -->
      <Dropdown class="intro-x mr-4 sm:mr-6">
        <DropdownToggle
            tag="div"
            role="button"
            class="w-full text-white/60 h-8 px-2 overflow-hidden shadow-lg image-fit zoom-in scale-110"
        >
          {{ $page.props.user.current_team.name }}
          <svg
              class="ml-2 -mr-0.5 h-4 w-4 inline-block"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
              fill="currentColor"
          >
            <path fill-rule="evenodd"
                  d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                  clip-rule="evenodd"/>
          </svg>
        </DropdownToggle>
        <DropdownMenu class="w-56">
          <DropdownContent
              class="bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white"
          >
            <DropdownHeader tag="div" class="!font-normal">
              <div class="font-medium">
                Manage Team
              </div>
            </DropdownHeader>
            <DropdownDivider class="border-white/[0.08]"/>
            <li>
              <Link class="dropdown-item hover:bg-white/5" :href="route('teams.show', $page.props.user.current_team)">
                Team Settings
              </Link>
            </li>
            <li>
              <Link class="dropdown-item hover:bg-white/5" v-if="$page.props.jetstream.canCreateTeams"
                    :href="route('teams.create')">
                Create New Team
              </Link>
            </li>
            <DropdownDivider class="border-white/[0.08]"/>
            <DropdownHeader tag="div" class="!font-normal">
              <div class="font-medium">
                Switch Teams
              </div>
            </DropdownHeader>
            <template v-for="team in $page.props.user.all_teams" :key="team.id">
              <li>
                <form @submit.prevent="switchToTeam(team)">
                  <button type="submit" class="dropdown-item cursor-pointer dropdown-item hover:bg-white/5 w-full">
                    <div class="flex items-center">
                      <svg
                          v-if="team.id == $page.props.user.current_team_id"
                          class="mr-2 h-5 w-5 text-green-400"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          stroke="currentColor"
                          viewBox="0 0 24 24"
                      >
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                      </svg>
                      <div>{{ team.name }}</div>
                    </div>
                  </button>
                </form>
              </li>
            </template>
          </DropdownContent>
        </DropdownMenu>
      </Dropdown>
      <!-- END: Teams -->

      <!-- BEGIN: Account Menu -->
      <Dropdown class="intro-x w-8 h-8">
        <DropdownToggle
            tag="div"
            role="button"
            class="w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110"
        >
          <img
              alt="Image-alt"
              :src="$page.props.user.profile_photo_url"
          />
        </DropdownToggle>
        <DropdownMenu class="w-56">
          <DropdownContent
              class="bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white"
          >
            <DropdownHeader tag="div" class="!font-normal">
              <div class="font-medium">
                {{ $page.props.user.name }}
              </div>
              <!--<div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">
                    {{ $f()[0].jobs[0] }}
                  </div>-->
            </DropdownHeader>
            <DropdownDivider class="border-white/[0.08]"/>
            <li>
              <Link class="dropdown-item hover:bg-white/5" :href="route('profile.show')">
                <UserIcon class="w-4 h-4 mr-2"/>
                Profile
              </Link>
            </li>
            <li v-if="$page.props.jetstream.hasApiFeatures">
              <Link :href="route('api-tokens.index')" class="dropdown-item hover:bg-white/5">
                <UserIcon class="w-4 h-4 mr-2"/>
                Api Tokens
              </Link>
            </li>
            <DropdownDivider class="border-white/[0.08]"/>
            <li>
              <form @submit.prevent="logout">
                <button type="submit" class="dropdown-item cursor-pointer dropdown-item hover:bg-white/5 w-full">
                  <ToggleRightIcon class="w-4 h-4 mr-2"/>
                  Logout
                </button>
              </form>
            </li>
          </DropdownContent>
        </DropdownMenu>
      </Dropdown>
      <!-- END: Account Menu -->
    </div>
  </div>
  <!-- END: Top Bar -->
</template>
