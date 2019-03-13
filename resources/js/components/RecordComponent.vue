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
        id="modalRecordForm" 
        @hide="resetModal" 
        :title="modalInfo.title" 
        @ok="onSubmit(action)"
        size="lg"
    >
      <form @submit.stop.prevent="onSubmit">
        <b-row>
          <b-col md="6">
            <b-form-group label-cols-sm="3" label="Patient">
              <b-input-group>
                <v-select :options="patients" v-model="record.patient"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Status">
              <b-input-group>
                <v-select :options="typeOfRecords" v-model="record.typeOfRecord"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group 
              label-cols-sm="3" 
              label="Floor" 
              v-if="record.typeOfRecord && record.typeOfRecord.value == 2"
            >
              <b-input-group>
                <v-select :options="floors" v-model="record.floor"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group 
              label-cols-sm="3" 
              label="Room" 
              v-if="record.floor && record.typeOfRecord && record.typeOfRecord.value == 2"
            >
              <b-input-group>
                <v-select :options="rooms" v-model="record.room"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group 
              label-cols-sm="3" 
              label="Bed"
              v-if="record.typeOfRecord && record.typeOfRecord.value == 2"
            >
              <b-input-group>
                  <b-form-input type="text" placeholder="Enter Bed" v-model="record.bed" />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Weight">
              <b-input-group>
                  <b-form-input type="text" placeholder="Enter Weight" v-model="record.weight" />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Height">
              <b-input-group>
                  <b-form-input type="text" placeholder="Enter Height" v-model="record.height" />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Temperature">
              <b-input-group>
                  <b-form-input type="text" placeholder="Enter Temperature" v-model="record.temperature" />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Blood Pressure">
              <b-input-group>
                  <b-form-input type="text" placeholder="Enter Blood Pressure" v-model="record.blood_pressure" />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Pulse Rate">
              <b-input-group>
                  <b-form-input type="text" placeholder="Enter Pulse Rate" v-model="record.pulse_rate" />
              </b-input-group>
            </b-form-group>
            <legend>Additional Information</legend>
            <b-form-group label-cols-sm="3" label="Philhealth Membership">
              <b-input-group>
                  <v-select :options="philhealthMemberShips" v-model="record.philhealthMemberShip"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Sponsor" v-if="record.philhealthMemberShip && record.philhealthMemberShip.value === 5">
              <b-input-group>
                  <b-form-input type="text" placeholder="Enter Sponsor" v-model="record.sponsor" />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Disposition">
              <b-input-group>
                  <v-select :options="dispositions" v-model="record.disposition"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Result">
              <b-input-group>
                  <v-select :options="results" v-model="record.result"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Attending Physician">
              <b-input-group>
                  <v-select :options="doctors" v-model="record.attending_physician"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Chart Completed By">
              <b-input-group>
                  <v-select :options="doctors" v-model="record.completed_by"></v-select>
              </b-input-group>
            </b-form-group>
          </b-col>
          <b-col md="6">
            <div v-if="record.typeOfRecord && record.typeOfRecord.value == 2">
              <b-form-group label-cols-sm="3" label="Chief Complaints">
                <b-input-group>
                  <b-form-textarea
                    id="textarea1"
                    v-model="record.chief_complaints"
                    placeholder="Enter Chief Complaints"
                    rows="3"
                    max-rows="6"
                  />
                </b-input-group>
              </b-form-group>
              <b-form-group label-cols-sm="3" label="Brief History">
                <b-input-group>
                  <b-form-textarea
                    id="textarea1"
                    v-model="record.brief_history"
                    placeholder="Enter Brief History"
                    rows="3"
                    max-rows="6"
                  />
                </b-input-group>
              </b-form-group>
            </div>
            <legend>{{record.typeOfRecord && record.typeOfRecord.value == 2 ? "Admission" : "Checkup"}}</legend>
            <b-form-group label-cols-sm="3" label="Doctor">
              <b-input-group>
                  <v-select :options="doctors" v-model="record.addmission_doctor"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Date">
              <b-input-group>
                  <b-form-input type="date" placeholder="Enter Date" v-model="record.addmission_date" />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Time">
              <b-input-group>
                  <b-form-input type="time" placeholder="Enter Time" v-model="record.addmission_time" />
              </b-input-group>
            </b-form-group>
            <div v-if="record.typeOfRecord && record.typeOfRecord.value == 2">
              <legend>Discharged</legend>
              <b-form-group label-cols-sm="3" label="Doctor">
                <b-input-group>
                    <v-select :options="doctors" v-model="record.discharged_doctor"></v-select>
                </b-input-group>
              </b-form-group>
              <b-form-group label-cols-sm="3" label="Date">
                <b-input-group>
                    <b-form-input type="date" placeholder="Enter Date" v-model="record.discharged_date" />
                </b-input-group>
              </b-form-group>
              <b-form-group label-cols-sm="3" label="Time">
                <b-input-group>
                    <b-form-input type="time" placeholder="Enter Time" v-model="record.discharged_time" />
                </b-input-group>
              </b-form-group>
            </div>
            <legend>Initial Diagnoses</legend>
            <b-form-group label-cols-sm="3" label="Diagnoses Code">
              <b-input-group>
                  <v-select :options="diagnoses" v-model="record.diagnose"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Diagnoses">
              <b-input-group>
                <b-form-textarea
                  id="textarea1"
                  v-model="diagnose_name"
                  placeholder="Enter Diagnoses"
                  rows="3"
                  max-rows="6"
                />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Remarks">
              <b-input-group>
                <b-form-textarea
                  id="textarea1"
                  v-model="record.remarks"
                  placeholder="Enter Remarks"
                  rows="3"
                  max-rows="6"
                />
              </b-input-group>
            </b-form-group>
          </b-col>
        </b-row>
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
        patients: [],
        floors: [],
        rooms: [],
        philhealthMemberShips: [],
        dispositions: [],
        results: [],
        doctors: [],
        diagnoses: [],
        typeOfRecords: [],
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
        this.getPatients();
        this.getFloors();
        this.getRooms();
        this.getPhilhealthMemberShip();
        this.getResults();
        this.getDispositions();
        this.getDoctors();
        this.getDiagnoses();
        this.getTypeOfRecords();
    },
    computed: {
      sortOptions() {
        // Create an options list from our fields
        return this.fields
          .filter(f => f.sortable)
          .map(f => {
            return { text: f.label, value: f.key }
          })
      },
      diagnose_name: function() {
          return (this.record.diagnose ? this.record.diagnose.data.description : null);
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
            this.$root.$emit('bv::show::modal', 'modalRecordForm');
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
            this.$root.$emit('bv::show::modal', 'modalRecordForm');
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
        },

        // modal entry
        getPatients() {
          axios.get('/api/patients')
          .then(response => {
              this.patients = response.data.map((patient) => ({ 
                  value: patient.id, 
                  label: patient.first_name + ' ' + patient.middle_name + ' ' + patient.last_name,
              }));
          });
        },
        getFloors() {
          axios.get('/api/floors')
          .then(response => {
              this.floors = response.data.map((floor) => ({ 
                  value: floor.id, 
                  label: floor.code
              }));
          });
        },
        getRooms() {
          axios.get('/api/rooms')
          .then(response => {
              this.rooms = response.data.map((room) => ({ 
                  value: room.id, 
                  label: room.code
              }));
          });
        },
        getPhilhealthMemberShip() {
          axios.get('/api/philhealthMemberShip')
          .then(response => {
              this.philhealthMemberShips = response.data.map((philhealthMemberShip) => ({ 
                  value: philhealthMemberShip.id, 
                  label: philhealthMemberShip.code
              }));
          });
        },
        getDispositions() {
          axios.get('/api/dispositions')
          .then(response => {
              this.dispositions = response.data.map((disposition) => ({ 
                  value: disposition.id, 
                  label: disposition.code
              }));
          });
        },
        getResults() {
          axios.get('/api/results')
          .then(response => {
              this.results = response.data.map((result) => ({ 
                  value: result.id, 
                  label: result.code
              }));
          });
        },
        getDoctors() {
          axios.get('/api/users')
          .then(response => {
              console.log('user',response.data);
              this.doctors = response.data.map((user) => ({ 
                  value: user.id, 
                  label: user.first_name + ' ' + user.middle_name + ' ' + user.last_name,
              }));
          });
        },
        getDiagnoses() {
          axios.get('/api/diagnoses')
          .then(response => {
              this.diagnoses = response.data.map((diagnose) => ({ 
                  value: diagnose.id, 
                  label: diagnose.code,
                  data: diagnose
              }));
          });
        },
        getTypeOfRecords() {
          axios.get('/api/typeOfRecords')
          .then(response => {
              this.typeOfRecords = response.data.map((type) => ({ 
                  value: type.id, 
                  label: type.code,
              }));
          });
        },
    }
  }
</script>