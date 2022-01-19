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
                       <br> <b-button @click="searchData()" type="is-link" native-type="submit" icon-left="magnify">Generate</b-button>
                    </div>
                </div>


            </div>
        </b-collapse>

        <br>Your reports



        <table class="table is-narrow is-hoverable is-fullwidth">
            <thead>
            <tr>
                <th>#</th>
                <th>Type of report</th>
                <th>Created at</th>
                <th>File</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(report,index) in reports" :key="report.id_report" >
                <td>{{report.id_report}}</td>
                <td>{{report.name}}</td>
                <td>{{report.created_at}}</td>
                <td>
                <template v-if="report.status=='FINISH'">
                    <b-collapse :open="true" >
                        <div class="notification">
                            <div class="content">
                                The file is ready to download, <a @click.prevent="test({url :'/shopreports/'+report.path , label : report.path})">click here</a>
                            </div>
                        </div>
                    </b-collapse>
                </template>
                <template v-else>
                    <b-collapse :open="true" >
                        <b-progress></b-progress>
                    </b-collapse>
                </template>
                </td>
            </tr>
            </tbody>
        </table>

    </div>
</template>

<script>

import Echo from 'laravel-echo'
window.Pusher = require('pusher-js')

export default {
    data() {
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
                //Validacion al lado del front-
                axios.post('/generateReport', {
                            typeReport: this.reportType,
                            dates: this.dates,
                    },
                ).then((response) => {
                 this.getReports();
                }).catch((error) => console.error(error))
        },
        getReports(){
                axios.get('/api/reports')
                    .then((response) => {
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
       //Pendiente no hacer doble peticion del getReports

    },
    mounted() {
       this.getReports();
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: 'robertico',
            wsHost: window.location.hostname,
            wsPort: 6001,
            disableStats: true,
            forceTLS: false,
            enabledTransports: ['ws', 'wss']
        })
        window.Echo.channel('home').listen('NotifyReportFinish', (e) => {
            if(e.message=="FINISH"){
                this.getReports();
            }
        })

    }
}
</script>

