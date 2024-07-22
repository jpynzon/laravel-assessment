<template>
    <div>
        <i class="bi bi-pencil-square mr-3" @click="openDialog"></i>

        <v-dialog v-model="dialog" max-width="600px">
            <v-card>
                <v-card-title class="headline fw-bold">Edit {{ item.name }}</v-card-title>
                <v-card-subtitle>Edit the details of the item <b>{{ item.name }}</b></v-card-subtitle>
                <v-card-text>
                    <v-form ref="form" v-model="valid">
                        <v-text-field v-model="name" label="Item Name" :rules="[rules.required]"
                            required></v-text-field>
                        <v-textarea v-model="description" label="Item Description" :rules="[rules.required]"
                            required></v-textarea>
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text @click="closeDialog">Close</v-btn>
                    <v-btn color="primary" @click="submitForm">Save</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <div v-if="flashVisible" class="flash-message">{{ flashMessage }}</div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'EditModal',

    props: {
        item: {
            type: Object,
            default: () => ({})
        }
    },

    data() {
        return {
            dialog: false,
            flashMessage: '',
            flashVisible: false,
            name: this.item.name || '',
            description: this.item.description || '',
            valid: false,
            rules: {
                required: value => !!value || 'Required.'
            }
        };
    },

    methods: {
        openDialog() {
            this.dialog = true;
        },

        closeDialog() {
            this.dialog = false;
        },

        async submitForm() {
            try {
                const response = await axios.put(`/item/${this.item.id}`, {
                    name: this.name,
                    description: this.description
                });

                console.log('Item updated successfully', response.data);
                this.flashMessage = 'Item updated successfully.';
                this.flashVisible = true;
                this.closeDialog();
                this.$emit('update');
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } catch (error) {
                console.error('Submission error:', error.response?.data || error.message);
            }
        }
    },

    watch: {
        item: {
            immediate: true,
            handler(newItem) {
                this.name = newItem.name || '';
                this.description = newItem.description || '';
            }
        }
    }
};
</script>

<style scoped>
/* Add any additional styling needed */
</style>
