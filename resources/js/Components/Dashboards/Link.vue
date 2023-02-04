<template>
    <form
        method="POST"
        class="flex items-center text-blue-900 px-4 mb-2 rounded-lg transition"
        :class="{ 'bg-blue-100': active, ' hover:bg-gray-100': !active }"
        @submit.prevent="update"
    >
        <input
            v-if="editing"
            type="text"
            v-model="form.name"
            ref="input"
            placeholder="Untitled"
            class="flex-1 w-full py-2 border-0 p-0 bg-transparent underline underline-offset-4 decoration-gray-200 focus:decoration-blue-200 focus:ring-0">
        <Link
            v-else
            class="flex-1 py-2"
            :href="`/${$page.props.path}/dashboards/${dashboard.id}`"
            v-text="form.name ? form.name : 'Untitled'"
        />

        <template v-if="active">
            <IconButton v-if="editing && !form.processing" @click="remove" type="button" class="text-red-400 mr-1 hover:bg-red-100">
                <TrashIcon  class="w-4 h-4"/>
            </IconButton>

            <Spinner v-if="form.processing" class="ml-2"/>

            <IconButton v-else-if="editing" @click="update" class="text-blue-500 hover:bg-blue-200">
                <CheckIcon class="w-4 h-4"/>
            </IconButton>

            <IconButton v-else @click="edit" class="text-blue-500 hover:bg-blue-200">
                <PencilIcon class="w-4 h-4"/>
            </IconButton>
        </template>
    </form>
</template>

<script setup>
import {Link, useForm, usePage} from '@inertiajs/vue3'
import { PencilIcon, CheckIcon, TrashIcon } from "vue-tabler-icons"
import {computed, onMounted, ref, watch} from 'vue'
import Spinner from '../Spinner.vue'
import IconButton from '../IconButton.vue'

const props = defineProps(['dashboard'])

const editing = ref(false)

const active = computed(() => {
    let url = usePage().url

    url = url.indexOf('?') === -1 ? url : url.substring(0, url.indexOf('?'))

    return url === `/${usePage().props.path}/dashboards/${props.dashboard.id}`
})

const form = useForm({
    name: ref(props.dashboard.name),
})

const input = ref(null)

function edit() {
    editing.value = true
    setTimeout(() => input.value.focus(), 50)
}

function update() {
    form.put(`/${usePage().props.path}/dashboards/${props.dashboard.id}`, {
        preserveScroll: true,
        onSuccess: () => editing.value = false
    })
}

function remove() {
    form.delete(`/${usePage().props.path}/dashboards/${props.dashboard.id}`, {
        preserveScroll: true
    })
}

watch(active, value => {
    if(!value) {
        editing.value = false
    }
})

onMounted(() => {
    if(active.value && props.dashboard.name === null) {
        edit()
    }
})
</script>
