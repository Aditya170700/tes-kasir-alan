import { createToast } from "mosha-vue-toastify";
import "mosha-vue-toastify/dist/style.css";

export const toast = (message, success = true) => {
    createToast(message, {
        type: success ? 'success' : 'danger',
        timeout: 3000,
        position: 'top-right',
        showIcon: true,
        toastBackgroundColor: success ? '#0E9F6E' : '#F05252',
    });
}
