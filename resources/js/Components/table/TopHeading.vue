<template>
  <div>
    <slot />
    <div :class="{'hidden': (paginator.total > 0)}" class="md:block mx-auto text-slate-500">
      Showing {{ paginator.from }} to {{ paginator.to }} of {{ paginator.total }} {{ name }}
    </div>
    <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
      <div class="w-56 relative text-slate-500">
        <input
            type="text"
            class="form-control w-56 box pr-10"
            v-model.lazy="searhField.search"
            @change="$emit('search')"
            placeholder="Search..."
        />
        <SearchIcon class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"/>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps([
  'searhField',
  'paginator',
  'name'
])

const $emit = defineEmits('search');
</script>

