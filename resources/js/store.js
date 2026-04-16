import { reactive } from "vue";
import { jsonHeaders } from "./http";

export const store = reactive({
  path: null,

  range: {
    start: null,
    end: null,
    update(start, end, refresh = true) {
      this.start = start;
      this.end = end;

      if (refresh) {
        window.location = `${location.pathname}?start=${this.start}&end=${this.end}`;
      }
    },
  },
  dashboards: {
    create() {
      fetch(`${store.path}/dashboards`, {
        method: "POST",
        headers: jsonHeaders(),
      })
        .then((r) => r.json())
        .then((data) => {
          if (data.redirect) window.location = data.redirect;
        });
    },
  },
  panels: {
    create(dashboard) {
      fetch(`${store.path}/dashboards/${dashboard.id}/panels`, {
        method: "POST",
        headers: jsonHeaders(),
      })
        .then((r) => r.json())
        .then((data) => {
          if (data.redirect) window.location = data.redirect;
        });
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
