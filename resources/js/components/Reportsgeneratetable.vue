<template>
    <div>
        <b-collapse class="card" animation="slide"  v-cloak>
            <template #trigger="props">
                <div
                    class="card-header"
                    role="button">
                    <p class="card-header-title">Filters</p>
                    <a class="card-header-icon"><b-icon :icon="props.open ? 'menu-down' : 'menu-up'"></b-icon></a>
                </div>
            </template>

            <div class="card-content">
                <div class="columns">
                    <div class="column is-3">
                        <label class="label">Report type</label>
                            <b-select  v-model="reportType" placeholder="Select report category">
                                <option v-for="(option, index) in options" :value="index">
                                    {{ option }}
                                </option>
                            </b-select>
                    </div>
                    <div class="column is-3">
                        <b-field
                            label="Report date range">
                            <b-datepicker
                                placeholder="Click to select"
                                v-model="dates"
                                locale="en-us" range>
                            </b-datepicker>
                        </b-field>
                    </div>


                    <div class="column is-3">
                       <br> <b-button @click="searchData()" type="is-warning is-light" native-type="submit" icon-left="magnify">Generate</b-button>
                    </div>
                </div>


            </div>
        </b-collapse>

        <br><br>

        <table class="table is-narrow is-hoverable is-fullwidth">
            <thead>
            <tr>
                <th>#</th>
                <th>Type of report</th>
                <th>Created at</th>
                <th>File</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(report,index) in reports" :key="report.id_report" >
                <td>{{report.id_report}}</td>
                <td>{{report.name}}</td>
                <td>{{report.crated_formatted}}</td>
                <td>
                <div v-if="report.status=='FINISH'">
                        <div class="notification is-success is-light">
                            <div class="content">
                                The file is ready to download, <a @click.prevent="test({url :'/shopreports/'+report.path , label : report.path})">click here</a>
                            </div>
                        </div>
                </div>
                <div v-else-if="report.status=='FAILED'">
                        <div class="notification is-danger is-light">
                            <div class="content">
                                An error occurred, Please contact the system administrator
                            </div>
                        </div>
                </div>
                <div v-else>
                        <b-progress   type="is-success" ></b-progress>
                </div>
                </td>
                <td></td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>

export default {
    data(){
        return {
            dates : [],
            options:{
                'salesReport' :'Sales report',
                'productsReport':'Products report',
            },
            reports : [],
            reportType: null,
        }
    },
    methods:{
        searchData(){
            this.$buefy.dialog.confirm({
                message: 'Are you sure to generate the selected report?',
                onConfirm: () =>
                    axios.post('/generateReport', {
                            typeReport: this.reportType,
                            dates: this.dates,
                        },
                    ).then((response) => {
                        this.getReports();
                    }).catch((error) =>
                        this.$buefy.dialog.alert({
                            title: 'Error',
                            message: 'The requested information is not correct',
                            type: 'is-danger',
                            hasIcon: true,
                            icon: 'times-circle',
                            iconPack: 'fa',
                            ariaRole: 'alertdialog',
                            ariaModal: true
                        })
                    )
            })
        },
        getReports(){
                axios.get('/api/reports')
                    .then((response) => {
                        console.log(response);
                        this.reports=response.data
                    })
                .catch((error) => console.error(error))
        },
        async test({ url, label }) {
            const response = await axios.get(url, { responseType: "blob" });
            const blob = new Blob([response.data], { type: "application/csv" });
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = label;
            link.click();
            URL.revokeObjectURL(link.href);
        }
    },
    mounted(){
        //Pendiente no hacer doble peticion del getReports
        this.getReports();
        window.Echo.channel('reports').listen('NotifyReportFinish', (e) => {
            if(e.message=="FINISH"){
                this.getReports();
            }
        })
    }
}
</script>

