<template>
  <b-container fluid>
    <b-row>
      <b-col md="12" class="my-1">
          <div>
            <b-card no-body>
              <b-tabs card>
                <b-tab title="Cashier" active>
                  <b-row>
                      <b-col md="12" class="">
                          <b-row>
                              <b-col md="6">
                                  <b-form-group label-cols-sm="3" label="Patient Record">
                                    <b-input-group>
                                      <v-select :options="patients" :onChange="getPatientBy"></v-select>
                                    </b-input-group>
                                  </b-form-group>
                              </b-col>
                          </b-row>
                      </b-col>
                      <b-col md="12">
                          <b-row>
                            <b-col md="6" class="">
                              <b-form-group label-cols-sm="3" label="Charge">
                                <b-input-group>
                                    <b-button @click="showChargeForm">New</b-button>
                                </b-input-group>
                              </b-form-group>
                            </b-col>
                            <b-col md="6" class="">
                              <b-form-group label-cols-sm="3" label="Filter">
                                <b-input-group>
                                  <b-form-input v-model="filter" placeholder="Type to Search" />
                                  <b-input-group-append>
                                    <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                                  </b-input-group-append>
                                </b-input-group>
                              </b-form-group>
                            </b-col>
                          </b-row>
                          <b-row>
                              <b-col md="12">
                                <b-table
                                  how-empty
                                  stacked="md"
                                  :items="patient.purchased"
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
                                      <b-button size="sm">
                                          delete
                                      </b-button>
                                    </template>
                                </b-table>
                              </b-col>
                              <b-col md="12">
                                  <b-pagination
                                    :total-rows="totalRows"
                                    :per-page="perPage"
                                    v-model="currentPage"
                                    class="my-0"
                                  />
                              </b-col>
                          </b-row>
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
    <b-modal 
      id="modalItem" 
      @hide="resetModal" 
      :title="modalInfo.title"
      @ok="onAddItem()"
    >
         <form @submit.stop.prevent="onAddItem">
            <b-form-group label-cols-sm="2" label="Item">
                <b-input-group>
                  <v-select :options="charges" :onChange="getChargeBy"></v-select>
                </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Price">
                <b-input-group>
                    <b-form-input type="text" placeholder="Enter Price" v-model="charge.price"/>
                </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Quantity">
                <b-input-group>
                    <b-form-input type="text" placeholder="Enter Quantity" v-model="charge.quantity"/>
                </b-input-group>
            </b-form-group>
            <b-form-group label-cols-sm="2" label="Total">
                <b-input-group>
                    <b-form-input type="text" placeholder="Enter Total" v-model="total"/>
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
        modalInfo: { title: '', content: '' },
        patients: [],
        patient: {
            id: null,
            receipt: '',
            total_amount: 0,
            amount: 0,
            changed: 0,
            purchased: [],
        },
        charges: [],
        charge: {
            id: null,
            name: '',
            price: 0,
            quantity: 1,
            total: 0,
        },
        selected_id: null,
        action: 'store' | 'update',
        fields: [
          { key: 'item', label: 'Items', sortable: true, sortDirection: 'desc' },
          { key: 'amount', label: 'Amount', sortable: true, sortDirection: 'desc', class: 'text-center' },
          { key: 'quantity', label: 'Quantity', sortable: true, sortDirection: 'desc', class: 'text-center' },
          { key: 'total', label: 'Total', sortable: true, sortDirection: 'desc', class: 'text-center' },
          { key: 'actions', label: 'Actions' }
        ],
        currentPage: 1,
        perPage: 5,
        totalRows: 1,
        sortBy: null,
        sortDesc: false,
        sortDirection: 'asc',
        filter: null,
      }
    },
    mounted() {
        this.getPatients();
        this.getCharges();
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
      total: function() {
          this.charge.total =  this.charge.price * this.charge.quantity;
          return this.charge.total;
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
            this.totalRows = this.patient.purchased.length;
            this.currentPage = 1;
        },
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
        getCharges() {
          axios.get('/api/typeOfChargesDataWithNoParent')
            .then(response => {
              console.log(response);
              this.charges = response.data.map( (charge) => ({ 
                  value: charge.id, 
                  label: charge.code,
                  price: charge.price,
              }));
          });
        },
        getChargeBy(event) {
            if(event) {
              console.log('selected',event.value);
              this.charge.price = event.price;
              this.charge.name = event.label;
            } else {
                this.charge = {
                    id: null,
                    name: '',
                    price: 0,
                    quantity: 1,
                    total: 0,
                };
            }
        },
        showChargeForm() {
            this.modalInfo.title = "Charge";
            this.$root.$emit('bv::show::modal', 'modalItem');
        },
        onAddItem() {
            console.log(this.charge);
            this.patient.purchased.unshift({
                id: this.charge.id,
                item: this.charge.name,
                amount: this.charge.price,
                quantity: this.charge.quantity,
                total: this.charge.total
            });
        }
    }
  }
</script>