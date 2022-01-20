<template>
  <div>

    <div v-if="exportStatus==='FINISH'">
            <div class="columns">
                    <div class="column is-4">
                         <b-button  @click="exportCSV()" type="is-warning is-success"> Export product in csv</b-button>
                    </div>
                    <div class="column is-8">
                        <div class="notification is-success is-light">
                            <div class="content">
                                The file is ready to download, <a @click.prevent="donwloadFile({url :'/shopreports/'+exportPath , label : exportPath})">click here</a>
                            </div>
                        </div>
                    </div>
            </div>
    </div>
    <div v-else-if="exportStatus=='FAILED'">
        <div class="columns">
            <div class="column is-6">
                    <div class="notification is-danger is-light">
                        <div class="content">
                            An error occurred, Please contact the system administrator
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div v-else-if="exportStatus=='PROCESSING'">
        <div class="columns">
            <div class="column is-6">
                <b-progress   type="is-success" ></b-progress> Processing
            </div>
        </div>
    </div>
    <div v-else-if="exportStatus=='WITHOUT_PROCESSING'">
        <div class="columns">
            <div class="column is-4">
                <b-button  @click="exportCSV()" type="is-warning is-success"> Export product in csv</b-button>
            </div>
        </div>
    </div>


  </div>
</template>

<script>
export default {

    data() {
        return {
            exportStatus : '',
            exportPath : '',
        }
    },
    methods : {
        getStatusExport(){
            axios.get('/api/getReportStatus')
                .then((response) => {
                    this.exportStatus=response.data.status;
                    this.exportPath=response.data.exportPath;
                })
                .catch((error) => console.error(error))
        },
        async donwloadFile({ url, label }) {
            const response = await axios.get(url, { responseType: "blob" });
            const blob = new Blob([response.data], { type: "application/csv" });
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = label;
            link.click();
            URL.revokeObjectURL(link.href);
        },
        exportCSV(){
            this.$buefy.dialog.confirm({
                message: 'Are you sure to generate the product report?',
                onConfirm: () =>
                    axios.post('/api/exportProducts', {},
                    ).then((response) => {
                        this.getStatusExport();
                    }).catch((error) => console.log(error))
            })
        }
    },
    beforeMount(){
        this.getStatusExport();
        window.Echo.channel('exports').listen('NotifyProductExportFinish', (e) => {
            if(e.message=="FINISH"){
               this.getStatusExport();
            }
        })
    }
}
</script>

<style scoped>

</style>
