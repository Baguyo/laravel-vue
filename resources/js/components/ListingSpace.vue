<template>
  <div>
    <span class="font-bold">{{ listing.beds }} bds </span> <span class="text-gray-400">|</span> &nbsp;
    <span class="font-bold">{{ listing.baths }} baths</span> <span class="text-gray-400">|</span> &nbsp;
    <span class="font-bold">{{ listing.area }} m <sup>2</sup> </span>
  </div>
</template>

<script setup>
defineProps({
  listing: Object,
})
</script>