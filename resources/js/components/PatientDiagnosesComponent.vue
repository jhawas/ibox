<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
        <b-col md="6" class="my-1">
            <b-form-group label-cols-sm="3" label="Patient Record" class="mb-0">
              <b-input-group>
                <v-select :options="patients" :onChange="getPatientBy"></v-select>
              </b-input-group>
            </b-form-group>
        </b-col>
        <b-col md="6" class="my-1">
            <b-form-group label-cols-sm="3" label="Add" class="mb-0">
                <b-button @click="showModalForm" :disabled="patient_record_id ? false : true">New</b-button>
            </b-form-group>
        </b-col>
    </b-row>
    <b-row>
      <b-col md="6" class="my-1">
        <b-form-group label-cols-sm="3" label="Filter" class="mb-0">
          <b-input-group>
            <b-form-input v-model="filter" placeholder="Type to Search" />
            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col md="6" class="my-1">
        <b-form-group label-cols-sm="3" label="Sort" class="mb-0">
          <b-input-group>
            <b-form-select v-model="sortBy" :options="sortOptions">
              <option slot="first" :value="null">-- none --</option>
            </b-form-select>
            <b-form-select :disabled="!sortBy" v-model="sortDesc" slot="append">
              <option :value="false">Asc</option> <option :value="true">Desc</option>
            </b-form-select>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col md="6" class="my-1">
        <b-form-group label-cols-sm="3" label="Sort direction" class="mb-0">
          <b-input-group>
            <b-form-select v-model="sortDirection" slot="append">
              <option value="asc">Asc</option> <option value="desc">Desc</option>
              <option value="last">Last</option>
            </b-form-select>
          </b-input-group>
        </b-form-group>
      </b-col>

      <b-col md="6" class="my-1">
        <b-form-group label-cols-sm="3" label="Per page" class="mb-0">
          <b-form-select :options="pageOptions" v-model="perPage" />
        </b-form-group>
      </b-col>
    </b-row>

    <!-- Main table element -->
    <b-table
      show-empty
      stacked="md"
      :items="patientDiagnoses"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
    >
      <template slot="diagnose" slot-scope="row">
            {{ row.item.diagnose ? row.item.diagnose.code : null }}
      </template>
      <template slot="actions" slot-scope="row">
        <b-button size="sm" @click="row.toggleDetails">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button>
        <b-button size="sm" @click="showModalEdit(row.item)">
            Edit
        </b-button>
        <b-button size="sm" @click="showModalDelete(row.item, row.index, $event.target)">
            Delete
        </b-button>
      </template>

      <template slot="row-details" slot-scope="row">
        <b-card>
            <b-form-group label-cols-sm="2" label="Patient Record" class="mb-0">
              <b-input-group>
                {{row.item.record.patient.first_name + ' ' + row.item.record.patient.first_name}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Code" class="mb-0">
              <b-input-group>
                {{ row.item.diagnose ? row.item.diagnose.code : null }}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Diagnoses" class="mb-0">
              <b-input-group>
                {{row.item.diagnoses}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Remarks" class="mb-0">
              <b-input-group>
                {{row.item.remarks}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Datetime" class="mb-0">
              <b-input-group>
                {{row.item.created_at}}
              </b-input-group>
            </b-form-group>
        </b-card>
      </template>
    </b-table>

    <b-row>
      <b-col md="6" class="my-1">
        <b-pagination
          :total-rows="totalRows"
          :per-page="perPage"
          v-model="currentPage"
          class="my-0"
        />
      </b-col>
    </b-row>
    <!-- Info modal -->
    <b-modal id="modalInfo" @hide="resetModal" :title="modalInfo.title" ok-only>
      <pre>{{ modalInfo.content }}</pre>
    </b-modal>
    <b-modal id="modalDelete" @hide="resetModal" :title="modalInfo.title" @ok="onDelete">
      <pre>{{ modalInfo.content }}</pre>
    </b-modal>
    <b-modal 
        id="modalForm" 
        @hide="resetModal" 
        :title="modalInfo.title" 
        @ok="onSubmit(action)"
        size="lg"
    >
      <form @submit.stop.prevent="onSubmit">
        <b-form-group label-cols-sm="2" label="Diagnoses">
            <b-input-group>
                <v-select v-model="selected" :options="diagnoses" :onChange="getDiagnosesBy"></v-select>
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="Diagnoses">
            <b-input-group>
                <b-form-textarea
                  id="textarea1"
                  v-model="patientDiagnose.diagnoses"
                  placeholder="Enter Diagnoses"
                  rows="3"
                  max-rows="6"
                />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="Remarks">
            <b-input-group>
                <b-form-textarea
                  id="textarea1"
                  v-model="patientDiagnose.remarks"
                  placeholder="Enter Remarks"
                  rows="3"
                  max-rows="6"
                />
            </b-input-group>
        </b-form-group>
      </form>
    </b-modal>
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
        patientDiagnose: [],
        patientDiagnoses: [],
        diagnoses: [],
        patient_record_id: null,
        selected_id: null,
        selected: {},
        action: 'store' | 'update',
        fields: [
          { key: 'diagnose', label: 'Code', sortable: true, sortDirection: 'desc' },
          { key: 'diagnoses', label: 'Diagnoses', sortable: true, sortDirection: 'desc', class: 'text-center' },
          { key: 'remarks', label: 'Remarks', sortable: true, sortDirection: 'desc', class: 'text-center' },
          { key: 'actions', label: 'Actions', class: 'text-right' }
        ],
        currentPage: 1,
        perPage: 5,
        totalRows: 1,
        pageOptions: [5, 10, 15],
        sortBy: null,
        sortDesc: false,
        sortDirection: 'asc',
        filter: null,
        modalInfo: { title: '', content: '' },
      }
    },
    mounted() {
        this.getPatients();
        this.getDiagnoses();
    },
    computed: {
      sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      }
    },
    methods: {
        resetModal() {
            this.modalInfo.title = ''
            this.modalInfo.content = ''
            this.selected_id = null;
        },
        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            console.log('filter', filteredItems);
            this.totalRows = filteredItems.length
            this.currentPage = 1
        },
        getPatients() {
            axios.get('/api/patientRecords')
            .then(response => {
                console.log(response);
                this.patients = response.data.map( (patientRecord) => ({ 
                    value: patientRecord.id, 
                    label: patientRecord.patient.first_name + ' ' + patientRecord.patient.middle_name + ' ' + patientRecord.patient.last_name,
                }));
            });
        },
        getPatientBy(event) {
            if(event) {
              console.log('selected',event.value);
              this.patient_record_id = event.value;
              
            } else {
              this.patient_record_id = null;
            }
            this.getPatientDiagnoses();
        },
        getPatientDiagnoses() {
            axios.get('/api/patientDiagnoses/'+this.patient_record_id)
            .then(response => {
                this.patientDiagnoses = response.data;
                this.totalRows = this.patientDiagnoses.length;
                console.log(this.patientDiagnoses, this.totalRows);
            });
        },
        showModalDelete(item, index, button) {
            this.modalInfo.title = 'Record';
            this.modalInfo.content = 'Are you sure you want to delete?';
            this.$root.$emit('bv::show::modal', 'modalDelete', button);
            this.selected_id = item.id;
        },
        onDelete() {
            axios.delete('/api/patientDiagnoses/' + this.selected_id)
            .then(response => {
                if(response.data == 'success') {
                    this.getPatientDiagnoses();
                }  
            })
            .catch (response => {
                console.log(response);
            });
        },
        showModalForm() {
            this.action = 'store';
            this.patientDiagnose = [];
            this.modalInfo.title = "Patient Diagnoses";
            this.$root.$emit('bv::show::modal', 'modalForm');
        },
        onSubmit(action) {
            console.log('submit',this.patientDiagnose);
            if(action === 'store') {
                axios.post('/api/patientDiagnoses', {
                    user_id: this.user_id,
                    patient_record_id: this.patient_record_id,
                    diagnose_id: this.patientDiagnose.diagnose_id,
                    diagnoses: this.patientDiagnose.diagnoses,
                    remarks: this.patientDiagnose.remarks,
                })
                .then(response => {
                    console.log(response.data);
                    if(response.data == 'success') {
                        this.getPatientDiagnoses();
                    }  
                })
                .catch (response => {
                    console.log(response);
                });
            } else {
                axios.put('/api/patientDiagnoses/' + this.selected_id, {
                    user_id: this.user_id,
                    patient_record_id: this.patient_record_id,
                    diagnose_id: this.patientDiagnose.diagnose_id,
                    diagnoses: this.patientDiagnose.diagnoses,
                    remarks: this.patientDiagnose.remarks,
                })
                .then(response => {
                    console.log(response.data);
                    if(response.data == 'success') {
                        this.getPatientDiagnoses();
                    }  
                })
                .catch (response => {
                    console.log(response);
                });
            }
        },
        showModalEdit(item) {
            this.action = 'edit';
            this.selected_id = item.id;
            axios.get('/api/patientDiagnoses/'+this.selected_id+'/edit')
            .then(response => {
                this.patientDiagnose = response.data;
                this.selected = {
                  id: response.data.diagnose.id,
                  label: response.data.diagnose.code
                };
            });
            this.modalInfo.title = "Patient Diagnoses";
            this.$root.$emit('bv::show::modal', 'modalForm');
        },
        getDiagnoses() {
            axios.get('/api/diagnoses')
            .then(response => {
                console.log(response);
                this.diagnoses = response.data.map( (diagnoses) => ({ 
                    value: diagnoses.id, 
                    label: diagnoses.code
                }));
            });
        },
        getDiagnosesBy(event) {
            if(event) {
              console.log('selected',event.value);
              this.patientDiagnose.diagnose_id = event.value;              
            } else {
              this.patientDiagnose.diagnose_id = null;
            }
        },
    }
  }
</script>