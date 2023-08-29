<template>
    <div>
        You need to be verify first.
    </div>
    <div>
    <Link :href="route('verification.send')" method="post" as="button"
     class="text-indigo-600">Resend Verification    </Link>    
    </div>
</template>

<script setup>
import {Link} from '@inertiajs/inertia-vue3'
</script>