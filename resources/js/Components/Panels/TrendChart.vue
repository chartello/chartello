<template>
  <div>
    <div
      class="mb-4 px-4 text-3xl"
      :class="{ '-mt-6': !form.name && !editing }"
      v-text="Intl.NumberFormat().format(panel.aggregate)"
    />
    <div ref="canvas"></div>
  </div>
</template>

<script setup>
import { onMounted, ref, watch } from "vue";
import ApexCharts from "apexcharts";
import { store } from "../../store";

const props = defineProps(["form", "panel", "editing"]);

const canvas = ref(null);

const chart = ref(null);

const options = {
  chart: {
    type: "area",
    height: 250,
    toolbar: {
      show: false,
    },
    events: {
      zoomed: function (chartContext, { xaxis }) {
        store.range.update(xaxis.min, xaxis.max);
      },
    },
  },
  series: [
    {
      name: "Rows",
      data: [],
    },
  ],
  xaxis: {
    type: "datetime",
    labels: {
      style: {
        colors: "#b7b7b7",
      },
    },
  },
  yaxis: {
    labels: {
      style: {
        colors: "#b7b7b7",
      },
    },
  },
  stroke: {
    curve: "smooth",
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
      colors: ["#333"],
    },
    offsetX: 30,
  },
};

function draw() {
  let data = props.panel.data;

  if (!data[0] || !data[0].x) {
    data = [];
  }

  if (chart.value) {
    chart.value.updateSeries([
      {
        name: props.form?.title ? props.form.title : "Rows",
        data: data,
      },
    ]);
  }
}

onMounted(() => {
  chart.value = new ApexCharts(canvas.value, options);
  chart.value.render();
  draw();
});

watch(
  () => [props.panel.data, props.form.title],
  () => {
    draw();
  }
);
</script>
