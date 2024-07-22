<template>
    <div>
        <v-btn class="bg-red fw-bold mx-3" @click="openDialog">+ Add Service </v-btn>

        <v-dialog v-model="dialog" max-width="600px">
            <v-card>
                <v-card-title class="headline">Add Services</v-card-title>
                <v-card-subtitle>Enter the details of the new item</v-card-subtitle>
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
                    <v-btn color="primary" @click="submitForm">Submit</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'ItemModal',

    data() {
        return {
            dialog: false,
            name: '',
            description: '',
            rules: {
                required: value => !!value || 'Required.',
            },
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
                const response = await axios.post('http://127.0.0.1:8000/add-item', {
                    name: this.name,
                    description: this.description
                });

                console.log('Item added successfully', response.data);
                alert('Item added successfully.');
                window.location.reload();
            } catch (error) {
                console.error('Submission error:', error.response?.data || error.message);
            }
        },
    },
};
</script>
