<template>
  <Modal
      backdrop="static"
      :slideOver="false"
      :show="showCreatePhonebook"
      @hidden="$emit('closeCreatePhonebook')"
  >

    <form @submit.prevent="submitForm()">
      <!-- BEGIN: Slide Over Header -->
      <ModalHeader class="p-5">
        <h2 class="font-medium text-base mr-auto">
          Create Phonebook
        </h2>
        <a @click="$emit('closeCreatePhonebook')" class="absolute top-0 left-auto right-0 mt-4 mr-2" href="javascript:;"
        >
          <XIcon class="w-8 h-8 text-slate-400"/>
        </a>
      </ModalHeader>
      <!-- END: Slide Over Header -->
      <!-- BEGIN: Slide Over Body -->
      <ModalBody>
        <div>
          <label for="name" class="form-label">Name</label>
          <input id="name" type="text" class="form-control" v-model="form.name"/>
          <div class="text-danger mt-2" v-if="form.errors.name">{{ form.errors.name }}</div>
        </div>
      </ModalBody>
      <!-- END: Slide Over Body -->
      <!-- BEGIN: Slide Over Footer -->
      <ModalFooter class="w-full">
        <button type="button" @click="$emit('closeCreatePhonebook')" class="btn btn-outline-secondary w-20 mr-1">
          Cancel
        </button>
        <button class="btn btn-primary w-20" :disabled="form.processing">
          Send
          <LoadingIcon class="ml-1" v-if="form.processing" icon="oval"/>
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
      }),
    }
  },
  methods: {
    submitForm() {
      const $this = this;
      this.form.post(route('phonebooks.store'), {
        onSuccess: response => {
          $this.form.reset('name');
          $this.$emit("closeCreatePhonebook");
        },
      })
    }
  },
}
</script>
