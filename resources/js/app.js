import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { SetupCalendar } from "v-calendar";

createInertiaApp({
  resolve: (name) => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(SetupCalendar)
      .mount(el);
  },
});
