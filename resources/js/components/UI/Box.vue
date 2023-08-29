<template>
  <div class="border border-b-gray-300 rounded-md p-4 shadow-md ">
    <div class="text-gray-500 font-medium mb-1">
      <slot name="header" />
    </div>
    <slot />
  </div>
</template>