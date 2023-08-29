<template>
  <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <BOx v-if="listing.images.length" class="md:col-span-7 flex items-center">
      <div class="grid grid-cols-2 gap-1">
        <img v-for="image in listing.images" :key="image.id" :src="image.src" class="border" />
      </div>

    </BOx>
    <!-- <Box v-else class="md:col-span-7 flex items-center ">
        <div class="text-center w-full font-medium text-gray-500">
          No image
        </div>
    </Box> -->
    <EmptyState v-else class="md:col-span-7 flex items-center ">
      No Image
    </EmptyState>


    <div class="md:col-span-5 flex flex-col gap-4">
      <BOx>
        <template #header>
          Basic Info
        </template>
        <Price :price="listing.price" class="text-2xl font-bold" />
        <ListingSpace :listing="listing" class="text-lg" />
        <ListingAddress :listing="listing" />
      </BOx>

      <BOx>
        <template #header>
          Monthly Payment
        </template>
        <div>
          <label class="label">Interest rate ({{ interestRate }})</label>
          <input v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1"
            class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer" />

          <label class="label">Duration ({{ duration }}) years</label>
          <input v-model.number="duration" type="range" min="3" max="35" step="1"
            class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer" />

          <div class="text-gray-600 mt-2">
            <div class="text-gray-400">Your monthly payment</div>
            <Price :price="monthlyPayment" class="text-xl" />
          </div>

          <div class="mt-2 text-gray-500">
            <div class="flex justify-between">
              <div>Total Paid</div>
              <div>
                <Price :price="totalPaid" class="font-medium" />
              </div>
            </div>
            <div class="flex justify-between">
              <div>Principal Paid</div>
              <div>
                <Price :price="listing.price" class="font-medium" />
              </div>
            </div>
            <div class="flex justify-between">
              <div>Interest Paid</div>
              <div>
                <Price :price="totalInterest" class="font-medium" />
              </div>
            </div>
          </div>
        </div>
      </BOx>
      <MakeOffer v-if="user && !offerMade" :listing-id="listing.id" :price="listing.price"
        @offer-updated="offer = $event" />
      <OfferMade v-if="user && offerMade" :offer="offerMade" />
    </div>
  </div>
</template>
  
<script setup>
import Price from '@/components/UI/Price.vue'
import ListingAddress from '../../components/ListingAddress.vue'
import ListingSpace from '@/components/ListingSpace.vue'
import BOx from '@/components/UI/Box.vue'
import MakeOffer from '@/Pages/Listing/Show/Components/MakeOffer.vue'
import OfferMade from '@/Pages/Listing/Show/Components/OfferMade.vue'

import { computed, ref } from 'vue'

import { useMonthlyPayment } from '../../Composables/useMonthlyPayments'
import { usePage } from '@inertiajs/inertia-vue3'
import Box from '@/components/UI/Box.vue'
import EmptyState from '@/components/UI/EmptyState.vue'

const interestRate = ref(2.5)
const duration = ref(25)

const props = defineProps({ listing: Object, offerMade: Object })

const offer = ref(props.listing.price)

console.log(offer);

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(offer, interestRate, duration)


const page = usePage()
const user = computed(() => page.props.value.user)
</script>