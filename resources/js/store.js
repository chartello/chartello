import { reactive } from "vue";
import { router, usePage } from "@inertiajs/vue3";

export const store = reactive({
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
