<template>
  <tr class="intro-x">
    <td>
      <Link
          :href="route('phonebooks.show', phonebook.slug)"
          class="font-medium whitespace-nowrap"
      >{{ phonebook.name }}</Link>
    </td>
    <td>
      <Link
          class="text-slate-500 flex items-center mr-3"
          :href="route('phonebooks.show', phonebook.slug)"
      >
        <ExternalLinkIcon class="w-4 h-4 mr-2"/>
        {{ phonebook.slug }}
      </Link>
    </td>
    <td>
      <p class="font-medium text-center whitespace-nowrap">
        {{ phonebook.contacts_count }}
      </p>
    </td>
    <td class="w-40">
      <div
          class="flex items-center justify-center"
          :class="{
                  'text-success': phonebook.status,
                  'text-danger': !phonebook.status,
                }"
      >
        <CheckSquareIcon class="w-4 h-4 mr-2"/>
        {{ phonebook.status ? "Active" : "Inactive" }}
      </div>
    </td>
    <td class="table-report__action w-56">
      <div class="flex justify-center items-center">
        <button class="flex items-center mr-3" @click="editPhonebook(phonebook)">
          <CheckSquareIcon class="w-4 h-4 mr-1"/>
          Edit
        </button>
        <button
            class="flex items-center text-danger"
            @click="deletePhonebookRow(phonebook)"
        >
          <Trash2Icon class="w-4 h-4 mr-1"/>
          Delete
        </button>
      </div>
    </td>
  </tr>
</template>
<script setup>
import { Link } from '@inertiajs/inertia-vue3';
defineProps({
  phonebook: Object,
});

const $emit = defineEmits(['deletePhonebook', 'editPhonebook']);

const deletePhonebookRow = phonebook => {
  $emit('deletePhonebook', phonebook);
}

const editPhonebook = phonebook => {
  $emit('editPhonebook', phonebook);
}
</script>
