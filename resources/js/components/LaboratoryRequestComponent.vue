<template>
  <b-container fluid>
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
        <b-form-group label-cols-sm="3" label="Per page" class="mb-0">
          <b-form-select :options="pageOptions" v-model="perPage" />
        </b-form-group>
      </b-col>
    </b-row>

    <!-- Main table element -->
    <b-table
      show-empty
      stacked="md"
      :items="items"
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
        <b-button size="sm" @click="showModalUpload(row.item)">
            Upload
        </b-button>
      </template>

      <template slot="laboratories" slot-scope="row">
          <div v-for="lab in JSON.parse(row.item.laboratories)">
              {{ lab.label }}
          </div>
      </template>

      <template slot="row-details" slot-scope="row">
        <b-card>
            test
        </b-card>
      </template>
      <template slot="user" slot-scope="row">
        {{row.item.user.first_name + ' ' + row.item.user.last_name}}
      </template>
      <template slot="record" slot-scope="row">
        {{row.item.record.patient.first_name + ' ' + row.item.record.patient.last_name}}
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
    
    <b-modal 
        id="modalForm2" 
        @hide="resetModal" 
        :title="modalInfo.title" 
        @ok="onSubmit"
        size="lg"
    >
      <form @submit.stop.prevent="onSubmit" enctype="multipart/form-data">
        <b-form-group label-cols-sm="2" label="Laboratory">
            <b-input-group>
                <v-select 
                  ref="lab"
                  v-model="laboratory.lab" 
                  :options="lab"
                  multiple
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
                  ref="file"
                  id="file"
                  multiple
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
    import _ from 'lodash'; 
    import Swal from 'sweetalert2';

  export default {
    components : {
        vSelect
    },

    props: [],

    data() {
      return {
        files: [],
        patients: [],
        items: null,
        laboratory: {},
        lab: [],
        fields: [
          { key: 'record', label: 'Patient', sortable: true, sortDirection: 'desc' },
          { key: 'laboratories', label: 'Laboratory', sortable: true, sortDirection: 'desc' },
          { key: 'user', label: 'Request By', sortable: true, sortDirection: 'desc' },
          { key: 'actions', label: 'Actions', sortable: true, sortDirection: 'desc' },
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
        this.getData();
        this.getLab();
    },
    created() {

    },
    watch: {

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
            this.totalRows = filteredItems.length;
            this.currentPage = 1;
        },
        getData() {
            axios.get('/api/doctorsOrders')
            .then(response => {
                console.log(JSON.parse(JSON.stringify(response.data)));
                this.items = _.cloneDeep(response.data);
                this.totalRows = this.items.length;
            });
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
        onFileChange(e) {
            console.log('file changed', e);
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.files = files;
        },
        showModalUpload(item) {
            console.log(item);
            this.laboratory.patient_record_id = item.patient_record_id;
            this.laboratory.doctor_order_id = item.id;
            this.laboratory.lab = JSON.parse(item.laboratories);
            this.modalInfo.title = "Laboratory";
            this.$root.$emit('bv::show::modal', 'modalForm2');
        },
        onSubmit() {
          let formData = new FormData();

          for( var i = 0; i < this.files.length; i++ ){
            let file = this.files[i];
            formData.append('files[' + i + ']', file);
          }
          formData.append('patient_record_id', this.laboratory.patient_record_id);
          formData.append('doctor_order_id', this.laboratory.doctor_order_id);
          formData.append('description', this.laboratory.description);
          formData.append('type_of_laboratory_id', this.laboratory.lab ? JSON.stringify(this.laboratory.lab) : null);

          const config = { headers: { 'Content-Type': 'multipart/form-data' } };
          axios.post('/api/patientLaboratories', formData, config)
          .then(response => {
              console.log(response.data);
              if(response.data == 'success') {
                  this.getData();
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
        }
    }
  }
</script>