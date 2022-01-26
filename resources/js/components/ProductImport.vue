<template>
    <div>
            <div v-if="importStatus=='FINISH'">
                <div class="columns">
                    <div class="column is-4">
                        <b-field class="file is-success is-light" :class="{'has-name': !!file}">
                            <b-upload size="is-small" v-model="file" class="file-label" rounded>
                                    <span class="file-cta">
                                        <b-icon class="file-icon" icon="upload"></b-icon>
                                        <span class="file-label">Import file csv</span>
                                    </span>
                                <span class="file-name" v-if="file">
                                        {{ file.name }}
                                    </span>
                            </b-upload>
                        </b-field>
                    </div>
                    <div class="column is-2">
                        <b-button  @click="metodoNormal()"  type="is-warning is-light" rounded>Load file</b-button>
                    </div>
                    <div class="column is-6">
                        <b-notification
                            auto-close
                            type="is-success is-light"
                            aria-close-label="Close notification">
                            The last import of products was successful
                        </b-notification>
                    </div>
                </div>
            </div>
            <div v-else-if="importStatus=='FAILED'">
                <div class="columns">
                    <div class="column is-4">
                        <b-field class="file is-success is-light" :class="{'has-name': !!file}">
                            <b-upload size="is-small" v-model="file" class="file-label" rounded>
                                    <span class="file-cta">
                                        <b-icon class="file-icon" icon="upload"></b-icon>
                                        <span class="file-label">Import file csv</span>
                                    </span>
                                <span class="file-name" v-if="file">
                                        {{ file.name }}
                                    </span>
                            </b-upload>
                        </b-field>
                    </div>
                    <div class="column is-2">
                        <b-button native-type="submit" @click="metodoNormal()"  type="is-warning is-light" rounded>Load file</b-button>
                    </div>
                    <div class="column is-6">
                        <b-notification
                            auto-close
                            type="is-danger is-light"
                            aria-close-label="Close notification">
                            In the last import an error occurred, Please contact the system administrator
                        </b-notification>
                    </div>
                </div>
            </div>
            <div v-else-if="importStatus=='PROCESSING'">
                <div class="columns">
                    <div class="column is-6">
                        <b-progress  type="is-success" ></b-progress> Processing
                    </div>
                </div>
            </div>
            <div v-else-if="importStatus=='WITHOUT_PROCESSING'">
                <div class="columns">
                    <div class="column is-4">
                            <b-field class="file is-success is-light" :class="{'has-name': !!file}">
                                <b-upload size="is-small" v-model="file" class="file-label" rounded>
                                    <span class="file-cta">
                                        <b-icon class="file-icon" icon="upload"></b-icon>
                                        <span class="file-label">Import file csv</span>
                                    </span>
                                    <span class="file-name" v-if="file">
                                        {{ file.name }}
                                    </span>
                                </b-upload>
                            </b-field>
                    </div>
                    <div class="column is-8">
                        <b-button native-type="submit" @click="metodoNormal()"  type="is-warning is-light" rounded>Load file</b-button>
                    </div>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            importStatus: '',
            file: null,
        }
    },
    methods: {
        getStatusImport() {
                axios.get('/api/getReportStatus/'+'Products import')
                .then((response) => {
                    console.log(response.data.status)
                    this.importStatus = response.data.status;
                }).catch((error) => console.error(error))
        },
        metodoNormal() {
            //Validate extension ared csv fronted and backend
            let formData = new FormData();
            formData.append('file', this.file);
            this.$buefy.dialog.confirm({
                message: 'Are you sure to import this file?',
                onConfirm: () =>
                    axios.post('/api/importProducts', formData)
                        .then((response) => {
                            this.getStatusImport();
                        }).catch((error) => console.log(error))
            })
        },
    },
    beforeMount() {
        this.getStatusImport();
        window.Echo.channel('importsProduct').listen('NotifyImportProductFinish', (e) => {
           location.reload();
        })
        window.Echo.channel('importProductValidator').listen('ImportProductsValidateErrors', (e) => {
            this.$buefy.dialog.alert({
                title: 'Error',
                message: [e.errors] ,
                type: 'is-danger',
                hasIcon: true,
                icon: 'times-circle',
                iconPack: 'fa',
                ariaRole: 'alertdialog',
                ariaModal: true
            })
        })
    }
}
</script>

