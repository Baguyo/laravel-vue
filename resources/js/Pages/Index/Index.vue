<template>
  <div>INDEX</div>
  <Link href="/hello"> Show </Link>
  <div>
    {{ message }}
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'

defineProps({ 'message': { type: String } })
</script>


// <!-- MANUAL ADDING LAYOUT TO COMPONENT -->
// <!-- <script>
// import MainLayout from "../../Layouts/MainLayout.vue";
//         export default{
//                 layout: MainLayout
//         };
// </script> -->
