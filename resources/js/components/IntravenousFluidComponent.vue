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
      :items="intravenousFluids"
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
            <b-row>
              <b-col md="6" class="my-1">
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
                  <b-form-group label-cols-sm="2" label="Bot No." class="mb-0">
                    <b-input-group>
                      {{row.item.bot_no}}
                    </b-input-group>
                  </b-form-group>
                  <b-form-group label-cols-sm="2" label="Kind of Solution" class="mb-0">
                    <b-input-group>
                      {{row.item.kind_of_solution}}
                    </b-input-group>
                  </b-form-group>
              </b-col>
              <b-col md="6" class="my-1">
                  <b-form-group label-cols-sm="2" label="Vol." class="mb-0">
                    <b-input-group>
                      {{row.item.vol}}
                    </b-input-group>
                  </b-form-group>
                  <b-form-group label-cols-sm="2" label="GTSS" class="mb-0">
                    <b-input-group>
                      {{row.item.gtss}}
                    </b-input-group>
                  </b-form-group>
                  <b-form-group label-cols-sm="2" label="Remarks" class="mb-0">
                    <b-input-group>
                      {{row.item.remarks}}
                    </b-input-group>
                  </b-form-group>
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
        id="modalForm" 
        @hide="resetModal" 
        :title="modalInfo.title" 
        @ok="onSubmit(action)"
        size="lg"
    >
      <form @submit.stop.prevent="onSubmit">
        <b-row>
          <b-col md="6" class="my-1">
              <b-form-group label-cols-sm="2" label="Date">
                  <b-input-group>
                      <b-form-input type="date" placeholder="Enter Date" v-model="intravenousFluid.date" />
                  </b-input-group>
              </b-form-group>
              <b-form-group label-cols-sm="2" label="Time">
                  <b-input-group>
                      <b-form-input type="time" placeholder="Enter Time" v-model="intravenousFluid.time" />
                  </b-input-group>
              </b-form-group>
              <b-form-group label-cols-sm="2" label="Bot No.">
                  <b-input-group>
                      <b-form-input type="text" placeholder="Enter Bot No." v-model="intravenousFluid.bot_no" />
                  </b-input-group>
              </b-form-group>
              <b-form-group label-cols-sm="2" label="Kind of Solution">
                  <b-input-group>
                      <b-form-textarea
                        id="textarea1"
                        v-model="intravenousFluid.kind_of_solution"
                        placeholder="Enter Kind of Solution"
                        rows="3"
                        max-rows="6"
                      />
                  </b-input-group>
              </b-form-group>
          </b-col>
          <b-col md="6" class="my-1">
              <b-form-group label-cols-sm="2" label="Vol.">
                  <b-input-group>
                      <b-form-input type="text" placeholder="Enter Vol." v-model="intravenousFluid.vol" />
                  </b-input-group>
              </b-form-group>
              <b-form-group label-cols-sm="2" label="GTSS">
                  <b-input-group>
                      <b-form-input type="text" placeholder="Enter GTSS" v-model="intravenousFluid.gtss" />
                  </b-input-group>
              </b-form-group>
              <b-form-group label-cols-sm="2" label="Remarks">
                  <b-input-group>
                      <b-form-textarea
                        id="textarea1"
                        v-model="intravenousFluid.remarks"
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

  export default {
    components : {
        vSelect
    },
    
    props: ['user_id'],

    data() {
      return {
        patients: [],
        intravenousFluid: [],
        intravenousFluids: [],
        patient_record_id: null,
        selected_id: null,
        action: 'store' | 'update',
        fields: [
          { key: 'date', label: 'Date', sortable: true, sortDirection: 'desc' },
          { key: 'time', label: 'Time', sortable: true, sortDirection: 'desc', class: 'text-center' },
          { key: 'remarks', label: 'Remarks', sortable: true, sortDirection: 'desc', class: 'text-center' },
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
            this.getIntravenousFluids();
        },
        getIntravenousFluids() {
            axios.get('/api/intravenousFluids/'+this.patient_record_id)
            .then(response => {
                this.intravenousFluids = response.data;
                this.totalRows = this.intravenousFluids.length;
                console.log(this.intravenousFluids, this.totalRows);
            });
        },
        showModalDelete(item, index, button) {
            this.modalInfo.title = 'Record';
            this.modalInfo.content = 'Are you sure you want to delete?';
            this.$root.$emit('bv::show::modal', 'modalDelete', button);
            this.selected_id = item.id;
        },
        onDelete() {
            axios.delete('/api/intravenousFluids/' + this.selected_id)
            .then(response => {
                if(response.data == 'success') {
                    this.getIntravenousFluids();
                }  
            })
            .catch (response => {
                console.log(response);
            });
        },
        showModalForm() {
            this.action = 'store';
            this.intravenousFluid = [];
            this.modalInfo.title = "Intravenous Fluid";
            this.$root.$emit('bv::show::modal', 'modalForm');
        },
        onSubmit(action) {
            console.log('submit',this.intravenousFluid);
            if(action === 'store') {
                axios.post('/api/intravenousFluids', {
                    user_id: this.user_id,
                    patient_record_id: this.patient_record_id,
                    date: this.intravenousFluid.date,
                    time: this.intravenousFluid.time,
                    bot_no: this.intravenousFluid.bot_no,
                    kind_of_solution: this.intravenousFluid.kind_of_solution,
                    vol: this.intravenousFluid.vol,
                    gtss: this.intravenousFluid.gtss,
                    remarks: this.intravenousFluid.remarks,
                })
                .then(response => {
                    console.log(response.data);
                    if(response.data == 'success') {
                        this.getIntravenousFluids();
                    }  
                })
                .catch (response => {
                    console.log(response);
                });
            } else {
                axios.put('/api/intravenousFluids/' + this.selected_id, {
                    user_id: this.user_id,
                    patient_record_id: this.patient_record_id,
                    date: this.intravenousFluid.date,
                    time: this.intravenousFluid.time,
                    bot_no: this.intravenousFluid.bot_no,
                    kind_of_solution: this.intravenousFluid.kind_of_solution,
                    vol: this.intravenousFluid.vol,
                    gtss: this.intravenousFluid.gtss,
                    remarks: this.intravenousFluid.remarks,
                })
                .then(response => {
                    console.log(response.data);
                    if(response.data == 'success') {
                        this.getIntravenousFluids();
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
            axios.get('/api/intravenousFluids/'+this.selected_id+'/edit')
            .then(response => {
                this.intravenousFluid = response.data;
            });
            this.modalInfo.title = "Intravenous Fluid";
            this.$root.$emit('bv::show::modal', 'modalForm');
        }
    }
  }
</script>