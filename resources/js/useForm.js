import { reactive } from "vue";
import { jsonHeaders } from "./http";

export function useForm(initialData) {
  const keys = Object.keys(initialData);

  const form = reactive({
    ...initialData,
    processing: false,

    async _submit(method, url, options = {}) {
      form.processing = true;

      try {
        const body = {};

        for (const key of keys) {
          body[key] = form[key];
        }

        if (method !== "POST") {
          body._method = method;
        }

        const response = await fetch(url, {
          method: "POST",
          headers: jsonHeaders(),
          body: JSON.stringify(body),
        });

        const data = await response.json();

        if (options.onSuccess) {
          options.onSuccess(data);
        }

        if (data.redirect) {
          window.location = data.redirect;
        }
      } finally {
        form.processing = false;
      }
    },

    put(url, options) {
      return form._submit("PUT", url, options);
    },

    delete(url, options) {
      return form._submit("DELETE", url, options);
    },

    post(url, options) {
      return form._submit("POST", url, options);
    },
  });

  return form;
}
