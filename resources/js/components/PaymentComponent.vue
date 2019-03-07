<template>
  <b-container fluid>
    <b-row>
      <b-col md="12" class="my-1">
          <div>
            <b-card no-body>
              <b-tabs card>
                <b-tab title="Cashier" active>
                  <b-row>
                      <b-col md="6" class="">
                          <b-form-group label-cols-sm="3" label="Patient Record">
                            <b-input-group>
                              <v-select :options="patients" :onChange="getPatientBy"></v-select>
                            </b-input-group>
                          </b-form-group>
                          <b-form-group label-cols-sm="3" label="Receipt No.">
                              <b-input-group>
                                <b-form-input type="text" placeholder="Enter Receipt" v-model="patient.receipt" />
                            </b-input-group>
                          </b-form-group>
                          <b-form-group label-cols-sm="2" label="Time">
                              <b-input-group>
                                  <b-form-input type="text" placeholder="Total Amount" v-model="patient.total_amout" disable/>
                              </b-input-group>
                          </b-form-group>
                          <b-form-group label-cols-sm="2" label="Amount">
                              <b-input-group>
                                  <b-form-input type="text" placeholder="Enter Amount" v-model="patient.total_amout" />
                              </b-input-group>
                          </b-form-group>
                          <b-form-group label-cols-sm="2" label="Change">
                              <b-input-group>
                                  <b-form-input type="text" placeholder="Enter Change" v-model="patient.total_amout" />
                              </b-input-group>
                          </b-form-group>
                      </b-col>
                      <b-col md="6" class="my-1">
                          213
                      </b-col>
                  </b-row>
                </b-tab>
                 <b-tab title="Payments">
                   
                 </b-tab>
              </b-tabs>
            </b-card>
          </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
    import vSelect from 'vue-select';

  export default {
    components : {
        vSelect
    },

    props: ['user_id'],

    data() {
      return {
        patients: [],
        patient: [],
        selected_id: null,
        action: 'store' | 'update',
      }
    },
    mounted() {
        this.getPatients();
    },
    computed: {

    },
    methods: {
        getPatients() {
            axios.get('/api/patients')
            .then(response => {
                console.log(response);
                this.patients = response.data.map( (patient) => ({ 
                    value: patient.id, 
                    label: patient.first_name + ' ' + patient.middle_name + ' ' + patient.last_name,
                }));
            });
        },
        getPatientBy(event) {
            if(event) {
              console.log('selected',event.value);
              this.patient.id = event.value;
            } else {
              this.patient.id = null;
            }
        },
    }
  }
</script>