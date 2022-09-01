<template>
  <div>
    <table class="table table-report -mt-2">
      <thead>
      <tr>
        <th class="whitespace-nowrap">PHONEBOOK NAME</th>
        <th class="whitespace-nowrap">PHONEBOOK SLUG</th>
        <th class="text-center whitespace-nowrap">TOTAL CONTACTS</th>
        <th class="text-center whitespace-nowrap">STATUS</th>
        <th class="text-center whitespace-nowrap">ACTIONS</th>
      </tr>
      </thead>
      <tbody>
      <PhonebookRow
          v-for="(phonebook, index) in phonebooks.data"
          :index="index"
          :phonebook="phonebook"
          @deletePhonebook="deletePhonebookConfirmation"
          @editPhonebook="showEditPhonebook"
      />
      </tbody>
    </table>
    <!-- BEGIN: Delete Confirmation Modal -->
    <Modal
        :show="deleteConfirmationModal"
        @hidden="deleteConfirmationModal = false"
    >
      <ModalBody class="p-0">
        <div class="p-5 text-center">
          <XCircleIcon class="w-16 h-16 text-danger mx-auto mt-3"/>
          <div class="text-3xl mt-5">Are you sure?</div>
          <div class="text-slate-500 mt-2">
            <p class="text-lg">
              This will delete all <b>{{ phonebookDeleted.contacts_count }} contact(s) </b>in this phonebook.
            </p>
            <p>Note: This process cannot be undone.</p>
          </div>
        </div>
        <div class="px-5 pb-8 text-center">
          <button
              type="button"
              @click="deleteConfirmationModal = false"
              class="btn btn-outline-secondary w-24 mr-1"
          >Cancel
          </button>
          <button type="button" class="btn btn-danger w-24" @click="deletePhonebook" :disabled="deleting">
            Delete
            <LoadingIcon icon="oval" class="ml-1" v-if="deleting"/>
          </button>
        </div>
      </ModalBody>
    </Modal>
    <!-- END: Delete Confirmation Modal -->
    <!-- BEGIN: Edit Modal -->
    <Modal
        :show="editModal"
        @hidden="closeEditModal()"
    >
      <ModalBody class="p-0">
        <form @submit.prevent="editPhonebook()">
          <!-- BEGIN: Slide Over Header -->
          <ModalHeader class="p-5">
            <h2 class="font-medium text-base mr-auto">
              Create Phonebook
            </h2>
            <a @click="closeEditModal()" class="absolute top-0 left-auto right-0 mt-4 mr-2" href="javascript:;"
            >
              <XIcon class="w-8 h-8 text-slate-400"/>
            </a>
          </ModalHeader>
          <!-- END: Slide Over Header -->
          <!-- BEGIN: Slide Over Body -->
          <ModalBody>
            <div>
              <label for="name" class="form-label">Name</label>
              <input id="name" type="text" class="form-control" v-model="phonebookEdited.name"/>
              <div class="text-danger mt-2" v-if="phonebookEdited.errors.name">{{ phonebookEdited.errors.name }}</div>
            </div>
            <div class="mt-3">
              <label>Status</label>
              <div class="mt-2">
                <div class="form-check form-switch">
                  <input
                      id="pb-status"
                      class="form-check-input"
                      v-model="phonebookEdited.status"
                      true-value="1"
                      false-value="0"
                      type="checkbox"
                  />
                  <label class="form-check-label" for="pb-status">Active</label>
                </div>
                <div class="text-danger mt-2" v-if="phonebookEdited.errors.status">{{
                    phonebookEdited.errors.status
                  }}
                </div>
              </div>
            </div>
          </ModalBody>
          <!-- END: Slide Over Body -->
          <!-- BEGIN: Slide Over Footer -->
          <ModalFooter class="w-full">
            <button type="button" @click="closeEditModal()" class="btn btn-outline-secondary w-20 mr-1">
              Cancel
            </button>
            <button class="btn btn-primary w-20" :disabled="phonebookEdited.processing">
              Send
              <LoadingIcon class="ml-1" v-if="phonebookEdited.processing" icon="oval"/>
            </button>
          </ModalFooter>
          <!-- END: Slide Over Footer -->
        </form>
      </ModalBody>
    </Modal>
    <!-- END: Edit Modal -->
  </div>
</template>

<script setup>
import {ref} from 'vue';
import PhonebookRow from "./PhonebookRow.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";

defineProps({
  phonebooks: Object
});


const deleteConfirmationModal = ref(false);
const editModal = ref(false);
const phonebookDeleted = ref({});
const phonebookEdited = ref(useForm({
  name: null,
  status: 0,
}));
const deleting = ref(false);


const deletePhonebookConfirmation = phonebook => {
  phonebookDeleted.value = phonebook;
  deleteConfirmationModal.value = true;
}

const deletePhonebook = _ => {
  deleting.value = true;
  Inertia.delete(route('phonebooks.destroy', phonebookDeleted.value.slug), {
    onSuccess: _ => {
      console.log('Phonebook deleted');
      phonebookDeleted.value = {};
      deleteConfirmationModal.value = false;
      deleting.value = false;
    }
  })
}

const showEditPhonebook = phonebook => {
  editModal.value = true;
  phonebookEdited.value.name = phonebook.name;
  phonebookEdited.value.status = phonebook.status;
  phonebookEdited.value.slug = phonebook.slug;
}

const closeEditModal = _ => {
  editModal.value = false;
  phonebookEdited.value.reset();
}

const editPhonebook = _ => {
  phonebookEdited
      .value
      .put(route('phonebooks.update', phonebookEdited.value.slug), {
        onSuccess: _ => {
          console.log('Phonebook Updated');
          phonebookEdited.value.reset();
          editModal.value = false;
        }
      });
}
</script>
