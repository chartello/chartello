<template>
    <Head>
        <title>{{ dashboard.name ?? 'Untitled' }}</title>
    </Head>

    <header class="bg-gray-900 border-b">
        <div class="flex flex-col items-center justify-center container mx-auto items-end pt-12 pb-12 px-6 md:flex-row">
            <div class="flex items-center justify-center text-xl text-white mb-6 md:mr-auto md:mb-0">
                <div class="bg-pink-600 h-8 w-8 rounded mr-4 p-2">
                    <img src="/vendor/chartello/img/logo.png" alt="Chartello"/>
                </div>

                <h1 class="leading-tight">
                    <strong>Chartello</strong>
                </h1>
            </div>

            <DatePicker
                v-model="range"
                is-range
                :model-config="{type: 'string',mask: 'YYYY-MM-DD'}"
                :columns="$screens({ default: 1, md: 2 })">
                <template v-slot="{ inputValue, inputEvents, showPopover }">
                    <div class="flex justify-end items-center bg-white rounded relative">
                        <input
                            :value="inputValue.start"
                            v-on="inputEvents.start"
                            class=" px-4 py-1 w-32 text-center rounded focus:outline-none focus:border-indigo-300"
                        />

                        <span>-</span>

                        <input
                            :value="inputValue.end"
                            v-on="inputEvents.end"
                            class=" pl-4 pr-8 w-40 text-center rounded focus:outline-none focus:border-indigo-300"
                        />

                        <CalendarIcon class="w-4 h-4 text-gray-400 absolute right-4 pointer-events-none"/>
                    </div>
                </template>
            </DatePicker>
        </div>
    </header>

    <div class="container mx-auto -mt-2 pb-32">
        <div class="lg:flex">
            <div
                class="absolute w-64 mr-8 pt-8 transition-all duration-500 lg:relative lg:left-0"
                :class="{'left-[-16rem]': !showLinks, 'left-[1.5rem] md:left-[calc(50%-22.5rem)]': showLinks}"
            >
                <DashboardLink v-for="link in links" :key="link.id" :dashboard="link"/>

                <button
                    @click="createDashboard"
                    class="w-full block border-2 bg-white bg-opacity-25 border-dashed text-blue-900 bg-white py-2 px-4 mb-2 rounded-xl flex items-center transition hover:bg-white hover:border-gray-300">
                    <PlusIcon class="w-4 h-4 mr-2"/>
                    Dashboard
                </button>

                <div
                    class="fixed bottom-0 left-0  bg-blue-100 text-blue-500 p-5 rounded-tr cursor-pointer transition hover:bg-blue-200 lg:hidden"
                    @click="showLinks = !showLinks">
                    <ArrowRightIcon class="w-6 h-6 transition" :class="{'rotate-180': showLinks}"/>
                </div>
            </div>

            <div
                class="relative flex-1 transition-all duration-500 px-4 lg:px-0 lg:left-0"
                :class="{'left-0': !showLinks, 'left-[19rem]': showLinks}"
                @click="showLinks = false"
            >
                <Card v-for="panel in dashboard.panels" :key="panel.id" :panel="panel"/>

                <button
                    @click="createPanel(dashboard)"
                    class="block w-full text-blue-900 border-2 bg-white bg-opacity-25 border-dashed py-2 px-4 mb-2 rounded-xl flex items-center transition hover:bg-white hover:border-gray-300"
                    :class="dashboard.panels.length === 0 ? 'mt-8' : ''"
                >
                    <PlusIcon class="w-4 h-4 mr-2"/>
                    Panel
                </button>
            </div>
        </div>
    </div>

    <Modal/>
</template>

<script setup>
import {Head, router, usePage} from '@inertiajs/vue3'
import Card from '../../Components/Panels/Card.vue'
import DashboardLink from '../../Components/Dashboards/Link.vue'
import {DatePicker} from 'v-calendar'
import {ref, watch} from 'vue'
import 'v-calendar/dist/style.css'
import Modal from '../../Components/HelpModal.vue'
import {PlusIcon, CalendarIcon, MenuIcon, ArrowRightIcon} from 'vue-tabler-icons'

const props = defineProps([
    'dashboard',
    'links',
    'start',
    'end',
])

const range = ref({
    start: props.start,
    end: props.end,
})

const showLinks = ref(false)

watch(range, value => {
    router.get(`${location.pathname}?start=${value.start}&end=${value.end}`)
})

function createDashboard() {
    router.post(`/${usePage().props.path}/dashboards`)
}

function createPanel(dashboard) {
    router.post(`/${usePage().props.path}/dashboards/${dashboard.id}/panels`)
}

</script>
