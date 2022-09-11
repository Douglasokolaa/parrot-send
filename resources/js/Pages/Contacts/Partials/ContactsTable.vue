<template>
  <div>
    <table class="table table-report table-hover -mt-2">
      <thead>
      <tr>
        <th class="whitespace-nowrap">CONTACT FIRST NAME</th>
        <th class="whitespace-nowrap">CONTACT LAST NAME</th>
        <th class="whitespace-nowrap">CONTACT PHONE</th>
        <th class="whitespace-nowrap">CONTACT EMAIL</th>
        <th class="text-center whitespace-nowrap">TOTAL MESSAGES</th>
        <th class="text-center whitespace-nowrap">ACTIONS</th>
      </tr>
      </thead>
      <tbody>
      <ContactRow
          v-for="(contact, index) in contacts.data"
          :index="index"
          :contact="contact"
          @deleteContact="deleteContactConfirmation"
          @editContact="showEditContact"
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
              This will delete all <b>{{ contactDeleted.contacts_count }} contact(s) </b>in this contact.
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
          <button type="button" class="btn btn-danger w-24" @click="deleteContact" :disabled="deleting">
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
        <form @submit.prevent="editContact()">
          <!-- BEGIN: Slide Over Header -->
          <ModalHeader class="p-5">
            <h2 class="font-medium text-base mr-auto">
              Create Contact
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
              <input id="name" type="text" class="form-control" v-model="contactEdited.name"/>
              <div class="text-danger mt-2" v-if="contactEdited.errors.name">{{ contactEdited.errors.name }}</div>
            </div>
            <div class="mt-3">
              <label>Status</label>
              <div class="mt-2">
                <div class="form-check form-switch">
                  <input
                      id="pb-status"
                      class="form-check-input"
                      v-model="contactEdited.status"
                      true-value="1"
                      false-value="0"
                      type="checkbox"
                  />
                  <label class="form-check-label" for="pb-status">Active</label>
                </div>
                <div class="text-danger mt-2" v-if="contactEdited.errors.status">{{
                    contactEdited.errors.status
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
            <button class="btn btn-primary w-20" :disabled="contactEdited.processing">
              Send
              <LoadingIcon class="ml-1" v-if="contactEdited.processing" icon="oval"/>
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
import ContactRow from "./ContactRow.vue";
import {useForm} from "@inertiajs/inertia-vue3";
import {Inertia} from "@inertiajs/inertia";

defineProps({
  contacts: {
    required: true,
    type: Object,
  },
  contactPermissions: {
    required: true,
    type: Object,
  },
});

const deleteConfirmationModal = ref(false);
const editModal = ref(false);
const contactDeleted = ref({});
const contactEdited = ref(useForm({
  name: null,
  status: 0,
}));
const deleting = ref(false);


const deleteContactConfirmation = contact => {
  contactDeleted.value = contact;
  deleteConfirmationModal.value = true;
}

const deleteContact = _ => {
  deleting.value = true;
  Inertia.delete(route('contacts.destroy', contactDeleted.value.slug), {
    onSuccess: _ => {
      console.log('Contact deleted');
      contactDeleted.value = {};
      deleteConfirmationModal.value = false;
      deleting.value = false;
    }
  })
}

const showEditContact = contact => {
  editModal.value = true;
  contactEdited.value.name = contact.name;
  contactEdited.value.status = contact.status;
  contactEdited.value.slug = contact.slug;
}

const closeEditModal = _ => {
  editModal.value = false;
  contactEdited.value.reset();
}

const editContact = _ => {
  contactEdited
      .value
      .put(route('contacts.update', contactEdited.value.slug), {
        onSuccess: _ => {
          console.log('Contact Updated');
          contactEdited.value.reset();
          editModal.value = false;
        }
      });
}
</script>
