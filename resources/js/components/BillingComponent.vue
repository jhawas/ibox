<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Billing</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 control-container">
                            <div class="control">
                                <v-select :options="patientRecord" :onChange="getPatientRecordID"></v-select>
                                <button type="button" class="btn btn-primary" @click="showModal" :disabled="!patient_record_id">Add Bill</button>
                                <button type="button" class="btn btn-primary" @click="printUrl" :disabled="!patient_record_id">Print</button>
                                <button type="button" class="btn btn-primary" @click="showCashierModal" :disabled="!patient_record_id" >Payment</button>
                            </div>
                        </div>
                        <div class="col-md-4 total-bill-container">
                            Total: {{ totalBill }}
                        </div>
                    </div>
                    <b-modal ref="myCashier" hide-footer title="Payment Form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Charges">Total Bill</label>
                                    <input type="text" class="form-control" placeholder="Enter Charges" v-model="totalBill" disabled="">
                                </div>
                                <div class="form-group">
                                    <label for="Amount">Amount</label>
                                    <input type="text" class="form-control" placeholder="Enter Price" v-model="amountEntered" @change="getChanged">
                                </div>
                                <div class="form-group">
                                    <label for="Charges">Change</label>
                                    <input type="text" class="form-control" placeholder="Enter Price" v-model="change">
                                </div>
                                <div class="button-container">
                                    <button type="button" class="btn btn-primary" @click="savePayment">Payment</button>
                                    <button type="button" class="btn btn-primary" @click="closedCashierModal">Close</button>
                                </div>
                            </div>
                        </div>
                    </b-modal>
                    <b-modal ref="warning" hide-footer title="Warning">
                        <div class="row">
                            <div class="col-md-12">
                                Patient already paid.
                            </div>
                        </div>
                    </b-modal>
                    <b-modal ref="myModalRef" hide-footer title="Charges Form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Select Charges</label>
                                    <v-select :options="charges" :onChange="getChargeID"></v-select>
                                </div>
                                <div class="form-group">
                                    <label for="Charges">Charges</label>
                                    <input type="text" class="form-control" placeholder="Enter Charges" v-model="form.charge">
                                </div>
                                <div class="form-group">
                                    <label for="Charges">Price</label>
                                    <input type="text" class="form-control" placeholder="Enter Price" v-model="form.price">
                                </div>
                                <div class="form-group">
                                    <label for="Charges">Quantity</label>
                                    <input type="text" class="form-control" placeholder="Enter Price" v-model="form.quantity">
                                </div>
                                <div class="button-container">
                                    <button type="button" class="btn btn-primary" @click="storeBilling">Add</button>
                                    <button type="button" class="btn btn-primary" @click="closedModal">Close</button>
                                </div>
                            </div>
                        </div>
                    </b-modal>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover table-bordered">
                              <thead>
                                <tr>
                                  <th>Code</th>
                                  <th>Price</th>
                                  <th>Quantity</th>
                                  <th>Total</th>
                                  <th>Delete</th>
                                </tr>
                              </thead>
                              <tbody class="is-paid-container">
                                    <tr v-for="billing in billings">
                                          <td>{{ billing.bill }}</td>
                                          <td>{{ billing.price }}</td>
                                          <td>{{ billing.quantity }}</td>
                                          <td>{{ billing.total }}</td>
                                          <td>
                                            <button class="btn btn-primary" @click="removeBilling(billing.id)">x</button>
                                        </td>
                                    </tr>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                patientRecord: [],
                billings: [],
                patient_record_id: null,
                charges: [],
                price: null,
                totalBill: 0,
                amountEntered: 0,
                change: 0,
                is_paid: 0,
                payment: null,
                form: {
                    price: 0,
                    typeOfCharge: null,
                    charge: null,
                    quantity: 0,
                }
            }
        },

        mounted() {
            this.patientRecords();
            this.getCharges();
        },

        computed: {

        },

        watch: {

        },

        methods: {
            showModal() {
                this.$refs.myModalRef.show();
            },

            closedModal() {
                this.$refs.myModalRef.hide();
            },

            showCashierModal() {
                if(this.payment.length > 0) {
                    this.$refs.warning.show();
                    return;
                }
                this.$refs.myCashier.show();
            },

            closedCashierModal() {
                this.$refs.myCashier.hide();
            },

            patientRecords() {
                axios.get('/api/patientRecords')
                .then(response => {
                    this.patientRecord = response.data.map( (patientRecord) => ({ 
                        value: patientRecord.id, 
                        label: 'Record No.:' + patientRecord.id + ' (' + patientRecord.patient.first_name + ' ' + patientRecord.patient.middle_name + ' ' + patientRecord.patient.last_name + ')',
                        is_paid: patientRecord.is_paid
                    }));
                });
            },

            getPatientRecordID(event) {
                this.patient_record_id = event.value;
                this.billing();
                this.getTotalBill();
                this.getPayment();
                this.is_paid = event.is_paid;
                // this.getPaymentStatus();
            },

            billing() {
                 axios.get('/api/billing/patientRecord/'+ this.patient_record_id)
                .then(response => {
                    this.billings = response.data;
                    this.totalBill = response.data.forEach( (data) => {
                        console.log(data);
                    });
                });
            },

            storeBilling() {
                axios.post('/api/billing', {
                    patient_record_id: this.patient_record_id,
                    type_of_charge_id: this.form.typeOfCharge,
                    price: this.form.price,
                    quantity: this.form.quantity,
                    total: this.form.quantity * this.form.price,
                    charge: this.form.charge,
                    description: 'test'
                })
                .then(response => {
                    if(response.data == 'success') {
                        this.billing();
                        this.getTotalBill();
                        this.$refs.myModalRef.hide();
                        Swal.fire(
                          'Message',
                          'Succesfully Added.',
                          'success'
                        );
                    }  
                })
                .catch (response => {
                    console.log(response);
                });
            },
            getCharges() {
                axios.get('/api/billing/charges')
                .then(response => {
                    this.charges = response.data.map( (charges) => ({ 
                        value: charges.id, 
                        label: charges.code,
                        price: charges.price,
                        typeOfCharge: charges.id,
                        charge: charges.code,
                    }));
                });
            },
            getChargeID(event) {
                this.form = event;
                console.log(this.form);
            },
            removeBilling(id) {
                axios.delete('/api/billing/removed/'+id)
                .then(response => {
                    if(response.data == 'success') {
                        this.billing();
                        Swal.fire(
                          'Message',
                          'Succesfully Removed.',
                          'success'
                        );
                    }  
                })
                .catch (response => {
                    console.log(response);
                });
            },

            getTotalBill() {
                axios.get('/api/billing/total/'+ this.patient_record_id)
                .then(response => {
                    this.totalBill = response.data;
                    console.log(response.data);
                });
            },

            printUrl() {
                window.open('print/'+ this.patient_record_id +'/billing', '_blank');
            },

            savePayment() {
                axios.post('/api/billing/payment', {
                    patient_record_id: this.patient_record_id,
                    totalBill: this.totalBill,
                    enteredAmount: this.enteredAmount,
                    change: this.change
                })
                .then(response => {
                    if(response.data == 'success') {
                        // this.getPaymentStatus();
                        this.closedCashierModal();
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
            },

            getChanged() {
                this.change = this.amountEntered - this.totalBill;
            },

            getPayment() {
                axios.get('/api/payment/'+ this.patient_record_id)
                .then(response => {
                    this.payment = response.data;
                    console.log(this.payment);
                });
            }

            // getPaymentStatus() {
            //     axios.get('/api/billing/status/'+ this.patient_record_id)
            //     .then(response => {
            //         this.is_paid = response.data.is_paid;
            //     });
            // } 
        }

    }
</script>
