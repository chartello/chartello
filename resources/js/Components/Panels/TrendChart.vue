<template>
    <div ref="canvas"></div>
</template>

<script setup>
import {onMounted, ref, watch} from 'vue'
import ApexCharts from 'apexcharts'

const props = defineProps(['title', 'data'])

const canvas = ref(null)

const chart = ref(null)

const options = {
    chart: {
        type: 'area',
        height: 250,
        toolbar: {
            show: false,
        },
    },
    series: [
        {
            name: 'Rows',
            data: [],
        },
    ],
    xaxis: {
        type: 'datetime',
        labels: {
            style: {
                colors: '#b7b7b7',
            },
        },
    },
    yaxis: {
        labels: {
            style: {
                colors: '#b7b7b7',
            },
        },
    },
    stroke: {
        curve: 'smooth',
    },
    grid: {
        yaxis: {
            lines: {
                show: false,
            },
        },
    },
    dataLabels: {
        enabled: false,
        style: {
            colors: ['#333'],
        },
        offsetX: 30,
    },
}

function draw() {
    if (chart.value) {
        chart.value.updateSeries([
            {
                name: props.title ?  props.title : 'Rows',
                data: props.data,
            },
        ])
    }
}

onMounted(() => {
    chart.value = new ApexCharts(canvas.value, options)
    chart.value.render()
    draw()
})

watch(() => [props.data, props.title], () => {
    draw()
})

</script>
