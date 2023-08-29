<template>
  <header class="bg-white border-b border-gray-300 w-full">
    <div class="container mx-auto">
      <nav class="flex p-4 items-center justify-between">
        <div class="text-lg font-medium">
          <Link :href="route('listing.index')"> Listings </Link>
        </div>
        <div class="text-xl font-bold text-cyan-600 text-center">
          <Link :href="route('listing.index')"> LARA + VUE </Link>
        </div>
        <div v-if="user" class="flex items-center gap-4">
          <Link :href="route('notification.index')"
          class="text-gray-500 relative pr-2 py-2 text-lg">
            🔔 
            <div v-if="notificationCount && user" class="absolute right-0 top-0 w-5 h-5 bg-red-700 text-white font-medium border border-white rounded-full text-xs text-center">
              {{ notificationCount }}
            </div>
          </Link>
          <Link :href="route('realtor.listing.index')" class="text-gray-500"> {{ user.name }} </Link>
          <Link :href="route('realtor.listing.create')" class="btn-primary">+ New listing</Link>
          <div>
            <Link :href="route('logout')" method="delete" as="button">Logout</Link>
          </div>
        </div>
        
        <div v-else class="flex items-center gap-2">
          
          <Link :href="route('user-account.create')"> Register</Link>
          <Link :href="route('login')"> Sign in</Link>
        </div>
      </nav>
    </div>
  </header>

  <main class="container mx-auto p-4 w-full">
    <div v-if="flashMessage" class="mb-2 border p-2 bg-green-100 border-green-200 font-semibold rounded-md shadow-lg">
      {{ flashMessage }}
    </div>
    <slot />
  </main>
</template>

<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/inertia-vue3'

const page = usePage()

const flashMessage = computed(
  () => page.props.value.flash.success,
)

const user = computed(()=>page.props.value.user)

const notificationCount = computed(
  () => Math.min(page.props.value.user.notificationCount, 9),
)
// console.log(notificationCount.value);

</script>

<style scoped>
.success {
  background-color: green;
  color: white;
  padding: 2px;
}
</style>

// import { ref } from 'vue'

// const timer = ref(0)
// setInterval(() => {
//   timer.value++
// }, 1000)