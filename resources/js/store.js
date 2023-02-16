import { reactive } from "vue";
import { router } from "@inertiajs/vue3";

export const store = reactive({
  range: {
    start: null,
    end: null,
    update(start, end, refresh = true) {
      this.start = start;
      this.end = end;

      if (refresh) {
        router.get(`${location.pathname}?start=${this.start}&end=${this.end}`);
      }
    },
  },
  dashboards: {
    create() {
      router.post(`/${usePage().props.path}/dashboards`);
    },
  },
  panels: {
    create(dashboard) {
      router.post(`/${usePage().props.path}/dashboards/${dashboard.id}/panels`);
    },
  },
  helpModal: {
    isOpen: false,
    open() {
      this.isOpen = true;
    },
    close() {
      this.isOpen = false;
    },
  },
});
