import { createApp } from "vue";
import { SetupCalendar } from "v-calendar";
import Show from "./Pages/Dashboards/Show.vue";

const data = window.__CHARTELLO__;

const app = createApp(Show, {
  dashboard: data.dashboard,
  dashboards: data.dashboards,
  start: data.start,
  end: data.end,
  path: data.path,
  schema: data.schema,
});

app.provide("chartelloSchema", data.schema);
app.use(SetupCalendar);
app.mount("#app");
