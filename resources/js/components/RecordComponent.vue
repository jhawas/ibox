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
          {{ row.item.record_type.id == 2 ? row.item.room ? row.item.room.code : null : null}}
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
                <b-form-group label-cols-sm="4" label="Patient">
                  <b-input-group>
                    {{row.item.patient.first_name + ' ' + row.item.patient.middle_name + ' ' + row.item.patient.last_name}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="4" label="Type Of Patient">
                  <b-input-group>
                    {{row.item.record_type.code}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="4" label="Attending Physician">
                  <b-input-group>
                    {{row.item.physician ? row.item.physician.first_name + ' ' + row.item.physician.last_name : null}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="4" label="Height (cm)">
                  <b-input-group>
                    {{row.item.height}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="4" label="Weight (kg)">
                  <b-input-group>
                    {{row.item.weight}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="4" label="Blood Pressure (mm/hg)">
                  <b-input-group>
                    {{row.item.blood_pressure}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="4" label="Pulse Rate (Bit/Minute)">
                  <b-input-group>
                    {{row.item.pulse_rate}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="4" label="Temperature (°C)">
                  <b-input-group>
                    {{row.item.temperature}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="4" label="Brief History">
                  <b-input-group>
                    {{row.item.brief_history}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="4" label="Chief Complaints">
                  <b-input-group>
                    {{row.item.chief_complaints}}
                  </b-input-group>
                </b-form-group>
              </b-col>
              <b-col md="6">
                <legend>{{row.item.record_type.id == 1 ? 'Checkup' : 'Admitted'}}</legend>
                <b-form-group label-cols-sm="4" label="By">
                  <b-input-group>
                    {{row.item.admit_checkup_by ? row.item.admit_checkup_by.first_name + ' ' + row.item.admit_checkup_by.last_name : null}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="4" label="Date">
                  <b-input-group>
                    {{row.item.addmitted_and_check_up_date}}
                  </b-input-group>
                </b-form-group>
                <b-form-group label-cols-sm="4" label="Time">
                  <b-input-group>
                    {{row.item.addmitted_and_check_up_time}}
                  </b-input-group>
                </b-form-group>
                <div v-if="row.item.record_type.id == 2 && row.item.discharged_by">
                  <legend>Discharged</legend>
                  <b-form-group label-cols-sm="4" label="By">
                    <b-input-group>
                      {{row.item.discharged_by ? row.item.discharged_by.first_name + ' ' + row.item.discharged_by.last_name : null}}
                    </b-input-group>
                  </b-form-group>
                  <b-form-group label-cols-sm="4" label="Date">
                    <b-input-group>
                      {{row.item.discharge_date}}
                    </b-input-group>
                  </b-form-group>
                  <b-form-group label-cols-sm="4" label="Time">
                    <b-input-group>
                      {{row.item.discharge_time}}
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
        size="lg"
    >
      <form @submit.stop.prevent="onSubmit">
        <b-row>
          <b-col :md="user_role == 1 || user_role == 2 || user_role == 3 ? 6 : 12">
            <b-form-group label-cols-sm="3" label="Patient">
              <b-input-group>
                <v-select :options="patients" v-model="record.patient"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Status">
              <b-input-group>
                <v-select :options="typeOfRecords" v-model="record.typeOfRecord" :onChange="getTypeOfRecordBy"></v-select>
              </b-input-group>
            </b-form-group>
            <!-- <b-form-group 
              label-cols-sm="3" 
              label="Floor" 
              v-if="type_of_record && type_of_record == 2"
            >
              <b-input-group>
                <v-select :options="floors" v-model="record.floor"></v-select>
              </b-input-group>
            </b-form-group> -->
            <b-form-group 
              label-cols-sm="3" 
              label="Room" 
              v-if="type_of_record && type_of_record == 2"
            >
              <b-input-group>
                <v-select :options="rooms" v-model="record.room"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group 
              label-cols-sm="3" 
              label="Bed"
              v-if="type_of_record && type_of_record == 2"
            >
              <b-input-group>
                  <b-form-input type="text" placeholder="Enter Bed" v-model="record.bed" />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Weight (kg)">
              <b-input-group>
                  <b-form-input type="text" placeholder="Enter Weight" v-model="record.weight" />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Height (cm)">
              <b-input-group>
                  <b-form-input type="text" placeholder="Enter Height" v-model="record.height" />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Temperature (°C)">
              <b-input-group>
                  <b-form-input type="text" placeholder="Enter Temperature" v-model="record.temperature" />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Blood Pressure (mm/hg)">
              <b-input-group>
                  <b-form-input type="text" placeholder="Enter Blood Pressure" v-model="record.blood_pressure" />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Pulse Rate (Bit/Minute)">
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
            <b-form-group label-cols-sm="3" label="Disposition" v-if="action == 'edit'">
              <b-input-group>
                  <v-select :options="dispositions" v-model="record.disposition"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Result" v-if="action == 'edit'">
              <b-input-group>
                  <v-select :options="results" v-model="record.result"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Attending Physician" v-if="action == 'edit'">
              <b-input-group>
                  <v-select :options="doctors" v-model="record.attending_physician"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Chart Completed By" v-if="action == 'edit'">
              <b-input-group>
                  <v-select :options="doctors" v-model="record.completed_by"></v-select>
              </b-input-group>
            </b-form-group>
          </b-col>
          <b-col md="6" v-if="user_role == 1 || user_role == 2 || user_role == 3">
            <div>
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
            <legend>{{type_of_record && type_of_record == 2 ? "Admission" : "Checkup"}}</legend>
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
            <div v-if="action == 'edit' && type_of_record && type_of_record == 2">
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
            <b-form-group label-cols-sm="3" label="Diagnoses">
              <b-input-group>
                  <v-select :options="diagnoses" v-model="record.diagnose"></v-select>
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="3" label="Code">
                <b-input-group>
                    <b-form-input disabled type="text" placeholder="Enter Diagnoses" v-model="diagnose_name" />
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
            <legend>Patient Status</legend>
            <div>
                <b-form-checkbox
                  id="checkbox1"
                  name="checkbox1"
                  v-model="record.discharged"
                  :value="1"
                  :unchecked-value="0"
                >
                  Discharged
                </b-form-checkbox>
            </div>
          </b-col>
        </b-row>
      </form>
      <div slot="modal-footer">
        <b-button @click="hideModal">Cancel</b-button>
        <b-button variant="primary" @click="onSubmit(action)" :disabled="!(record && record.patient && record.typeOfRecord)">Save</b-button>
      </div>
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

    props: ['user_id', 'record_type', 'user_role', 'doctor'],

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
        type_of_record: null,
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
        patientType: this.record_type,
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
        console.log(this.doctor);
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
          var code = this.record.diagnose ? this.record.diagnose.data.code : null;
          this.record.diagnoses_description = this.record.diagnose ? this.record.diagnose.data.description : null;
          return code;
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
            this.getPatients();
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
            this.getPatients();
            this.action = 'store';
            this.record = {
              addmission_doctor: {
                label: this.doctor,
                value: this.user_id
              }
            };
            this.modalInfo.title = "Record";
            this.$root.$emit('bv::show::modal', 'modalRecordForm');
        },
        onSubmit(action) {
            console.log('submit',this.record);
            if(action === 'store') {
                axios.post('/api/records', {
                    addmission_date: this.record.addmission_date,
                    addmission_doctor: this.record.addmission_doctor ? this.record.addmission_doctor.value : null,
                    addmission_time: this.record.addmission_time,
                    attending_physician: this.record.attending_physician ? this.record.attending_physician.value : null,
                    bed: this.record.bed,
                    blood_pressure: this.record.blood_pressure,
                    brief_history: this.record.brief_history,
                    chief_complaints: this.record.chief_complaints,
                    completed_by: this.record.completed_by ? this.record.completed_by.value : null,
                    diagnose: this.record.diagnose ? this.record.diagnose.value : null,
                    diagnoses_description: this.record.diagnoses_description,
                    discharged_date: this.record.discharged_date,
                    discharged_doctor: this.record.discharged_doctor ? this.record.discharged_doctor.value : null,
                    discharged_time: this.record.discharged_time,
                    disposition: this.record.disposition ? this.record.disposition.value : null,
                    floor: this.record.floor ? this.record.floor.value : null,
                    height: this.record.height,
                    patient: this.record.patient.value,
                    philhealthMemberShip: this.record.philhealthMemberShip ? this.record.philhealthMemberShip.value : null,
                    pulse_rate: this.record.pulse_rate,
                    remarks: this.record.remarks,
                    result: this.record.result ? this.record.result.value : null,
                    room: this.record.room ? this.record.room.value : null,
                    sponsor: this.record.sponsor,
                    temperature: this.record.temperature,
                    typeOfRecord: this.record.typeOfRecord ? this.record.typeOfRecord.value : null,
                    weight: this.record.weight,
                    discharged: this.record.discharged,
                })
                .then(response => {
                    console.log('return', response.data);
                    if(response.data == 'success') {
                        this.getRecords();
                        Swal.fire(
                          'Message',
                          'Succesfully Saved.',
                          'success'
                        );
                        this.$root.$emit('bv::hide::modal', 'modalRecordForm');
                    }  
                })
                .catch (response => {
                    console.log(response);
                });
            } else {
                axios.put('/api/records/' + this.selected_id, {
                    addmission_date: this.record.addmission_date,
                    addmission_doctor: this.record.addmission_doctor ? this.record.addmission_doctor.value : null,
                    addmission_time: this.record.addmission_time,
                    attending_physician: this.record.attending_physician ? this.record.attending_physician.value : null,
                    bed: this.record.bed,
                    blood_pressure: this.record.blood_pressure,
                    brief_history: this.record.brief_history,
                    chief_complaints: this.record.chief_complaints,
                    completed_by: this.record.completed_by ? this.record.completed_by.value : null,
                    diagnose: this.record.diagnose ? this.record.diagnose.value : null,
                    diagnoses_description: this.record.diagnoses_description,
                    discharged_date: this.record.discharged_date,
                    discharged_doctor: this.record.discharged_doctor ? this.record.discharged_doctor.value : null,
                    discharged_time: this.record.discharged_time,
                    disposition: this.record.disposition ? this.record.disposition.value : null,
                    floor: this.record.floor ? this.record.floor.value : null,
                    height: this.record.height,
                    patient: this.record.patient.value,
                    philhealthMemberShip: this.record.philhealthMemberShip ? this.record.philhealthMemberShip.value : null,
                    pulse_rate: this.record.pulse_rate,
                    remarks: this.record.remarks,
                    result: this.record.result ? this.record.result.value : null,
                    room: this.record.room ? this.record.room.value : null,
                    sponsor: this.record.sponsor,
                    temperature: this.record.temperature,
                    typeOfRecord: this.record.typeOfRecord ? this.record.typeOfRecord.value : null,
                    weight: this.record.weight,
                    discharged: this.record.discharged,
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
                        this.$root.$emit('bv::hide::modal', 'modalRecordForm');
                    }  
                })
                .catch (response => {
                    console.log(response);
                });
                this.getPatients();
            }
        },
        hideModal() {
          this.$root.$emit('bv::hide::modal', 'modalRecordForm');
        },
        showModalEdit(item) {
            this.getPatients();
            this.action = 'edit';
            this.selected_id = item.id;
            axios.get('/api/records/'+this.selected_id+'/edit')
            .then(response => {
                console.log('edit', response.data);
                this.record = response.data;
                this.record.addmission_date = response.data.addmitted_and_check_up_date;
                this.record.addmission_time = response.data.addmitted_and_check_up_time;
                this.record.discharged_date = response.data.discharge_date;
                this.record.discharged_time = response.data.discharge_time;
                this.record.discharged = response.data.discharged;
                if(response.data.record_type) {
                  this.record.typeOfRecord = {
                    label: response.data.record_type.code,
                    value: response.data.record_type.id,
                  };
                }
                if(response.data.patient) {
                  this.record.patient = {
                    label: response.data.patient.first_name + ' ' + response.data.patient.middle_name + ' ' + response.data.patient.last_name,
                    value: response.data.patient.id,
                  };
                }
                if(response.data.floor) {
                  this.record.floor = {
                    label: response.data.floor.code,
                    value: response.data.floor.id,
                  }
                }
                if(response.data.room) {
                  this.record.room = {
                    label: response.data.room.code,
                    value: response.data.room.id,
                  }
                }
                if(response.data.philhealth_membership) {
                  this.record.philhealthMemberShip = {
                    label: response.data.philhealth_membership.code,
                    value: response.data.philhealth_membership.id,
                  }
                }
                if(response.data.disposition) {
                  this.record.disposition = {
                    label: response.data.disposition.code,
                    value: response.data.disposition.id,
                  }
                }
                if(response.data.result) {
                  this.record.result = {
                    label: response.data.result.code,
                    value: response.data.result.id,
                  }
                }
                if(response.data.physician) {
                  this.record.attending_physician = {
                    label: response.data.physician.first_name + ' ' + response.data.physician.middle_name + ' ' + response.data.physician.last_name,
                    value: response.data.physician.id,
                  }
                }
                if(response.data.chart_completed_by) {
                  this.record.completed_by = {
                    label: response.data.chart_completed_by.first_name + ' ' + response.data.chart_completed_by.middle_name + ' ' + response.data.chart_completed_by.last_name,
                    value: response.data.chart_completed_by.id,
                  }
                }
                if(response.data.admit_checkup_by) {
                  this.record.addmission_doctor = {
                    label: response.data.admit_checkup_by.first_name + ' ' + response.data.admit_checkup_by.middle_name + ' ' + response.data.admit_checkup_by.last_name,
                    value: response.data.admit_checkup_by.id,
                  }
                }
                if(response.data.discharged_by) {
                  this.record.discharged_doctor = {
                    label: response.data.discharged_by.first_name + ' ' + response.data.discharged_by.middle_name + ' ' + response.data.discharged_by.last_name,
                    value: response.data.discharged_by.id,
                  }
                } else {
                    this.record.discharged_doctor = {
                    label: this.doctor,
                    value: this.user_id,
                  }
                }
                if(response.data.initial_diagnoses) {
                  this.record.remarks = response.data.initial_diagnoses.remarks;
                  this.record.diagnose = {
                    label: response.data.initial_diagnoses.diagnose.description,
                    value: response.data.initial_diagnoses.diagnose_id,
                    data: response.data.initial_diagnoses.diagnose,
                  }
                }
                this.modalInfo.title = "Record";
                this.$root.$emit('bv::show::modal', 'modalRecordForm');
            });
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
              console.log('patients', response.data);
              this.patients = response.data.map((patient) => { 
                  if(!patient.records.length) {
                      return ({
                        value: patient.id, 
                        label: patient.first_name + ' ' + patient.middle_name + ' ' + patient.last_name,
                      });
                  } else {
                      return;
                  }
              });
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
                  label: diagnose.description,
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
        getTypeOfRecordBy(event) {
            if(event) {
                this.record.typeOfRecord = event;
                this.type_of_record = event.value;
            }
        }
    }
  }
</script>