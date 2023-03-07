import { reactive } from "vue";
import { router, usePage } from "@inertiajs/vue3";

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
      router.post(
        `${usePage().props.path}/dashboards`,
        {},
        {
          preserveScroll: true,
        }
      );
    },
  },
  panels: {
    create(dashboard) {
      router.post(
        `${usePage().props.path}/dashboards/${dashboard.id}/panels`,
        {},
        {
          preserveScroll: true,
        }
      );
    },
  },
  helpModal: {
    title: null,
    body: null,
    isOpen: false,
    open(title, body) {
      if (title) {
        this.title = title;
      }

      if (body) {
        this.body = body;
      }

      this.isOpen = true;
    },
    close() {
      this.isOpen = false;
    },
  },
});
