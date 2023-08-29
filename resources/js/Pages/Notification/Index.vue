<template>
    <h1 class="text-3xl mb-4">
        Your Notifications
    </h1>

    <section v-if="notifications.data.length" class="text-gray-700">
        <div v-for="notification in notifications.data" :key="notification.id"
            class="border-b border-gray-200 py-4 flex justify-between items-center">
            <div>
                <span v-if="notification.type === 'App\\Notifications\\OfferMade'">
                    Offer <Price :price="notification.data.amount"></Price> for
                    <Link :href="route('realtor.listing.show', {listing: notification.data.listing_id})"
                    class="text-cyan-600 "
                    >Listing </Link> was made
                </span>
            </div>
            <div>
                <Link 
                    :href="route('notification.seen', {notification:notification.id})"
                    as="button"
                    method="put"
                    v-if="!notification.read_at" class="btn-outline text-xs font-medium uppercase">
                    Mark as read
                </Link>
            </div>

        </div>
    </section>

    <EmptyState v-else>
        No Notifications yet!
    </EmptyState>

    <section v-if="notifications.data.length" class="w-full flex justify-center mb-4 mt-4">
        <Pagination :links="notifications.links" />

    </section>
</template>

<script setup>
 
 import Price from '@/components/UI/Price.vue'
 import { Link } from '@inertiajs/inertia-vue3'
 import Pagination from '@/components/UI/Pagination.vue'
 import EmptyState from '@/components/UI/EmptyState.vue' 
defineProps({
    notifications: Object
})
</script>