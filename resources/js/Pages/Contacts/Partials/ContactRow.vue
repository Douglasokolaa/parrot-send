<template>
  <tr class="intro-x">
    <td>
      <Link
          :href="route('contacts.show', contact.id)"
          class="font-medium whitespace-nowrap"
      >{{ contact.first_name }}
      </Link>
    </td>
    <td>
      <Link
          :href="route('contacts.show', contact.id)"
          class="font-medium whitespace-nowrap"
      >{{ contact.last_name }}
      </Link>
    </td>
    <td>
      <span>{{ contact.phone_e164 }}</span>
    </td>
    <td>
      <span>{{ contact.email }}</span>
    </td>
    <td>
      <p class="font-medium text-center whitespace-nowrap">
        {{ contact.messages_count }} 1
      </p>
    </td>
    <td class="table-report__action w-56">
      <div class="flex justify-center items-center">
        <button class="flex items-center mr-3">
          <CheckSquareIcon class="w-4 h-4 mr-1"/>
          Edit
        </button>
        <button
            class="flex items-center text-danger"
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
  contact: Object,
});

</script>

