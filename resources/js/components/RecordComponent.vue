<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
        <b-col md="6" class="my-1">
            <b-form-group label-cols-sm="3" label="Record" class="mb-0">
                <b-button @click="showModalForm">New</b-button>
            </b-form-group>
        </b-col>
        <b-col md="6" class="my-1">
          <b-form-group label-cols-sm="3" label="Type of Patient" class="mb-0">
            <b-form-select 
              :options="patientOptions" 
              v-model="patientType"
              v-on:change="getSelectedPatientType"
            />
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
      :items="records"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
    >
      <template slot="patient" slot-scope="row">
          {{ row.item.patient.first_name + ' ' + row.item.patient.last_name }}
      </template>

      <template slot="patient-type" slot-scope="row">
          {{ row.item.record_type.code}}
      </template>

      <template slot="room" slot-scope="row">
          {{ row.item.room ? row.item.room.code : null}}
      </template>

      <template slot="actions" slot-scope="row">
        <b-button size="sm" @click="row.toggleDetails">
          {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button>
        <b-button size="sm" @click="showMedication(row.item)">
            Medication
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
            <b-row>
              <b-col md="6">
                <legend>Information</legend>
                <b-form-group label-cols-sm="3" label="Patient">
                  <b-input-group>
                    {{row.item.patient.first_name + ' ' + row.item.patient.middle_name + ' ' + row.item.patient.last_name}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="3" label="Type Of Patient">
                  <b-input-group>
                    {{row.item.record_type.code}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="3" label="Attending Physician">
                  <b-input-group>
                    {{row.item.physician.suffix + ' ' + row.item.physician.first_name + ' ' + row.item.physician.last_name}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="3" label="Height">
                  <b-input-group>
                    {{row.item.height}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="3" label="Weight">
                  <b-input-group>
                    {{row.item.weight}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="3" label="Blood Pressure">
                  <b-input-group>
                    {{row.item.blood_pressure}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="3" label="Pulse Rate">
                  <b-input-group>
                    {{row.item.pulse_rate}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="3" label="Temperature">
                  <b-input-group>
                    {{row.item.temperature}}
                  </b-input-group>
                </b-form-group>
              </b-col>
              <b-col md="6">
                <legend>{{row.item.record_type.id == 1 ? 'Checkup' : 'Admitted'}}</legend>
                <b-form-group label-cols-sm="3" label="By">
                  <b-input-group>
                    {{row.item.admit_checkup_by.suffix + ' ' + row.item.admit_checkup_by.first_name + ' ' + row.item.admit_checkup_by.last_name}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="3" label="Date">
                  <b-input-group>
                    {{row.item.addmitted_and_check_up_date}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="3" label="Time">
                  <b-input-group>
                    {{row.item.addmitted_and_check_up_time}}
                  </b-input-group>
                </b-form-group>
                <div v-if="row.item.record_type.id == 2">
                  <legend>Discharged</legend>
                  <b-form-group label-cols-sm="3" label="By">
                    <b-input-group>
                      {{row.item.admit_checkup_by.suffix + ' ' + row.item.admit_checkup_by.first_name + ' ' + row.item.admit_checkup_by.last_name}}
                    </b-input-group>
                  </b-form-group>
                  <b-form-group label-cols-sm="3" label="Date">
                    <b-input-group>
                      {{row.item.addmitted_and_check_up_time}}
                    </b-input-group>
                  </b-form-group>
                  <b-form-group label-cols-sm="3" label="Time">
                    <b-input-group>
                      {{row.item.addmitted_and_check_up_time}}
                    </b-input-group>
                  </b-form-group>
                </div>
            </b-col>
          </b-row>
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
      id="modalMedication" 
      @hide="resetModal" 
      :title="modalInfo.title" 
      size="lg" 
      ok-only
    >
        <b-tabs content-class="mt-3">
              <b-tab title="Diagnoses" active>
                    <diagnoses-table-component :patient_record_id="selected_id" />
              </b-tab>
              <b-tab title="Laboratory">
                    <laboratory-table-component :patient_record_id="selected_id" />
              </b-tab>
              <b-tab title="Vital Sign">
                    <vital-sign-table-component :patient_record_id="selected_id" />
              </b-tab>
              <b-tab title="Doctor's Order">
                    <doctors-order-table-component :patient_record_id="selected_id" />
              </b-tab>
              <b-tab title="Nurse Note">
                    <nurses-note-table-component :patient_record_id="selected_id" />
              </b-tab>
              <b-tab title="Intravenous Fuid">
                    <intravenous-fluid-table-component :patient_record_id="selected_id" />
              </b-tab>
              <b-tab title="Medication & Treatment">
                    <medication-and-treatment-table-component :patient_record_id="selected_id" />
              </b-tab>
        </b-tabs>
    </b-modal>
    <b-modal 
        id="modalForm" 
        @hide="resetModal" 
        :title="modalInfo.title" 
        @ok="onSubmit(action)"
        size="lg"
    >
      <form @submit.stop.prevent="onSubmit">
        <b-form-group label-cols-sm="2" label="Date">
            <b-input-group>
                <b-form-input type="date" placeholder="Enter Date" v-model="record.date" />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="Time">
            <b-input-group>
                <b-form-input type="time" placeholder="Enter Time" v-model="record.time" />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="Progress Note">
            <b-input-group>
                <b-form-textarea
                  id="textarea1"
                  v-model="record.progress_note"
                  placeholder="Enter Progress Note"
                  rows="3"
                  max-rows="6"
                />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="Doctor's Orders">
            <b-input-group>
                <b-form-textarea
                  id="textarea1"
                  v-model="record.doctors_orders"
                  placeholder="Enter Progress Note"
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
    import Swal from 'sweetalert2';

  export default {
    components : {
        vSelect
    },

    props: ['user_id'],

    data() {
      return {
        record: {},
        records: [],
        selected_id: null,
        action: 'store' | 'update',
        fields: [
          { key: 'patient', label: 'Patient', sortable: true, sortDirection: 'desc' },
          { key: 'patient-type', label: 'Type Of Patient', sortable: true, sortDirection: 'desc', class: 'text-center' },
          { key: 'addmitted_and_check_up_date', label: 'Date', sortable: true, sortDirection: 'desc', class: 'text-center' },
          { key: 'addmitted_and_check_up_time', label: 'Time', sortable: true, sortDirection: 'desc', class: 'text-center' },
          { key: 'room', label: 'Room', sortable: true, sortDirection: 'desc', class: 'text-center' },
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
        patientOptions: [
            { text: 'All', value: 0 },
            { text: 'Out Patient', value: 1 },
            { text: 'In Patient', value: 2 },
        ],
        patientType: 0,
      }
    },
    mounted() {
        this.getRecords();
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
        getRecords() {
            axios.get(this.getUrl())
            .then(response => {
                this.records = response.data;
                this.totalRows = this.records.length;
                console.log(this.records, this.totalRows);
            });
        },
        getSelectedPatientType(event) {
            this.patientType = event;
            this.getRecords();
        },
        showModalDelete(item, index, button) {
            this.modalInfo.title = 'Record';
            this.modalInfo.content = 'Are you sure you want to delete?';
            this.$root.$emit('bv::show::modal', 'modalDelete', button);
            this.selected_id = item.id;
        },
        onDelete() {
            axios.delete('/api/records/' + this.selected_id)
            .then(response => {
                if(response.data == 'success') {
                    this.getRecords();
                    Swal.fire(
                      'Message',
                      'Succesfully Deleted.',
                      'success'
                    );
                }  
            })
            .catch (response => {
                console.log(response);
            });
        },
        showModalForm() {
            this.action = 'store';
            this.record = {};
            this.modalInfo.title = "Record";
            this.$root.$emit('bv::show::modal', 'modalForm');
        },
        onSubmit(action) {
            console.log('submit',this.record);
            if(action === 'store') {
                axios.post('/api/records', {
                  // code here
                })
                .then(response => {
                    console.log(response.data);
                    if(response.data == 'success') {
                        this.getRecords();
                        Swal.fire(
                          'Message',
                          'Succesfully Saved.',
                          'success'
                        );
                    }  
                })
                .catch (response => {
                    console.log(response);
                });
            } else {
                axios.put('/api/records/' + this.selected_id, {
                    // code here
                })
                .then(response => {
                    console.log(response.data);
                    if(response.data == 'success') {
                        this.getRecords();
                        Swal.fire(
                          'Message',
                          'Succesfully Updated.',
                          'success'
                        );
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
            axios.get('/api/records/'+this.selected_id+'/edit')
            .then(response => {
                this.record = response.data;
            });
            this.modalInfo.title = "Record";
            this.$root.$emit('bv::show::modal', 'modalForm');
        },
        getUrl() {

            if(this.patientType == 0) {
                return '/api/records';
            } else {
                return '/api/records/' + this.patientType;
            }
        },
        showMedication(item) {
            this.selected_id = item.id;
            this.modalInfo.title = "Medication";
            this.$root.$emit('bv::show::modal', 'modalMedication');
        }
    }
  }
</script>