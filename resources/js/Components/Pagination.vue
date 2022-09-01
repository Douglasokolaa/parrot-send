<template>
  <div
      class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"
  >
    <nav class="w-full sm:w-auto sm:mr-auto">
      <ul class="pagination">
        <li class="page-item">
          <a class="page-link" href="#">
            <ChevronsLeftIcon class="w-4 h-4"/>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">
            <ChevronLeftIcon class="w-4 h-4"/>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">...</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item active">
          <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">...</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">
            <ChevronRightIcon class="w-4 h-4"/>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="#">
            <ChevronsRightIcon class="w-4 h-4"/>
          </a>
        </li>
      </ul>
    </nav>
    <select class="w-20 form-select box mt-3 sm:mt-0">
      <option>10</option>
      <option>25</option>
      <option>35</option>
      <option>50</option>
    </select>
  </div>
</template>

<script>
export default {
  name: "Pagination",
  props: {
    'links': Object,
  },
  data() {
    return {
      pagination: {},
    }
  },
  mounted() {

  },
  computed() {
    
  }
}
</script>

<style scoped>

</style>
