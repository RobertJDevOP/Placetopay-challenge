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
    </div>
</template>

<script>
export default {
    data() {
        return {
            finishDate : [],
            startDate : [],
            options:{
                0:'Reporte por ventas',
                1:'Reporte por usuarios',
            },
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
                  console.log(response);
                }).catch((error) => console.error(error))
        }
    }
}
</script>

<style scoped>

</style>
