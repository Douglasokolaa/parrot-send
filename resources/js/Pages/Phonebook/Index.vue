<script>
import {Head} from "@inertiajs/inertia-vue3";
import CreatePhoneBook from "./Partial/CreatePhoneBook.vue";

export default {
  components: {CreatePhoneBook, Head},
  props: {
    canCreatePhonebook: Boolean,
  },
  data() {
    return {
      showCreatePhonebook: false,
    }
  },
}
</script>

<template>
  <div>
    <Head title="Phonebooks"/>
    <div class="grid grid-cols-12 gap-6 mt-5">
      <div
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

        <!-- Modals -->
      </div>
    </div>
    <CreatePhoneBook
        :show-create-phonebook="showCreatePhonebook"
        @closeCreatePhonebook="showCreatePhonebook = false"
    />
  </div>
</template>

