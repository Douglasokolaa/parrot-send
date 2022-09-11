<script setup>
import ContactsTable from "../Contacts/Partials/ContactsTable.vue";
import {Head, Link, useForm} from "@inertiajs/inertia-vue3";
import route from "ziggy-js/src/js";
import {inject, ref} from "vue";
import TopHeading from "../../Components/table/TopHeading.vue";

defineEmits('title')

const $props = defineProps({
  phonebook: Object,
  contactPermissions: Object,
  contacts: Object,
})

const searchForm = ref(useForm({
  'search': route().params.search
}));

const searchContacts = _ => {
  searchForm.value.get(window.location)
}

const breadcrum = inject('breadcrum');
breadcrum.value = "Phonebooks > " + $props.phonebook.name;
</script>

<template>
  <Head :title="phonebook.name + 'Phonebook'"/>
  <h2 class="intro-y text-lg font-medium mt-10">{{ phonebook.name }} Phonebook</h2>
  <div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 grid grid-cols-2">
      <div class="grid-cols-2 lg:grid-cols-1">
        <p class="font-bold">Hi, {{ phonebook.team.name }}</p>
        <p> View, manage Upload and export your customers phone contacts in this phonebook</p>
      </div>
    </div>
    <top-heading
        :searhField="searchForm"
        :paginator="contacts"
        name="Contacts"
        @search="searchContacts"
        class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"
    >
      <Link
          v-if="contactPermissions.create"
          :href="route('phonebooks.contacts.create', phonebook.slug)"
          class="btn btn-primary shadow-md mr-2"
      >Add New Contact
      </Link>
      <a
          v-if="contactPermissions.create"
          href="#"
          class="btn btn-secondary shadow-md mr-2"
      >Import Contact
      </a>
      <Dropdown>
        <DropdownToggle class="btn px-2 box">
          <span class="w-5 h-5 flex items-center justify-center">
            <PlusIcon class="w-4 h-4"/>
          </span>
        </DropdownToggle>
        <DropdownMenu class="w-40">
          <DropdownContent>
            <DropdownItem>
              <FileTextIcon class="w-4 h-4 mr-2"/>
              Export to CSV
            </DropdownItem>
          </DropdownContent>
        </DropdownMenu>
      </Dropdown>
    </top-heading>
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
      <contacts-table :contacts="contacts" :contact-permissions="contactPermissions"/>
    </div>
  </div>
</template>


