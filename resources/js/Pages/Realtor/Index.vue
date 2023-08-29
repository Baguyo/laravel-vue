<template>
  <h1 class="text-3xl mb-4">Your Listings</h1>
  <section>
    <RealtorFilters :filters="filters" />
  </section>
  <section v-if="listings.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
    <Box  v-for="listing in listings.data" :key="listing.id" :class="{'border-dashed': listing.deleted_at}">
      <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
        <div :class="{'opacity-25': listing.deleted_at}">
          <div v-if="listing.sold_at != null" class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 inline-block rounded-md mb-2">
            SOLD
          </div>
          <div class="xl:flex items-center gap-2">
            <Price :price="listing.price" class="text-2xl font-medium" /> 
            <ListingSpace :listing="listing" />
          </div>
          <ListingAddress :listing="listing" class="text-gray-500" />
        </div>
        <section>
          <div class="flex items-center gap-1 text-gray-600">
            <a 
              class="btn-outline text-xs font-meduium" 
              :href="route('listing.show', {listing: listing.id})"
              target="_blank"
            >Preview
            </a>
            <Link class="btn-outline text-xs font-meduium" :href="route('realtor.listing.edit', {listing:listing.id})">Edit</Link>
            <Link 
              v-if="!listing.deleted_at"
              :disabled="isButtonDisabled" 
              class="btn-outline text-xs font-meduium" :href="route('realtor.listing.destroy', {'listing':listing.id})" 
              method="delete" as="button" @click.once="deleteListing($event)"
            > 
              Delete
            </Link>
            <Link
              v-else
              class="btn-outline text-xs font-meduium"
              :href="route('realtor.listing.restore', {listing: listing.id})"
              as="button"
              method="put"
            > 
              Restore
            </Link>
          </div>
          <div class="mt-2">
            <Link 
              :href="route('realtor.listing.image.create', {listing: listing.id})" 
              class="block w-full btn-outline text-xs font-medium text-center"
            > 
              Images ( {{ listing.images_count }} )
            </Link>
          </div>
          <div class="mt-2">
            <Link 
              :href="route('realtor.listing.show', {listing: listing.id})" 
              class="block w-full btn-outline text-xs font-medium text-center"
            > 
              Offers ( {{ listing.offers_count }} )
            </Link>
          </div>
        </section>
      </div>
    </Box>
  </section>
  <EmptyState v-else>No listings yet</EmptyState>
  <section v-if="listings.data.length" class="w-full flex justify-center mt-4 mb-4">
    <Pagination :links="listings.links" />
  </section> 
</template>

<script setup>
import ListingAddress from '@/components/ListingAddress.vue'
import ListingSpace from '@/components/ListingSpace.vue'
import Box from '@/components/UI/Box.vue'
import Price from '@/components/UI/Price.vue'
import { Link } from '@inertiajs/inertia-vue3'
import RealtorFilters from '@/Pages/Realtor/Index/Components/RealtorFilters.vue'
import Pagination from '@/components/UI/Pagination.vue'

import { ref} from 'vue'
import EmptyState from '@/components/UI/EmptyState.vue'



var isButtonDisabled = ref(false)
const deleteListing = ($event) => {
  isButtonDisabled.value = true
  setInterval(() => {
    isButtonDisabled.value = false
  }, 4000)
    
}






defineProps({
  listings: Object,
  filters: Object,
})

</script>