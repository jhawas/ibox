<template>
  <b-container fluid>
    <!-- User Interface controls -->
    <b-row>
        <b-col md="6" class="my-1">
            <b-form-group label-cols-sm="3" label="Add" class="mb-0">
                <b-button @click="showModalForm">New</b-button>
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
      :items="patients"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
    >
      <template slot="name" slot-scope="row">
          {{row.item.first_name + ' ' + row.item.last_name}}
      </template>

      <template slot="actions" slot-scope="row">
        <b-button size="sm" @click="row.toggleDetails">
            {{ row.detailsShowing ? 'Hide' : 'Show' }} Details
        </b-button>
        <b-button size="sm" @click="showModalEdit(row.item)">
            Edit
        </b-button>
        <!-- <b-button size="sm" @click="showModalDelete(row.item, row.index, $event.target)">
            Delete
        </b-button> -->
      </template>
      <template slot="row-details" slot-scope="row">
        <b-card>
            <b-tabs content-class="mt-3">
              <b-tab title="Information" active>
                <b-row>
                  <b-col md="6" class="my-1">
                    <b-form-group label-cols-sm="2" label="First Name" class="mb-0">
                      <b-input-group>
                        {{row.item.first_name}}
                      </b-input-group>
                    </b-form-group>
                    <b-form-group label-cols-sm="2" label="Middle Name" class="mb-0">
                      <b-input-group>
                        {{row.item.middle_name}}
                      </b-input-group>
                    </b-form-group>
                    <b-form-group label-cols-sm="2" label="Last Name" class="mb-0">
                      <b-input-group>
                        {{row.item.last_name}}
                      </b-input-group>
                    </b-form-group>
                    <b-form-group label-cols-sm="2" label="Suffix" class="mb-0">
                      <b-input-group>
                        {{row.item.suffix}}
                      </b-input-group>
                    </b-form-group>
                    <b-form-group label-cols-sm="2" label="Birthdate" class="mb-0">
                      <b-input-group>
                        {{row.item.birthdate}}
                      </b-input-group>
                    </b-form-group>
                    <b-form-group label-cols-sm="2" label="Sex" class="mb-0">
                      <b-input-group>
                        {{row.item.sex}}
                      </b-input-group>
                    </b-form-group>
                    <b-form-group label-cols-sm="2" label="Religion" class="mb-0">
                      <b-input-group>
                        {{row.item.religion}}
                      </b-input-group>
                    </b-form-group>
                    <b-form-group label-cols-sm="2" label="Address" class="mb-0">
                      <b-input-group>
                        {{row.item.address}}
                      </b-input-group>
                    </b-form-group>
                    <b-form-group label-cols-sm="2" label="Civil Status" class="mb-0">
                      <b-input-group>
                        {{row.item.civil_status}}
                      </b-input-group>
                    </b-form-group>
                </b-col>
                <b-col md="6" class="my-1">
                    <b-form-group label-cols-sm="2" label="Spouse" class="mb-0">
                      <b-input-group>
                        {{row.item.spouse}}
                      </b-input-group>
                    </b-form-group>
                    <b-form-group label-cols-sm="2" label="Spouse Address" class="mb-0">
                      <b-input-group>
                        {{row.item.spouse_address}}
                      </b-input-group>
                    </b-form-group>
                    <b-form-group label-cols-sm="2" label="Mother" class="mb-0">
                      <b-input-group>
                        {{row.item.mother}}
                      </b-input-group>
                    </b-form-group>
                    <b-form-group label-cols-sm="2" label="Father" class="mb-0">
                      <b-input-group>
                        {{row.item.father}}
                      </b-input-group>
                    </b-form-group>
                    <legend>Emergency</legend>
                    <b-form-group label-cols-sm="2" label="Name" class="mb-0">
                      <b-input-group>
                        {{row.item.e_name}}
                      </b-input-group>
                    </b-form-group>
                    <b-form-group label-cols-sm="2" label="Phone" class="mb-0">
                      <b-input-group>
                        {{row.item.e_contact}}
                      </b-input-group>
                    </b-form-group>
                    <b-form-group label-cols-sm="2" label="Address" class="mb-0">
                      <b-input-group>
                        {{row.item.e_address}}
                      </b-input-group>
                    </b-form-group>
                  </b-col>
                </b-row>
              </b-tab>
              <b-tab title="History">
                  <b-table 
                    :items="row.item.records" 
                    :fields="recordFields"
                  >
                    <template slot="recordType" slot-scope="row">
                        {{row.item.record_type.code}}
                    </template>
                    <template slot="actions" slot-scope="row">
                      <b-button size="sm" @click="showHistoryModal(row.item)">
                          Details
                      </b-button>
                    </template>
                  </b-table>
              </b-tab>
            </b-tabs>
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
        id="modalHistory" 
        @hide="resetModal" 
        :title="modalInfo.title" 
        size="lg"
        ok-only
    >
        <div>
          <b-tabs content-class="mt-3">
            <b-tab title="Diagnoses" active>
                <b-table 
                  :items="history.diagnoses"
                  :fields="diagnosesFields"
                >
                    <template slot="diagnose" slot-scope="row">
                        {{row.item.diagnose.code}}
                    </template>
                </b-table>
            </b-tab>
            <b-tab title="Laboratory">
                <b-table 
                  :items="history.laboratory"
                  :fields="laboratoryFields"
                >
                    <template slot="laboratory" slot-scope="row">
                        {{row.item.laboratory.code}}
                    </template>
                    <template slot="image" slot-scope="row">
                        <img :src="replaceUrl(row.item.image)" class="laboratoryImage" />
                    </template>
                </b-table>
            </b-tab>
            <b-tab title="Vital Sign">
                <b-table 
                  :items="history.vital_signs"
                  :fields="vitalSignFields"
                />
            </b-tab>
            <b-tab title="Doctor's Order">
              <b-table 
                :items="history.doctors_orders"
                :fields="doctorsOrderFields"
              >
                <template slot="user" slot-scope="row">
                    {{row.item.user.first_name + ' ' + row.item.user.last_name}}
                </template>
              </b-table>
            </b-tab>
            <b-tab title="Nurse Note">
              <b-table 
                :items="history.nurses_notes"
                :fields="nursesNoteFields"
              >
                <template slot="user" slot-scope="row">
                    {{row.item.user.first_name + ' ' + row.item.user.last_name}}
                </template>
              </b-table>
            </b-tab>
            <b-tab title="Intravenous Fluid">
              <b-table 
                :items="history.intravenous_fluids"
                :fields="intravenousFluidFields"
              >
                <template slot="user" slot-scope="row">
                    {{row.item.user.first_name + ' ' + row.item.user.last_name}}
                </template>
              </b-table>
            </b-tab>
            <b-tab title="Medication & Treatment">
              <b-table 
                :items="history.medication_and_treatments"
                :fields="treatmentFields" 
              />
            </b-tab>
          </b-tabs>
        </div>
    </b-modal>
    <b-modal 
        id="modalForm" 
        @hide="resetModal" 
        :title="modalInfo.title" 
        @ok="onSubmit(action)"
        size="lg"
    >
      <form @submit.stop.prevent="onSubmit">
        <b-row>
          <b-col md="6" class="my-1">
            <b-form-group label-cols-sm="2" label="First Name">
                <b-input-group>
                    <b-form-input type="text" placeholder="Enter First Name" v-model="patient.first_name" />
                </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Middle Name">
                <b-input-group>
                    <b-form-input type="text" placeholder="Enter Middle Name" v-model="patient.middle_name" />
                </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Last Name">
                <b-input-group>
                    <b-form-input type="text" placeholder="Enter Last Name" v-model="patient.last_name" />
                </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Suffix">
                <b-input-group>
                    <b-form-input type="text" placeholder="Enter Suffix" v-model="patient.suffix" />
                </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Birthdate">
                <b-input-group>
                    <b-form-input type="date" placeholder="Enter Birthdate" v-model="patient.birthdate" />
                </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Sex">
                <b-input-group>
                    <b-form-select v-model="patient.sex" class="mb-3">
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </b-form-select>
                </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Religion">
                <b-input-group>
                    <b-form-input type="text" placeholder="Enter Religion" v-model="patient.religion" />
                </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Address">
                <b-input-group>
                    <b-form-input type="text" placeholder="Enter Address" v-model="patient.address" />
                </b-input-group>
            </b-form-group>
            <b-form-group label="Civil Status">
              <b-form-radio value="single" v-model="patient.civil_status" name="civil_status">Single</b-form-radio>
              <b-form-radio value="married" v-model="patient.civil_status" name="civil_status">Married</b-form-radio>
              <b-form-radio value="windowed" v-model="patient.civil_status" name="civil_status">Widowed</b-form-radio>
            </b-form-group>
          </b-col>
          <b-col md="6" class="my-1">
            <b-form-group label-cols-sm="2" label="Spouse">
              <b-input-group>
                  <b-form-input type="text" placeholder="Enter Spouse" v-model="patient.spouse" />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Spouse Address">
              <b-input-group>
                  <b-form-textarea
                    id="textarea1"
                    v-model="patient.spouse_address"
                    placeholder="Enter Address"
                    rows="3"
                    max-rows="6"
                  />
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Mother">
                <b-input-group>
                    <b-form-input type="text" placeholder="Enter Mother" v-model="patient.mother" />
                </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Father">
                <b-input-group>
                    <b-form-input type="text" placeholder="Enter Father" v-model="patient.father" />
                </b-input-group>
            </b-form-group>
            <legend>Emergency Contact</legend>
            <b-form-group label-cols-sm="2" label="Name">
                <b-input-group>
                    <b-form-input type="text" placeholder="Enter Name" v-model="patient.e_name" />
                </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Phone">
                <b-input-group>
                    <b-form-input type="text" placeholder="Enter Phone" v-model="patient.e_contact" />
                </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Address">
              <b-input-group>
                  <b-form-textarea
                    id="textarea1"
                    v-model="patient.e_address"
                    placeholder="Enter Address"
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
    data() {
      return {
        patients: [],
        patient: [],
        history: [],
        selected_id: null,
        action: 'store' | 'update',
        fields: [
          { key: 'name', label: 'Name', sortable: true, sortDirection: 'desc' },
          { key: 'sex', label: 'Sex', sortable: true, sortDirection: 'desc' },
          { key: 'religion', label: 'Religion', sortable: true, sortDirection: 'desc' },
          { key: 'actions', label: 'Actions', class: 'text-right' }
        ],
        recordFields: [
          { key: 'addmitted_and_check_up_date', label: 'Admiteed/Checkup', sortable: true, sortDirection: 'desc' },
          { key: 'recordType', label: 'Status', sortable: true, sortDirection: 'desc' },
          { key: 'actions', label: 'Actions', class: 'text-right' }
        ],
        diagnosesFields: [
          { key: 'diagnose', label: 'Name', sortable: true, sortDirection: 'desc' },
          { key: 'diagnoses', label: 'Details', sortable: true, sortDirection: 'desc' },
          { key: 'remarks', label: 'Remarks', sortable: true, sortDirection: 'desc' },
        ],
        laboratoryFields: [
          { key: 'laboratory', label: 'Laboratory', sortable: true, sortDirection: 'desc' },
          { key: 'description', label: 'Details', sortable: true, sortDirection: 'desc' },
          { key: 'image', label: 'Image', sortable: true, sortDirection: 'desc' },
          { key: 'created_at', label: 'Datetime', sortable: true, sortDirection: 'desc' },
        ],
        vitalSignFields: [
          { key: 'date', label: 'Date', sortable: true, sortDirection: 'desc' },
          { key: 'time', label: 'Time', sortable: true, sortDirection: 'desc' },
          { key: 'bp', label: 'BP', sortable: true, sortDirection: 'desc' },
          { key: 't', label: 'T', sortable: true, sortDirection: 'desc' },
          { key: 'p', label: 'P', sortable: true, sortDirection: 'desc' },
          { key: 'r', label: 'R', sortable: true, sortDirection: 'desc' },
          { key: 'intake_oral', label: 'Intake Oral', sortable: true, sortDirection: 'desc' },
          { key: 'intake_iv', label: 'Intake I.V.', sortable: true, sortDirection: 'desc' },
          { key: 'intake_ng', label: 'Intake NG', sortable: true, sortDirection: 'desc' },
          { key: 'total_intake', label: 'Total Intake', sortable: true, sortDirection: 'desc' },
          { key: 'output_urine', label: 'Output Urine', sortable: true, sortDirection: 'desc' },
          { key: 'output_stool', label: 'Output Stool', sortable: true, sortDirection: 'desc' },
          { key: 'output_emesis', label: 'Output Emesis', sortable: true, sortDirection: 'desc' },
          { key: 'output_ng', label: 'Output NG', sortable: true, sortDirection: 'desc' },
          { key: 'total_output', label: 'Total Output', sortable: true, sortDirection: 'desc' },
        ],
        doctorsOrderFields: [
          { key: 'date', label: 'Date', sortable: true, sortDirection: 'desc' },
          { key: 'time', label: 'Time', sortable: true, sortDirection: 'desc' },
          { key: 'user', label: 'physician', sortable: true, sortDirection: 'desc' },
          { key: 'progress_note', label: 'Progress Note', sortable: true, sortDirection: 'desc' },
          { key: 'doctors_orders', label: "Doctor's Order", sortable: true, sortDirection: 'desc' },
        ],
        nursesNoteFields: [
          { key: 'date', label: 'Date', sortable: true, sortDirection: 'desc' },
          { key: 'time', label: 'Time', sortable: true, sortDirection: 'desc' },
          { key: 'focus', label: 'Focus', sortable: true, sortDirection: 'desc' },
          { key: 'data_action_response', label: "Action Response", sortable: true, sortDirection: 'desc' },
          { key: 'user', label: 'Nurse', sortable: true, sortDirection: 'desc' },
        ],
        intravenousFluidFields: [
          { key: 'date', label: 'Date', sortable: true, sortDirection: 'desc' },
          { key: 'time', label: 'Time', sortable: true, sortDirection: 'desc' },
          { key: 'bot_no', label: 'Bot No.', sortable: true, sortDirection: 'desc' },
          { key: 'kind_of_solution', label: 'Kind Of Solution', sortable: true, sortDirection: 'desc' },
          { key: 'vol', label: 'Vol.', sortable: true, sortDirection: 'desc' },
          { key: 'gtss', label: 'GTSS', sortable: true, sortDirection: 'desc' },
          { key: 'remarks', label: 'Remarks', sortable: true, sortDirection: 'desc' },
          { key: 'user', label: 'Nurse', sortable: true, sortDirection: 'desc' },
        ],
        treatmentFields: [
          { key: 'medicine', label: 'Medicine', sortable: true, sortDirection: 'desc' },
          { key: 'remarks', label: 'Remarks', sortable: true, sortDirection: 'desc' },
          { key: 'date', label: 'Date', sortable: true, sortDirection: 'desc' },
          { key: 'time', label: 'Time', sortable: true, sortDirection: 'desc' },
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
            axios.get('/api/patients')
            .then(response => {
                this.patients = response.data;
                this.totalRows = this.patients.length;
                console.log(this.patients, this.totalRows);
            });
        },
        showModalDelete(item, index, button) {
            this.modalInfo.title = item.first_name + ' ' + item.last_name;
            this.modalInfo.content = 'Are you sure you want to delete?';
            this.$root.$emit('bv::show::modal', 'modalDelete', button);
            this.selected_id = item.id;
        },
        onDelete() {
            axios.delete('/api/patients/' + this.selected_id)
            .then(response => {
                if(response.data == 'success') {
                    this.getPatients();
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
            this.modalInfo.title = "Patient";
            this.patient = [];
            this.$root.$emit('bv::show::modal', 'modalForm');
        },
        onSubmit(action) {
            console.log('submit',this.patient);
            if(action === 'store') {
                axios.post('/api/patients', {
                    first_name: this.patient.first_name,
                    middle_name: this.patient.middle_name,
                    last_name: this.patient.last_name,
                    suffix: this.patient.suffix,
                    birthdate: this.patient.birthdate,
                    sex: this.patient.sex,
                    religion: this.patient.religion,
                    address: this.patient.address,
                    spouse: this.patient.spouse,
                    spouse_address: this.patient.spouse_address,
                    mother: this.patient.mother,
                    father: this.patient.father,
                    e_name: this.patient.e_name,
                    e_contact: this.patient.e_contact,
                    e_address: this.patient.e_address,
                    civil_status: this.patient.civil_status,
                })
                .then(response => {
                    console.log(response.data);
                    if(response.data == 'success') {
                        this.getPatients();
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
                axios.put('/api/patients/' + this.selected_id, {
                    first_name: this.patient.first_name,
                    middle_name: this.patient.middle_name,
                    last_name: this.patient.last_name,
                    suffix: this.patient.suffix,
                    birthdate: this.patient.birthdate,
                    sex: this.patient.sex,
                    religion: this.patient.religion,
                    address: this.patient.address,
                    spouse: this.patient.spouse,
                    spouse_address: this.patient.spouse_address,
                    mother: this.patient.mother,
                    father: this.patient.father,
                    e_name: this.patient.e_name,
                    e_contact: this.patient.e_contact,
                    e_address: this.patient.e_address,
                    civil_status: this.patient.civil_status,
                })
                .then(response => {
                    console.log(response.data);
                    if(response.data == 'success') {
                        this.getPatients();
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
            axios.get('/api/patients/'+this.selected_id+'/edit')
            .then(response => {
                this.patient = response.data;
            });
            this.modalInfo.title = "Patient";
            this.$root.$emit('bv::show::modal', 'modalForm');
        },
        showHistoryModal(item) {
            this.history = item;
            this.modalInfo.title = "Medical History";
            this.$root.$emit('bv::show::modal', 'modalHistory');
        },
        replaceUrl(url) {
            return url.replace("public", "storage");
        },
    }
  }
</script>