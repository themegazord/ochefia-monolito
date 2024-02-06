<script setup>
import {computed} from "vue";

const props = defineProps({
    loading: {
        type: Boolean,
        required: true
    }
})

const mostraModal = computed(() => {
    return props.loading
})
</script>

<template>
    <v-dialog
        v-model="mostraModal"
        width="auto"
    >
        <v-progress-circular
            v-if="loading"
            :size="80"
            :width="10"
            indeterminate>
        </v-progress-circular>
    </v-dialog>
</template>

<style scoped>

</style>
