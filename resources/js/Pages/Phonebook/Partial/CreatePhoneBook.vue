<template>
  <Modal
      backdrop="static"
      :slideOver="true"
      :show="showCreatePhonebook"
      @hidden="$emit('closeCreatePhonebook')"
  >
    <a @click="$emit('closeCreatePhonebook')" class="absolute top-0 left-0 right-auto mt-4 -ml-12" href="javascript:;"
    >
      <XIcon class="w-8 h-8 text-slate-400"/>
    </a>
    <form @submit.prevent="submitForm()">
      <!-- BEGIN: Slide Over Header -->
      <ModalHeader class="p-5">
        <h2 class="font-medium text-base mr-auto">
          Create Phonebook
        </h2>
      </ModalHeader>
      <!-- END: Slide Over Header -->
      <!-- BEGIN: Slide Over Body -->
      <ModalBody>
        <div>
          <label for="name" class="form-label">From</label>
          <input id="name" type="text" class="form-control" v-model="form.name"/>
          <div v-if="form.errors.name">{{ form.errors.name }}</div>
        </div>
      </ModalBody>
      <!-- END: Slide Over Body -->
      <!-- BEGIN: Slide Over Footer -->
      <ModalFooter class="w-full absolute bottom-0">
        <button type="button" @click="$emit('closeCreatePhonebook')" class="btn btn-outline-secondary w-20 mr-1">
          Cancel
        </button>
        <button class="btn btn-primary w-20">
          Send
        </button>
      </ModalFooter>
      <!-- END: Slide Over Footer -->
    </form>
  </Modal>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
  props: {
    errors: Object,
    showCreatePhonebook: {
      required: true
    },
  },
  data() {
    return {
      form: useForm({
        name: null,
      })
    }
  },
  methods: {
    submitForm() {
      const $this = this;
      this.form.post(route('phonebooks.store'), {
        onSuccess: () => {
          $this.form.reset('name');
          $this.$emit("closeCreatePhonebook");
        },
      })
    }
  },
}
</script>
