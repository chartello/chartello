import {reactive} from 'vue'

export const store = reactive({
    helpModal: {
        isOpen: false,
        open() {
            this.isOpen = true
        },
        close() {
            this.isOpen = false
        },
    },
})
