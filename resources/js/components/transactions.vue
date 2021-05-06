<template>
    <div class="card card-body">
        <h1 class="mb-5 font-weight-bolder">Transactions</h1>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Customer id</th>
                    <th>Initial Balance</th>
                    <th>Transport fate</th>
                    <th>New balance</th>
                    <th>Done when</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="transaction of transactions" v-bind:key="transaction.id">
                    <td>{{transaction.id}}</td>
                    <td>{{transaction.customer_id}}</td>
                    <td>{{transaction.initial_balance}}</td>
                    <td>{{transaction.transport_fare}}</td>
                    <td>{{transaction.initial_balance - transaction.transport_fare}}</td>
                    <td>{{formatDate(transaction.created_at)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios"

export default {
    name: "transactions",
    data: () => ({
        transactions: []
    }),
    async created() {
        setInterval(async () => {
            let { data }  = await axios.get("/api/transactions")
            this.transactions = data;
        }, 500)
    },
    methods: {
        formatDate(date){
            return (new Date(date)).toLocaleString("en-US", {
                weekday: 'short', // long, short, narrow
                day: 'numeric', // numeric, 2-digit
                year: 'numeric', // numeric, 2-digit
                month: 'long', // numeric, 2-digit, long, short, narrow
                hour: 'numeric', // numeric, 2-digit
                minute: 'numeric', // numeric, 2-digit
                second: 'numeric', // numeric, 2-digit
            })
        }
    }
}
</script>

<style scoped>

</style>
