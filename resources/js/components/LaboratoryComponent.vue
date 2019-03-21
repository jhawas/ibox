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
      :items="laboratories"
      :fields="fields"
      :current-page="currentPage"
      :per-page="perPage"
      :filter="filter"
      :sort-by.sync="sortBy"
      :sort-desc.sync="sortDesc"
      :sort-direction="sortDirection"
      @filtered="onFiltered"
    >
      <template slot="laboratory" slot-scope="row">
            {{ row.item.laboratory.code }}
      </template>
      <template slot="image" slot-scope="row">
          <b-button size="sm" @click="showImage(row.item)">
            Show Image
          </b-button>
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
            <b-form-group label-cols-sm="4" label="Patient Record" class="mb-0">
              <b-input-group>
                {{row.item.record.patient.first_name + ' ' + row.item.record.patient.first_name}}
              </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="4" label="Results" class="mb-0">
              <b-input-group>
                {{row.item.description}}
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
    <b-modal id="modalImage" @hide="resetModal" :title="modalInfo.title" ok-only>
        <b-img :src="replaceUrl(image)" fluid alt="Responsive image" />
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
      <form @submit.stop.prevent="onSubmit" enctype="multipart/form-data">
        <b-form-group label-cols-sm="2" label="Laboratory">
            <b-input-group>
                <v-select 
                  ref="lab"
                  v-model="laboratory.lab" 
                  :options="lab"
                ></v-select>
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="Results">
            <b-input-group>
                <b-form-textarea
                  id="textarea1"
                  v-model="laboratory.description"
                  placeholder="Enter Results"
                  rows="3"
                  max-rows="6"
                />
            </b-input-group>
        </b-form-group>
        <b-form-group label-cols-sm="2" label="File">
            <b-input-group>
                <b-form-file
                  name="file"
                  v-model="laboratory.file"
                  placeholder="Choose a file..."
                  drop-placeholder="Drop file here..."
                  @change="onFileChange"
                />
            </b-input-group>
        </b-form-group>
      </form>
    </b-modal>
  </b-container>
</template>

<script>
    import vSelect from 'vue-select';
    import Swal from 'sweetalert2'

  export default {
    components : {
        vSelect
    },

    props: ['user_id'],

    data() {
      return {
        patients: [],
        laboratory: {},
        laboratories: [],
        lab: [],
        patient_record_id: null,
        action: 'store' | 'update',
        image: null,
        fields: [
          { key: 'laboratory', label: 'Laboratory', sortable: true, sortDirection: 'desc' },
          { key: 'image', label: 'Image', sortable: true, sortDirection: 'desc' },
          { key: 'description', label: 'Results', sortable: true, sortDirection: 'desc', class: 'text-center' },
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
        this.getLab();
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
            this.getPatientLaboratories();
        },
        getPatientLaboratories() {
            axios.get('/api/patientLaboratories/'+this.patient_record_id)
            .then(response => {
                this.laboratories = response.data;
                this.totalRows = this.laboratories.length;
                console.log(this.laboratories, this.totalRows);
            });
        },
        showModalDelete(item, index, button) {
            this.modalInfo.title = 'Record';
            this.modalInfo.content = 'Are you sure you want to delete?';
            this.$root.$emit('bv::show::modal', 'modalDelete', button);
            this.selected_id = item.id;
        },
        onDelete() {
            axios.delete('/api/patientLaboratories/' + this.selected_id)
            .then(response => {
                if(response.data == 'success') {
                    this.getPatientLaboratories();
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
            this.laboratory = {};
            this.modalInfo.title = "Laboratory";
            this.$root.$emit('bv::show::modal', 'modalForm');
        },
        onSubmit(action) {
            console.log('submit',this.laboratory);
            if(action === 'store') {
                axios.post('/api/patientLaboratories', {
                    patient_record_id: this.patient_record_id,
                    type_of_laboratory_id: this.laboratory.lab ? this.laboratory.lab.value : null,
                    description: this.laboratory.description,
                    file: this.laboratory.file
                })
                .then(response => {
                    console.log(response.data);
                    if(response.data == 'success') {
                        this.getPatientLaboratories();
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
                axios.put('/api/patientLaboratories/' + this.selected_id, {
                    patient_record_id: this.patient_record_id,
                    type_of_laboratory_id: this.laboratory.lab ? this.laboratory.lab.value : null,
                    description: this.laboratory.description,
                    file: this.laboratory.file
                })
                .then(response => {
                    console.log(response.data);
                    if(response.data == 'success') {
                        this.getPatientLaboratories();
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
            axios.get('/api/patientLaboratories/'+this.selected_id+'/edit')
            .then(response => {
                this.laboratory = response.data;
                this.laboratory.diagnose_id = response.data.diagnose_id;
                this.laboratory.lab = {
                    value: response.data.laboratory.id,
                    label: response.data.laboratory.code,
                };
            });
            this.modalInfo.title = "Laboratory";
            this.$root.$emit('bv::show::modal', 'modalForm');
        },
        getLab() {
            axios.get('/api/typeOfLaboratories')
            .then(response => {
                console.log(response.data);
                this.lab = response.data.map( (lab) => ({ 
                    value: lab.id, 
                    label: lab.code,
                }));
            });
        },
        showImage(item) {
            this.image = item.image;
            this.modalInfo.title = "Laboratory Image";
            this.$root.$emit('bv::show::modal', 'modalImage');
        },
        replaceUrl(url) {
            if(url) {
              return '/storage/laboratory/'+url;
            }
        },
        onFileChange(e) {
            console.log('file changed', e);
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = (e) => {
                vm.laboratory.file = e.target.result;
            };
            reader.readAsDataURL(file);
        },

    }
  }
</script>