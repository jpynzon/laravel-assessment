<template>
    <div>
        <i class="bi bi-trash-fill" @click="openDialog"></i>

        <v-dialog v-model="dialog" max-width="400px">
            <v-card>
                <v-card-title class="headline">Confirm Deletion</v-card-title>
                <v-card-subtitle>Are you sure you want to delete <b>{{ item.name }}</b>?</v-card-subtitle>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text @click="closeDialog">Cancel</v-btn>
                    <v-btn color="red" @click="confirmDelete">Delete</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <div v-if="flashVisible" class="flash-message">{{ flashMessage }}</div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'DeleteModal',

    props: {
        item: {
            type: Object,
            default: () => ({})
        }
    },

    emits: ['deleted'],

    data() {
        return {
            dialog: false,
            flashMessage: '',
            flashVisible: false,
        };
    },

    methods: {
        openDialog() {
            this.dialog = true;
        },

        closeDialog() {
            this.dialog = false;
        },

        hideFlashMessage() {
            setTimeout(() => {
                this.flashVisible = false;
            }, 3000); // Hide the flash message after 3 seconds
        },

        async confirmDelete() {
            try {
                await axios.delete(`http://127.0.0.1:8000/items/${this.item.id}`);
                this.flashMessage = 'Item deleted successfully.';
                this.flashVisible = true;
                this.hideFlashMessage();
                this.$emit('deleted');
                this.closeDialog();
            } catch (error) {
                console.error('Deletion error:', error.response?.data || error.message);
            }
        }
    }
};
</script>
