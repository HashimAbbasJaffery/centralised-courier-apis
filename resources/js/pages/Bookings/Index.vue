<script setup lang="ts">
import { nextTick, onMounted, reactive, ref, watch } from 'vue';
import axios from 'axios';
import { router } from '@inertiajs/vue3';

const courier_service = ref(1);
const shipments = ref([]);
const cities = ref([]);
const filters = reactive({
  dateRange: '',
  status: '',
  originCity: '',
  destination_city: ''
});

// Use axios to fetch shipments dataa
const fetchShipments = async () => {
  try {
    const response = await axios.get('/api/shipments');
    shipments.value = response.data.data; // Assuming the API returns data in this format
  } catch (error) {
    console.error('Error fetching shipments:', error);
  }
};


const cancelOrder = async (tracking_number) => {
    const wantToCancel = confirm(`Are you sure you want to cancel the order with tracking number ${tracking_number}?`);
    if (!wantToCancel) return;
    const response = await axios.post(route('order.cancel', { tracking_number, courier: 'leopard' }));
    shipments.value = shipments.value.map(shipment => {
        if (shipment.tracking_number === tracking_number) {
            shipment.is_cancelled = true; // Update the shipment status
        }
        return shipment;
    });
}

const getCities = async () => {
  try {
    const response = await axios.get(route('courier.cities', { courier: "leopard" })); // Adjust the endpoint as necessary
    cities.value = response.data.data; // Assuming the API returns data in this format
  } catch (error) {
    console.error('Error fetching cities:', error);
  }
};

onMounted(async () => {
  await fetchShipments();
  await getCities();

  nextTick(() => {
      nextTick(() => {
    $('#origin_city').select2().on('change', (e) => {
      filters.originCity = $(e.target).val() as string;
    });

    $('#destination_city').select2().on('change', (e) => {
      filters.destination_city = $(e.target).val() as string;
    });

    $('#daterange').daterangepicker({
      locale: { format: 'YYYY-MM-DD' }
    }, function(start, end) {
      filters.dateRange = `${start.format('YYYY-MM-DD')} - ${end.format('YYYY-MM-DD')}`;
    });
  });
  })
});

watch(filters, async (newFilters) => {
    const response = await axios.get(route('shipments.index'), {
      params: {
        date_from: newFilters.dateRange.split(' - ')[0],
        date_to: newFilters.dateRange.split(' - ')[1],
        status: newFilters.status,
        originCity: newFilters.originCity,
        destination_city: newFilters.destination_city
      }
    });
    shipments.value = response.data.data; // Assuming the API returns data in this format
});

const viewOrder = tracking_number => {

    router.visit(route('booking.show', { booking: tracking_number }));
}

function formatDate(dateString: string | undefined) {
  if (!dateString) return 'N/A'
  const date = new Date(dateString)
  const day = String(date.getDate()).padStart(2, '0')
  const month = String(date.getMonth() + 1).padStart(2, '0') // months are 0-indexed
  const year = date.getFullYear()
  return `${day}/${month}/${year}`
}

</script>
<template>

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="card p-3 mb-4">
    <form id="filterForm">
      <div class="row">
        <div class="col-md-6">
          <label><strong>Date Range:</strong></label>
          <input type="text" v-model="filters.dateRange" name="daterange" id="daterange" class="form-control" />
        </div>
        <div class="col-md-6">
          <label><strong>Status:</strong></label>
          <select name="status"  v-model="filters.status" id="status" class="form-control select2">
            <option value="">All Status</option>
            <option value="Drop Off at Express Center">Drop Off at Express Center</option>
            <option value="Shipment Picked">Shipment Picked</option>
            <option value="Being Return">Being Return</option>
            <option value="Ready for Return">Ready for Return</option>
            <option value="Dispatched">Dispatched</option>
            <option value="Delivered">Delivered</option>
            <option value="Pending">Pending</option>
            <option value="Missroute">Missroute</option>
            <option value="Returned to shipper">Returned to shipper</option>
            <option value="Arrived at Station">Arrived at Station</option>
            <option value="Assign to Courier">Assign to Courier</option>
            <option value="Consignment Booked">Consignment Booked</option>
            <option value="Cancelled">Cancelled</option>
            <option value="Pickup Request Sent">Pickup Request Sent</option>
            <option value="48 Hours Auto Canceled">48 Hours Auto Canceled</option>
            <option value="Pickup Request not Send">Pickup Request not Send</option>
          </select>
        </div>
      </div>
      <div class="row mt-2">
  <div class="col-md-6">
    <label><strong>Origin City:</strong></label>
    <select id="origin_city" class="form-control select2">
      <option value="">All Origins</option>
      <option v-for="city in cities" :value="city.id">{{ city.city }}</option>
    </select>
  </div>
  <div class="col-md-6">
    <label><strong>Destination City:</strong></label>
    <select id="destination_city" class="form-control select2">
      <option value="">All Destinations</option>
      <option v-for="city in cities " :value="city.id">{{ city.city }}</option>
    </select>
  </div>
</div>

    </form>
  </div>
  <div class="card">
    <h5 class="card-header">Manage Booked Packets</h5>
    <div class="table-responsive text-nowrap" id="packetTableWrapper">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th><input type="checkbox" id="selectAll"></th>
            <th>Status</th>
            <th>Order ID</th>
            <th>CN#</th>
            <th>From</th>
            <th>To</th>
            <th>Booking Date</th>
            <th>Weight (g)</th>
            <th>Consignee Name</th>
            <th>Phone</th>
            <th>COD Value</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="packetTableBody">
            <tr v-for="shipment in shipments" :key="shipment.id">
                <td><input type="checkbox" class="cn-checkbox" :value="shipment.cn_number"></td>
                <td>{{ shipment.status }}</td>
                <td>{{ shipment.order_id }}</td>
                <td>{{ shipment.tracking_number }}</td>
                <td>{{ 'Karachi' }}</td>
                <td>{{ cities.find(city => city.id == shipment.destination_city).city }}</td>
                <td>{{ formatDate(shipment.created_at) }}</td>
                <td>{{ shipment.weight }}</td>
                <td>{{ shipment.consignee_name }}</td>
                <td>{{ shipment.phone }}</td>
                <td>{{ shipment.cod_amount }}</td>
                <td style="display: flex;">
                    <button class="btn btn-danger cancel-btn" :disabled="shipment.is_cancelled" @click="cancelOrder(shipment.tracking_number)" :data-track="shipment.cn_number">
                        <span v-if="!shipment.is_cancelled">Cancel</span>
                        <span v-else>Cancelled</span>
                    </button>
                    <button @click="viewOrder(shipment.tracking_number)" class='btn btn-info btn-sm mx-2' style="color: white;">View</button>
                </td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</template>

