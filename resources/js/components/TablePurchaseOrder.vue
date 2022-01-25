<template>
    <div>


        <b-table
            :data="orders"
            ref="table"
            detailed
            hoverable
            custom-detail-row
            :default-sort="['reference', 'asc']"
            detail-key="id_purchase_order"
            paginated
            per-page="5"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page"
            @details-open="(row, index) => $buefy.toast.open(`Expanded ${row.data.id}`)"
            :show-detail-icon="showDetailIcon">

            <b-table-column
                field="name"
                :label="columnsVisible['reference'].title"
                width="300"
                sortable
                v-slot="props">
                <template v-if="showDetailIcon">
                    {{ props.row.data.id }}
                </template>
                <template v-else>
                    <a @click="toggle(props.row)">
                        {{ props.row.data.id }}
                    </a>
                </template>
            </b-table-column>

            <b-table-column
                field="sold"
                :label="columnsVisible['quantity'].title"
                sortable
                centered
                v-slot="props">
                {{ props.row.data.qty }}
            </b-table-column>

            <b-table-column
                field="available"
                :label="columnsVisible['total'].title"
                sortable
                centered
                v-slot="props">
                {{ props.row.data.total }}
            </b-table-column>

            <b-table-column
                field="available"
                :label="columnsVisible['created'].title"
                sortable
                centered
                v-slot="props">
                {{ props.row.data.crated_formatted }}
            </b-table-column>

            <b-table-column
                field="available"
                :label="columnsVisible['detail'].title"
                sortable
                centered
                v-slot="props">
                <b-button type="is-info is-light">View detail</b-button>
            </b-table-column>


            <template slot="detail" slot-scope="props">
                <tr v-for="item in props.row.data.purchase_payments_status"  :key="item.id">
                    <td v-if="showDetailIcon"></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td class="has-text-centered">
                        Wallet status
                        <div v-if="item.status== 'APPROVED'">
                                 <span class="tag is-success">
                                    {{ item.status }}
                                 </span>
                        </div>
                        <div v-if="item.status== 'PENDING'">
                                     <span class="tag is-warning">
                                        {{ item.status }}
                                     </span>
                        </div>
                        <div v-if="item.status== 'REJECTED'">
                                     <span class="tag is-danger">
                                        {{ item.status }}
                                     </span>
                            <b-button @click="retryPayment(item.id_purchase_order)" size="is-small" type="is-info is-success">Re try payment</b-button>
                        </div>
                    </td>
                    <td>Date : {{ item.crated_formatted }}</td>
                    <td></td>
                    <td ></td>
                </tr>
            </template>
        </b-table>



    </div>
</template>

<script>
export default {
    data() {
        return {
            orders : [],
            columnsVisible: {
                reference: { title: '# Number', display: true },
                quantity: { title: 'Product quantity', display: true },
                total: { title: 'Total price', display: true },
                created: { title: 'Order created at', display: true },
                detail : { title: 'Purchase order detail', display: true },
            },
            showDetailIcon: true
        }
    },
    mounted() {
        axios.get('/api/orders')
            .then((response) => {
                let purchaseOrdersArray = []

                purchaseOrdersArray = Object.keys(response.data).map((field) => {
                    return {
                        data: response.data[field]
                    }
                })
                console.log(purchaseOrdersArray[0].data.purchase_payments_status)
                this.orders=purchaseOrdersArray
            })
            .catch((error) => console.error(error))
    },
    methods: {
        toggle(row) {
            this.$refs.table.toggleDetails(row)
        },
        retryPayment(purchaseOrderId){

            axios.post('retryPayment', {
                    params : {
                        purchaseOrderId  :purchaseOrderId,
                        }

                },{},
            ).then((response) => {
                this.modalUserDataConfirmation= false;
                window.open(response.data, '_blank')
            })
                .catch((error) => console.error(error))

        }
    }
}
</script>
