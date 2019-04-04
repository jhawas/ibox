<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Billing</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9 control-container">
                            <div class="control">
                                <v-select :options="patientRecord" :onChange="getPatientRecordID"></v-select>
                                <b-button 
                                    class="btn btn-primary" 
                                    :disabled="!patient_record_id" 
                                    @click="showModal"
                                >Add Bill</b-button>
                                <b-button 
                                    class="btn btn-primary" 
                                    :disabled="!patient_record_id" 
                                    @click="printUrl"
                                >Print</b-button>
                                <b-button 
                                    class="btn btn-primary" 
                                    :disabled="!patient_record_id" 
                                    @click="showCashierModal"
                                >Payment</b-button>
                            </div>
                        </div>
                        <div class="col-md-3 total-bill-container">
                            <div class="row" style="width: 100%;">
                                <div class="col-md-6">
                                    Total: {{ totalBill ? totalBill.total : 0 }}
                                </div>
                                <div class="col-md-6">
                                    Excess: {{ totalBill ? totalBill.excess : 0 }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <b-modal ref="myCashier" hide-footer title="Payment Form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Charges">Total Bill</label>
                                    <input type="text" class="form-control" placeholder="Enter Charges" v-model="totalBill.excess" disabled="">
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
                    <b-modal ref="myModalRef" hide-footer title="Charges Form" size="lg">
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
                                <legend>Discount(Sr. Citizen)</legend>
                                <div class="form-group">
                                    <label for="Charges">Amount</label>
                                    <input type="text" class="form-control" placeholder="Enter Amount" v-model="form.discount">
                                </div>
                                <legend>Insurance</legend>
                                <div class="form-group">
                                    <label for="Charges">PHIC</label>
                                    <input type="text" class="form-control" placeholder="Enter Amount" v-model="form.phic">
                                </div>
                                <div class="form-group">
                                    <label for="Charges">HMO</label>
                                    <v-select :options="insurances" v-model="form.insurance"></v-select>
                                </div>
                                <div class="form-group">
                                    <label for="Charges">HMO Amount</label>
                                    <input type="text" class="form-control" placeholder="Enter Amount" v-model="form.insuranceAmount">
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
                                  <th>Price/Quantity</th>
                                  <th>Total</th>
                                  <th>Discount</th>
                                  <th>Phic</th>
                                  <th>HMO</th>
                                  <th>Delete</th>
                                </tr>
                              </thead>
                              <tbody class="is-paid-container">
                                    <tr v-for="billing in billings">
                                          <td>{{ billing.bill }}</td>
                                          <td>{{ billing.price + '/' + billing.quantity}}</td>
                                          <td>{{ billing.total }}</td>
                                          <td>{{ billing.discount }}</td>
                                          <td>{{ billing.phic }}</td>
                                          <td>{{ billing.hmo }}</td>
                                          <td>
                                            <button class="btn btn-primary" @click="removeBilling(billing.id)">x</button>
                                        </td>
                                    </tr>
                                    <tr v-show="patient_record_id">
                                        <td>Total</td>
                                        <td></td>
                                        <td>{{ totalBill ? totalBill.total : 0 }}</td>
                                        <td>{{ totalBill ? totalBill.discount : 0 }}</td>
                                        <td>{{ totalBill ? totalBill.phic : 0 }}</td>
                                        <td>{{ totalBill ? totalBill.hmo : 0 }}</td>
                                        <td></td>
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
                insurances: [],
                patientRecord: [],
                billings: [],
                patient_record_id: null,
                charges: [],
                price: null,
                totalBill: {
                    total: 0,
                    phic: 0,
                    discount: 0,
                    hmo: 0,
                },
                amountEntered: 0,
                change: 0,
                is_paid: 0,
                payment: null,
                itemTotal: 0,
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
            this.getInsurances();
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
                if(event) {
                    this.patient_record_id = event.value;
                    this.is_paid = event.is_paid;
                } else {
                    this.patient_record_id = null;
                }
                this.billing();
                this.getTotalBill();
                this.getPayment();
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
                    description: 'test',
                    insurance: this.form.insurance ? this.form.insurance.value : null,
                    phic: this.form.phic,
                    insuranceAmount: this.form.insuranceAmount,
                    discount: this.form.discount,
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
            getInsurances() {
                axios.get('/api/insurances')
                .then(response => {
                    this.insurances = response.data.map( (insurance) => ({ 
                        value: insurance.id, 
                        label: insurance.code,
                    }));
                });
            },
            getChargeID(event) {
                if(event) {
                    this.form = event;
                    this.form.quantity = 1;
                } else {
                    this.form = {};
                }
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
                    console.log('totalbill',response.data);
                });
            },

            printUrl() {
                window.open('print/'+ this.patient_record_id +'/billing', '_blank');
            },

            savePayment() {
                axios.post('/api/billing/payment', {
                    patient_record_id: this.patient_record_id,
                    totalBill: this.totalBill.excess,
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
                this.change = this.amountEntered - this.totalBill.excess;
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
