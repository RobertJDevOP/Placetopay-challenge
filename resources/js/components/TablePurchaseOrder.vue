<template>
    <div>


        <b-table
            :data="test"
            ref="table"
            detailed
            hoverable
            custom-detail-row
            :default-sort="['name', 'asc']"
            detail-key="name"
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
                {{ props.row.id }}
            </b-table-column>

            <template slot="detail" slot-scope="props">
                <tr v-for="item in props.row.data.purchase_payments_status" :key="item.name">
                    <td v-if="showDetailIcon"></td>
                    <td v-show="columnsVisible['quantity'].display" >&nbsp;&nbsp;&nbsp;&nbsp;{{ item.status }}</td>
                    <td v-show="columnsVisible['quantity'].display" class="has-text-centered">{{ item.status }}</td>
                    <td v-show="columnsVisible['total'].display" class="has-text-centered">{{ item.status }}</td>

                </tr>
            </template>
        </b-table>
    </div>

</template>

<script>
export default {
    data() {
        return {
            test : [],
            columnsVisible: {
                reference: { title: 'Reference', display: true },
                quantity: { title: 'Quantity', display: true },
                total: { title: 'Total', display: true },
                created: { title: 'Created at', display: true },
            },
            showDetailIcon: true
        }
    },
    mounted() {
        axios.get('/orders2')
            .then((response) => {
                //console.log(response.data)
                let a = []

                a = Object.keys(response.data).map((field) => {
                    console.log(field);
                    return {
                        data: response.data[field]
                    }
                })
                console.log(a)
                this.test=a
            })
            .catch((error) => console.error(error))
    },
    methods: {
        toggle(row) {
            this.$refs.table.toggleDetails(row)
        }
    }
}
</script>
