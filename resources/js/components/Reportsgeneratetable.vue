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
                    <div class="column is-2">
                        <label class="label">Report type</label>
                        <div class="select">
                            <select>
                                <option v-for="(option, index) in options " :value=index>{{ option }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="column is-4">
                        <b-field
                            label="Start date"
                            type=""
                            message="">
                            <b-datepicker
                                selected=""
                                name=""
                                v-model="startDate"
                                locale="en-ca">
                            </b-datepicker>
                        </b-field>
                    </div>
                    <div class="column is-4">
                        <b-field
                            label="Finish date"
                            type=""
                            message="">
                            <b-datepicker
                                selected=""
                                name=""
                                v-model="finishDate"
                                locale="en-ca">
                            </b-datepicker>
                        </b-field>
                    </div>

                    <div class="column is-2">
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
                <th>Process</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="report in reports" :key="report.id_report" >
                <td>{{report.id_report}}</td>
                <td>{{report.batch_name}}</td>
                <td>   <b-progress :value="80" show-value format="percent"></b-progress></td>
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
            finishDate : [],
            startDate : [],
            options:{
                0:'Reporte por ventas',
                1:'Reporte por usuarios',
            },
            reports : [],
            batchProgress : 100,
        }
    },
    methods:{
        searchData(){
                axios.post('/generateReport', {
                        params : {
                            value: 'test',
                        }
                    },{},
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
        getProgressBar(){

        }
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
            console.log(e.message)
        })

    }
}
</script>

<style scoped>

</style>
