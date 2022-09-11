<script setup>
import {Head, useForm} from "@inertiajs/inertia-vue3";
import CreatePhoneBook from "./Partial/CreatePhoneBook.vue";
import PhonebookTable from "./Partial/PhonebookTable.vue";
import {inject, ref} from "vue";
import TopHeading from "../../Components/table/TopHeading.vue";

defineProps({
  canCreatePhonebook: Boolean,
  phonebooks: Object,
});

const breadcrum = inject('breadcrum');
breadcrum.value = "Phonebooks"

const showCreatePhonebook = ref(false);

const phonebooksSearch = ref(useForm({search: route().params.search}));
const searchPhonebooks = _ => {
  phonebooksSearch.value.get(window.location)
}
</script>

<template>
  <div>
    <Head title="Phonebooks"/>
    <h2 class="intro-y text-lg font-medium mt-10">Phonebooks</h2>

    <div class="grid grid-cols-12 gap-6 mt-5">
      <top-heading
          :searhField="phonebooksSearch"
          :paginator="phonebooks"
          name="Phonebooks"
          @search="searchPhonebooks"
          class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"
      >
        <button v-if="canCreatePhonebook"
                class="btn btn-primary shadow-md mr-2"
                @click="showCreatePhonebook = true"
        >
          Add New Phonebook
        </button>
        <Dropdown>
          <DropdownToggle class="btn px-2 box">
          <span class="w-5 h-5 flex items-center justify-center">
            <MenuIcon class="w-4 h-4"/>
          </span>
          </DropdownToggle>
          <DropdownMenu class="w-40">
            <DropdownContent>
              <DropdownItem>
                <PrinterIcon class="w-4 h-4 mr-2"/>
                Print
              </DropdownItem>
              <DropdownItem>
                <FileTextIcon class="w-4 h-4 mr-2"/>
                Export to Excel
              </DropdownItem>
              <DropdownItem>
                <FileTextIcon class="w-4 h-4 mr-2"/>
                Export to PDF
              </DropdownItem>
            </DropdownContent>
          </DropdownMenu>
        </Dropdown>

      </top-heading>
    </div>
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
      <LoadingIcon icon="oval" class="inline-block h-6 text-center w-full" v-if="phonebooksSearch.processing"/>
      <phonebook-table :phonebooks="phonebooks"/>
    </div>
    <CreatePhoneBook
        :show-create-phonebook="showCreatePhonebook"
        @closeCreatePhonebook="showCreatePhonebook = false"
    />
  </div>
</template>

