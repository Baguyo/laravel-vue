<template>
    <Box>
        <template #header>Offer #{{ offer.id }} <span v-if="offer.accepted_at"
                class="bg-green-200 text-green-900 p-1 rounded-md uppercase ml-1">Accepted</span> </template>
        <section class="flex items-center justify-between">
            <div>
                <Price :price="offer.amount" class="text-xl" />
                <div class="text-gray-500">
                    Difference
                    <Price :price="difference" />
                </div>
                <div class="text-gray-500 text-sm">
                    Made By {{ offer.bidder.name }}
                </div>
                <div class="text-gray-500 text-sm">
                    Made On {{ madeOn }}
                </div>
            </div>
            <div>
                <Link 
                    v-if="!isSold"
                    class="btn-outline text-xs font-medium" :href="route('realtor.offer.accept', { offer: offer.id })"
                    method="put" as="button">
                Accept
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>

import Box from '@/Components/UI/Box.vue'
import Price from '@/components/UI/Price.vue'
import { Link } from '@inertiajs/inertia-vue3';
import { computed } from 'vue'

const props = defineProps({
    offer: Object,
    listingPrice: Number,
    isSold: Boolean,
})

const difference = computed(() => props.offer.amount - props.listingPrice)

const madeOn = computed(() => new Date(props.offer.created_at).toDateString())

const notSold = computed(( ) => 
    !props.offer.accepted_at && !props.offer.rejected_at
)


</script>