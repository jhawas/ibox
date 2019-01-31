<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Billing</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <v-select :options="patientRecod" :onChange="getPatientRecordID"></v-select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{billings}}
                            <br>
                            <button type="button" v-on:click="storeBilling">test</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import vSelect from 'vue-select';
    export default {
        components : {
            vSelect
        },

        data() {
            return {
                patientRecod: [{}],
                billings: [],
                patient_record_id: null,
            }
        },

        mounted() {
            this.patientRecords();
        },

        computed: {

        },

        watch: {

        },

        methods: {
            patientRecords() {
                axios.get('/api/patientRecords')
                .then(response => {
                    this.patientRecod = response.data.map( (patientRecord) => ({ 
                        value: patientRecord.id, 
                        label: 'Record No.:' + patientRecord.id + ' (' + patientRecord.patient.first_name + ' ' + patientRecord.patient.middle_name + ' ' + patientRecord.patient.last_name + ')'
                    }));
                });
            },

            getPatientRecordID(event) {
                this.patient_record_id = event.value;
                this.billing();
            },

            billing() {
                 axios.get('/api/billing/patientRecord/'+ this.patient_record_id)
                .then(response => {
                    this.billings = response.data;
                    console.log(response.data);
                });
            },

            storeBilling() {
                axios.post('/api/billing', {
                    patient_record_id: this.patient_record_id,
                    type_of_charge_id: 1,
                    price: 200,
                    quantity: 5,
                    description: 'test'
                })
                .then(response => {
                    console.log(response.data);
                    if(response.data == 'success') {
                        this.billing();
                    }  
                })
                .catch (response => {
                    // List errors on response...
                });
            }
        }

    }
</script>
