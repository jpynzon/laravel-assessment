<template>
    <v-container class="p-5">
        <v-card>
            <v-card-title class="fw-bold">
                REGISTERED ACCOUNTS
            </v-card-title>

            <v-table>
                <thead>
                    <tr>
                        <th class="text-left">ID</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Email Address</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Test</td>
                        <td>test@gmail.com</td>
                        <td><i class="bi bi-pencil-square"></i> | <i class="bi bi-trash-fill"></i></td>
                    </tr>
                </tbody>
            </v-table>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: 'AdminCp'
};
</script>

<style>
.bi-pencil-square {
    font-size: 20px;
    color: #6499E9;
}

.bi-trash-fill {
    font-size: 20px;
    color: rgb(255, 55, 55);
}
</style>
