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
      :items="vitalSigns"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
    >
      <template slot="actions" slot-scope="row">
        <!-- <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
          Info modal
        </b-button> -->
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
            <b-form-group label-cols-sm="2" label="Date" class="mb-0">
              <b-input-group>
                {{row.item.date}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Time" class="mb-0">
              <b-input-group>
                {{row.item.time}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="BP" class="mb-0">
              <b-input-group>
                {{row.item.bp}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="T" class="mb-0">
              <b-input-group>
                {{row.item.t}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="P" class="mb-0">
              <b-input-group>
                {{row.item.p}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="R" class="mb-0">
              <b-input-group>
                {{row.item.r}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Intake Oral" class="mb-0">
              <b-input-group>
                {{row.item.intake_oral}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="intake I.V." class="mb-0">
              <b-input-group>
                {{row.item.intake_iv}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Intake NG" class="mb-0">
              <b-input-group>
                {{row.item.intake_ng}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Total Intake" class="mb-0">
              <b-input-group>
                {{row.item.total_intake}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Output Urine" class="mb-0">
              <b-input-group>
                {{row.item.output_urine}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Output Stool" class="mb-0">
              <b-input-group>
                {{row.item.output_stool}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Output Emesis" class="mb-0">
              <b-input-group>
                {{row.item.output_emesis}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Output NG" class="mb-0">
              <b-input-group>
                {{row.item.output_ng}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Total Output" class="mb-0">
              <b-input-group>
                {{row.item.total_output}}
              </b-input-group>
            </b-form-group>
          <!-- <ul>
            <li v-for="(value, key) in row.item" :key="key">{{ key }}: {{ value }}</li>
          </ul> -->
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
        <b-form-group label-cols-sm="2" label="Date">
            <b-input-group>
                <b-form-input type="date" placeholder="Enter Date" v-model="vitalSign.date" />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="Time">
            <b-input-group>
                <b-form-input type="time" placeholder="Enter Time" v-model="vitalSign.time" />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="BP">
            <b-input-group>
                <b-form-input type="text" placeholder="Enter BP" v-model="vitalSign.bp" />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="T">
            <b-input-group>
                <b-form-input type="text" placeholder="Enter T" v-model="vitalSign.t" />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="P">
            <b-input-group>
                <b-form-input type="text" placeholder="Enter P" v-model="vitalSign.p" />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="R">
            <b-input-group>
                <b-form-input type="text" placeholder="Enter R" v-model="vitalSign.r" />
            </b-input-group>
        </b-form-group>
        <legend>Intake</legend>
        <b-form-group label-cols-sm="2" label="Oral">
            <b-input-group>
                <b-form-input type="text" placeholder="Enter Oral" v-model="vitalSign.intake_oral" />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="I.V.">
            <b-input-group>
                <b-form-input type="text" placeholder="Enter I.V." v-model="vitalSign.intake_iv" />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="NG">
            <b-input-group>
                <b-form-input type="text" placeholder="Enter NG" v-model="vitalSign.intake_ng" />
            </b-input-group>
        </b-form-group>
        <legend>Ouput</legend>
        <b-form-group label-cols-sm="2" label="Urine">
            <b-input-group>
                <b-form-input type="text" placeholder="Enter Urine" v-model="vitalSign.output_urine" />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="Stool">
            <b-input-group>
                <b-form-input type="text" placeholder="Enter Stool" v-model="vitalSign.output_stool" />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="Emesis">
            <b-input-group>
                <b-form-input type="text" placeholder="Enter Emesis" v-model="vitalSign.output_emesis" />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="NG">
            <b-input-group>
                <b-form-input type="text" placeholder="Enter NG" v-model="vitalSign.output_ng" />
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
    data() {
      return {
        patients: [],
        vitalSign: [],
        vitalSigns: [],
        patient_record_id: null,
        selected_id: null,
        action: 'store' | 'update',
        fields: [
          { key: 'date', label: 'Date', sortable: true, sortDirection: 'desc' },
          { key: 'bp', label: 'BP', sortable: true, sortDirection: 'desc', class: 'text-center' },
          { key: 't', label: 'T', sortable: true, sortDirection: 'desc', class: 'text-center' },
          { key: 'p', label: 'P', sortable: true, sortDirection: 'desc', class: 'text-center' },
          { key: 'r', label: 'R', sortable: true, sortDirection: 'desc', class: 'text-center' },
          { key: 'actions', label: 'Actions' }
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
        info(item, index, button) {
            this.modalInfo.title = `Row index: ${index}`
            this.modalInfo.content = JSON.stringify(item, null, 2)
            this.$root.$emit('bv::show::modal', 'modalInfo', button)
        },
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
            this.getVitalSigns();
        },
        getVitalSigns() {
            axios.get('/api/vitalSigns/'+this.patient_record_id)
            .then(response => {
                this.vitalSigns = response.data;
                this.totalRows = this.vitalSigns.length;
                console.log(this.vitalSigns, this.totalRows);
            });
        },
        showModalDelete(item, index, button) {
            this.modalInfo.title = 'Record';
            this.modalInfo.content = 'Are you sure you want to delete?';
            this.$root.$emit('bv::show::modal', 'modalDelete', button);
            this.selected_id = item.id;
        },
        onDelete() {
            axios.delete('/api/vitalSigns/' + this.selected_id)
            .then(response => {
                if(response.data == 'success') {
                    this.getVitalSigns();
                }  
            })
            .catch (response => {
                console.log(response);
            });
        },
        showModalForm() {
            this.action = 'store';
            this.modalInfo.title = 'Vital Signs Form';
            this.$root.$emit('bv::show::modal', 'modalForm');
        },
        onSubmit(action) {
            console.log('submit',this.vitalSign);
            if(action === 'store') {
                axios.post('/api/vitalSigns/' + this.patient_record_id, {
                    patient_record_id: this.patient_record_id,
                    date: this.vitalSign.date,
                    time: this.vitalSign.time,
                    bp: this.vitalSign.bp,
                    t: this.vitalSign.t,
                    p: this.vitalSign.p,
                    r: this.vitalSign.r,
                    intake_oral: this.vitalSign.intake_oral,
                    intake_ng: this.vitalSign.intake_ng,
                    intake_iv: this.vitalSign.intake_iv,
                    output_urine: this.vitalSign.output_urine,
                    output_ng: this.vitalSign.output_ng,
                    output_emesis: this.vitalSign.output_emesis,
                    output_stool: this.vitalSign.output_stool,
                })
                .then(response => {
                    console.log(response.data);
                    if(response.data == 'success') {
                        this.getVitalSigns();
                    }  
                })
                .catch (response => {
                    console.log(response);
                });
            } else {
                axios.put('/api/vitalSigns/' + this.selected_id, {
                    patient_record_id: this.patient_record_id,
                    date: this.vitalSign.date,
                    time: this.vitalSign.time,
                    bp: this.vitalSign.bp,
                    t: this.vitalSign.t,
                    p: this.vitalSign.p,
                    r: this.vitalSign.r,
                    intake_oral: this.vitalSign.intake_oral,
                    intake_ng: this.vitalSign.intake_ng,
                    intake_iv: this.vitalSign.intake_iv,
                    output_urine: this.vitalSign.output_urine,
                    output_ng: this.vitalSign.output_ng,
                    output_emesis: this.vitalSign.output_emesis,
                    output_stool: this.vitalSign.output_stool,
                })
                .then(response => {
                    console.log(response.data);
                    if(response.data == 'success') {
                        this.getVitalSigns();
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
            axios.get('/api/vitalSigns/'+this.selected_id+'/edit')
            .then(response => {
                this.vitalSign = response.data;
            });
            this.modalInfo.title = 'Vital Signs Form';
            this.$root.$emit('bv::show::modal', 'modalForm');
        }
    }
  }
</script>