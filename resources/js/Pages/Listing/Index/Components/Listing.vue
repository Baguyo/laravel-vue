<template>
  <Box>
    <div>
      <Link :href="route('listing.show', { listing: listing.id })">
        <div class="flex items-center gap-1">
          <Price :price="listing.price" class="text-2xl font-bold" />   
          <div class="text-xs text-gray-500">
            <Price :price="monthlyPayment" /> pm 
          </div>
        </div>
        <ListingSpace :listing="listing" class="text-lg" />
        <ListingAddress :listing="listing" class="text-gray-500" />
      </Link>
    </div>
  </Box>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import ListingAddress from '@/components/ListingAddress.vue'
import Box from '@/components/UI/Box.vue'
import ListingSpace from '@/components/ListingSpace.vue'
import Price from '@/components/UI/Price.vue'
import {useMonthlyPayment} from '@/Composables/useMonthlyPayments'


const props = defineProps({
  'listing': Object,
})


const {monthlyPayment} = useMonthlyPayment(props.listing.price, 2.5, 25)


</script>

