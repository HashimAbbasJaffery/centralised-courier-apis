<script setup lang="ts">
import DropdownMenu from '@/components/ui/dropdown-menu/DropdownMenu.vue';
import Input from '@/components/ui/input/Input.vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import { nextTick, onMounted, ref, watch } from 'vue';

import Multiselect from 'vue-multiselect';

const cities = ref([]);
const selectedCity = ref([]);
const shipment_types = {
    EXPRESS: [
        ['OVERNIGHT', 'OVERNIGHT'],
        ['ECONOMY', 'ECONOMY'],
    ],
    LOGISTICS: [['OVERLAND LOGISTICS', 'OVERLAND LOGISTICS']],
};
const materials = ref([]);
const division = ref('');
const selectedMaterial = ref([]);
const is_loading = ref(false);
const vendors = ref([]);
const platforms = ref([]);
const is_fetching = ref(true);
const items = ref([
    {
        id: 1,
        vendor_id: '',
        platform_id: '',
        item_name: '',
        purchase_cost: 0,
        item_price: 0,
        material_id: '',
        total_cost: 0,
        profit: 0,
        advance_payment: 0,
    },
]);

const commonForm = ref({
    name: '',
    phone: '',
    address: '',
});

const shipmentForm = ref({
    division: '',
    shipment_type: '',
    product_description: '',
    weight: '',
    pieces: '',
    payment_type: '',
    cod_amount: '',
    order_id: '',
    special_instructions: '',
});

async function getCities() {
    const response = await axios.get(route('courier.cities', { courier: 'leopard' }));
    cities.value = response.data.data;
}

async function getPlatforms() {
    const response = await axios.get(route('platforms.get'));
    platforms.value = response.data.data;
}

async function getMaterials() {
    const response = await axios.get(route('materials.get'));
    materials.value = response.data.data;
}
async function getVendors() {
    const response = await axios.get(route('vendors.get'));
    vendors.value = response.data.data;
}

const getMaterialPrice = (id) => {
    const material = materials.value.find((m) => m.id === id);
    return material ? material.price : 0;
};

const addRow = () => {
    const newItem = {
        id: items.value.length + 1,
        vendor_id: '',
        platform_id: '',
        item_name: '',
        purchase_cost: 0,
        item_price: 0,
        material_id: '',
        total_cost: 0,
        profit: 0,
        advance_payment: 0,
    };
    items.value.push(newItem);
};

const removeRow = (id) => {
    items.value = items.value.filter((item) => item.id !== id);
    items.value.forEach((item, index) => {
        item.id = index + 1; // Reassign IDs to maintain sequential order
    });
    if (items.value.length === 0) {
        addRow(); // Ensure at least one row remains
    }
    console.log('Row removed, current items:', items.value);
};

async function submit(event) {
    event.preventDefault();
    console.log(
        ...items.value.map((item) => ({
            vendor_id: item.vendor_id,
            platform_id: item.platform_id,
            item_name: item.item_name,
            purchase_cost: item.purchase_cost,
            item_price: item.item_price,
            material_id: item.material_id,
            advance_payment: item.advance_payment,
        })),
    );
    is_loading.value = true;
    try {
        const response = await axios.post(route('courier.createOrder', { courier: 'leopard' }), {
            destination_city: selectedCity.value,
            shipment_type: shipment_types[division.value][0][0],
            division: division.value,
            booked_packet_weight: shipmentForm.value.weight,
            booked_packet_no_piece: shipmentForm.value.pieces,
            booked_packet_collect_amount: shipmentForm.value.cod_amount,
            order_id: shipmentForm.value.order_id,
            consignee_name: commonForm.value.name,
            consignee_phone: commonForm.value.phone,
            consignee_address: commonForm.value.address,
            special_instructions: shipmentForm.value.special_instructions,
            items: items.value.map((item) => ({
                vendor_id: item.vendor_id,
                platform_id: item.platform_id,
                item_name: item.item_name,
                purchase_cost: item.purchase_cost,
                item_price: item.item_price,
                material_id: item.material_id,
                advance_payment: item.advance_payment,
            })),
        });

        successModalButton.click(); // Trigger the success modal
    } catch (error) {
        console.log(error);
    } finally {
        is_loading.value = false;
    }
}

onMounted(async () => {
    try {
        await Promise.all([getCities(), getPlatforms(), getMaterials(), getVendors()]);
    } catch (e) {
        console.log(e);
    }

    nextTick(() => {
        // Initialize Select2
        $('.select2').select2({
            placeholder: 'Select Destination City',
            allowClear: true,
        });

        $('#destination_city').select2().on('change', (e) => {
            selectedCity.value = $(e.target).val();
        });

    });
    is_fetching.value = false
});

function goToIndexPage() {
    router.visit(route('booking.index'));
}

watch(selectedCity, (newValue) => {
    console.log('Selected city:', newValue);
});

watch(selectedMaterial, (newValue) => {
    console.log('Selected material:', newValue);
});
</script>

<style scoped>
.spinner {
    width: 48px;
    height: 48px;
    border: 5px solid black;
    border-bottom-color: transparent;
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
    }

    @keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
    }
</style>
<template>
    <button data-bs-toggle="modal" id="successModalButton" data-bs-target="#successModal" style="display: none">Testing</button>
    <div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4 text-center">
                <div class="modal-body">
                    <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="text-success mb-3">
                        <i class="bi bi-check-circle" style="font-size: 3rem"></i>
                    </div>

                    <h4 class="mb-2">Shipment has been created</h4>
                    <p class="text-muted">Your shipment was added successfully.</p>

                    <button type="button" @click="goToIndexPage" class="btn btn-success mt-3" data-bs-dismiss="modal">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <div v-show="!is_fetching" class="container-xxl container-p-y flex-grow-1">
        <form class="card-body" method="POST" @submit="submit">
            <!-- Bootstrap Multi-column Form Layout -->
            <div class="card mb-4 p-3">
                <h5 class="card-header">Create New Order</h5>

                <h6>1. Consignee Details</h6>
                <div class="row g-6">
                    <Input
                        @update:modelValue="commonForm.name = $event"
                        label="Consignee Name *"
                        type="text"
                        name="consignee_name"
                        placeholder="Consignee Name"
                    />
                    <Input
                        @update:modelValue="commonForm.phone = $event"
                        label="Consignee Phone *"
                        type="text"
                        name="consignee_phone"
                        placeholder="Consignee Phone"
                    />
                    <Input
                        @update:modelValue="commonForm.address = $event"
                        label="Consignee Address *"
                        type="text"
                        name="consignee_address"
                        placeholder="Consignee Address"
                        :length="12"
                    />
                </div>

                <hr class="mx-n4 my-6" />
                <h6>2. Shipment Details</h6>
                <div class="row g-6">
                    <div class="col-md-6">
                        <div class="form-floating form-floating-outline form-floating-select2">
                            <select
                            v-model="selectedCity"
                                name="destination_city"
                                id="destination_city"
                                class="select2 form-select select2-hidden-accessible"
                                data-allow-clear="true"
                                required
                            >
                                <option value="">Select Destination City</option>
                                <option v-for="city in cities" :value="city.id">{{ city.city }}</option>
                            </select>
                            <label for="destination_city">Destination City *</label>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="form-floating form-floating-outline">
                            <Multiselect
                                :options="cities"
                                label="city"
                                track-by="id"
                                v-model="selectedCity"
                                :required="true"
                                class="form-control"
                                id="selectInput"
                            />
                            <label for="selectInput">Delivery Places</label>
                        </div>
                    </div> -->

                    <DropdownMenu
                        label="Division *"
                        name="division"
                        :length="6"
                        nonvalueitem="Select Division"
                        @update:modelValue="division = $event"
                        :items="[
                            ['EXPRESS', 'EXPRESS'],
                            ['LOGISTICS', 'LOGISTICS'],
                        ]"
                        value-key="0"
                        item-key="1"
                    />

                    <DropdownMenu
                        label="Shipment Type *"
                        name="shipment_type"
                        :length="6"
                        nonvalueitem="Select Shipment Type"
                        :items="shipment_types[division]"
                        value-key="0"
                        item-key="1"
                    />

                    <Input
                        @update:modelValue="shipmentForm.product_description = $event"
                        label="Product Description *"
                        type="text"
                        name="product_description"
                        placeholder="Product Description *"
                    />

                    <Input
                        @update:modelValue="shipmentForm.weight = $event"
                        label="Weigh (grams) *"
                        type="text"
                        name="weight"
                        placeholder="Weight (grams) *"
                    />

                    <Input
                        @update:modelValue="shipmentForm.pieces = $event"
                        label="No. of Pieces *"
                        type="text"
                        name="pieces"
                        placeholder="No. of Pieces *"
                    />

                    <DropdownMenu
                        @update:modelValue="shipmentForm.payment_type = $event"
                        label="Payment Type *"
                        name="payment_type"
                        :length="6"
                        nonvalueitem="Select Payment Type"
                        :items="[
                            ['COD', 'COD'],
                            ['PREPAID', 'PREPAID'],
                        ]"
                        value-key="0"
                        item-key="1"
                    />

                    <Input
                        @update:modelValue="shipmentForm.cod_amount = $event"
                        label="COD Amount *"
                        type="number"
                        name="cod_amount"
                        placeholder="COD Amount *"
                    />

                    <Input
                        @update:modelValue="shipmentForm.order_id = $event"
                        label="Order ID"
                        type="text"
                        name="order_id"
                        placeholder="Order ID *"
                    />

                    <Input
                        @update:modelValue="shipmentForm.special_instructions = $event"
                        label="Special Instructions *"
                        type="text"
                        name="special_instructions"
                        :length="12"
                        placeholder="Handle with care *"
                        is-text-area
                    />
                </div>
            </div>

            <div class="card mb-4 p-3">
                <h6>3. Items Details</h6>
                <table class="table-bordered table" id="itemsTable">
                    <thead>
                        <tr>
                            <th>Vendor</th>
                            <th>Platform</th>
                            <th>Product Name</th>
                            <th>Cost</th>
                            <th>Selling</th>
                            <th>Packaging Material</th>
                            <th>Total Amount</th>
                            <th>Profit</th>
                            <th>Advance Payment</th>
                            <th><button type="button" class="btn btn-sm btn-success" id="addRow" @click="addRow">+</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="item-row" v-for="item in items" :key="item.id">
                            <td>
                                <select name="vendor_id[]" v-model="item.vendor_id" class="form-select" required>
                                    <option value="">Select Vendor</option>
                                    <option v-for="vendor in vendors" :key="vendor.id" :value="vendor.id">{{ vendor.name }}</option>
                                </select>
                            </td>
                            <td>
                                <select name="platform_id[]" v-model="item.platform_id" class="form-select" required>
                                    <option value="">Select Platform</option>
                                    <option v-for="platform in platforms" :key="platform.id" :value="platform.id">{{ platform.name }}</option>
                                </select>
                            </td>
                            <td><input type="text" v-model="item.item_name" name="item_name[]" class="form-control" required /></td>
                            <td>
                                <input
                                    type="number"
                                    step="0.01"
                                    v-model="item.purchase_cost"
                                    name="purchase_cost[]"
                                    class="form-control purchase-cost"
                                    required
                                />
                            </td>
                            <td>
                                <input
                                    type="number"
                                    step="0.01"
                                    v-model="item.item_price"
                                    name="item_price[]"
                                    class="form-control item-price"
                                    required
                                />
                            </td>
                            <td>
                                <select name="material_id[]" v-model="item.material_id" class="form-select material-select" required>
                                    <option value="">Select Material</option>
                                    <option v-for="material in materials" :key="material.id" :value="material.id">{{ material.name }}</option>
                                </select>
                            </td>
                            <td><input type="number" name="total_cost[]" :value="item.item_price" class="form-control total-cost" readonly /></td>
                            <td>
                                <input
                                    type="number"
                                    step="0.01"
                                    name="profit[]"
                                    :value="parseInt(item.item_price - item.purchase_cost) - getMaterialPrice(item.material_id)"
                                    class="form-control profit"
                                    readonly
                                />
                            </td>
                            <td><input type="number" step="0.01" name="advance_payment[]" v-model="item.advance_payment" class="form-control" /></td>
                            <td><button type="button" class="btn btn-sm btn-danger removeRow" @click="removeRow(item.id)">-</button></td>
                        </tr>
                    </tbody>
                </table>

                <div class="pt-6" style="display: flex; justify-content: flex-start">
                    <button
                        :disabled="is_loading"
                        type="submit"
                        class="btn btn-primary waves-effect waves-light d-flex align-items-center justify-content-center me-4"
                        style="min-width: 120px"
                    >
                        <template v-if="is_loading">
                            <span class="loader small"></span>
                        </template>
                        <template v-else>
                            <span>Book Order</span>
                        </template>
                    </button>
                    <button type="reset" class="btn btn-outline-secondary waves-effect">Cancel</button>
                </div>
            </div>
        </form>
    </div>

    <div v-if="is_fetching" style="display: flex; align-items: center; justify-content: center; flex-direction: column; height: 100vh;">
        <span class="spinner"></span>
    </div>
</template>
