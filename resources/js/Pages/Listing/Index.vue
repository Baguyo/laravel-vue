<template>
  <Filters :filters="filters"/>
  <!-- <Link :href="`/listing/create`">Add new listing</Link> -->
  <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
    <Listing v-for="listing in listings.data" :key="listing.id" :listing="listing" /> 
  </div>

  <div v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4" >
    <Pagination :links="listings.links" />
  </div>
</template>


<script setup>
import Pagination from '@/components/UI/Pagination.vue';
import Listing from './Index/Components/Listing.vue'
import Filters from './Index/Components/Filters.vue'
defineProps({ listings: Object, filters: Object })
</script>

// import { Link } from '@inertiajs/inertia-vue3'
// import ListingAddress from '../../components/ListingAddress.vue'
// import Box from '../../components/UI/BOx.vue'
// import ListingSpace from '../../components/ListingSpace.vue'
// import Price from '../../components/UI/Price.vue'