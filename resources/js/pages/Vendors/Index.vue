<script lang="ts" setup>
import { nextTick, onMounted, ref, watch } from 'vue';
import axios from 'axios';

const vendors = ref([]);
const vendor_name = ref('');
const material_price = ref('');
const toDelete = ref(null);
const toEdit = ref(null);

async function getVendors() {
    try {
        const response = await axios.get(route('vendors.get'));
        vendors.value = response.data;
    } catch (error) {
        console.error('Error fetching materials:', error);
    }
}

async function addVendor(e) {
    e.preventDefault(); // Prevent form submission
    try {
        const response = await axios.post(route('vendor.create'), {
            name: vendor_name.value,
            price: material_price.value
        });
        if (response.status === 201) {
            closeCreateModal.click(); // Close the modal
            // Reset form fields
            vendor_name.value = '';
            // Refresh materials list
            await getVendors();
        } else {
            console.error('Error adding material:', response.data.message);
        }
    } catch (error) {
        console.error('Error adding material:', error);
    }
}

async function editVendor(e) {
    e.preventDefault(); // Prevent form submission
    try {
        const response = await axios.post(route('vendor.update', { id: toEdit.value }), {
            name: edit_vendor_name.value,
        });
        console.log(response);
        if (response.status === 200) {
            // Reset toEdit and refresh materials list
            cancelMaterialButton.click(); // Close the modal
            toEdit.value = null;// Close the modal
            await getVendors();
        } else {
            console.error('Error editing material:', response.data.message);
        }
    } catch (error) {
        console.error('Error editing material:', error);
    }
}

async function deleteVendor(e) {
    e.preventDefault(); // Prevent form submission
    try {
        const response = await axios.post(route('vendor.delete', { id: toDelete.value }));
        console.log(response);
        if (response.status === 200) {
            // Reset toDelete and refresh materials list
            toDelete.value = null;
            cancelModalButton.click(); // Close the modal
            await getVendors();
        } else {
            console.error('Error deleting material:', response.data.message);
        }
    } catch (error) {
        console.error('Error deleting material:', error);
    }
}

const initializeDataTable = () => {
  const table = $('#myTable').DataTable();

  // Destroy existing instance
  if ( $.fn.DataTable.isDataTable('#myTable') ) {
    table.destroy();
  }

  // Re-initialize after DOM updates
  nextTick(() => {
    $('#myTable').DataTable({
      pageLength: 10,
      lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ]
    });
  });
}

onMounted(async () => {
    await getVendors();
    initializeDataTable();
});


let hasWatchedOnce = false;
watch(vendors, () => {
  if (hasWatchedOnce) {
    initializeDataTable();
  } else {
    hasWatchedOnce = true;
  }
});


</script>
<template>
    <div class="container-xxl container-p-y flex-grow-1">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between ps-0 pb-0">
                <h5 class="card-header">Manage Packaging Materials</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMaterialModal">Add Vendor</button>
            </div>
            <div class="table-responsive text-nowrap">
            <table id="myTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No#</th>
                            <th>Vendor Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(vendor, index) in vendors.data" :key="vendor.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ vendor.name }}</td>
                            <td style="display: flex; gap: 10px;">
                                <button class="btn btn-sm btn-warning editBtn" @click="toEdit = vendor.id" data-bs-target="#editMaterialModal" data-bs-toggle="modal" data-id="1">Edit</button>
                                <button class="btn btn-sm btn-danger deleteBtn" @click="toDelete = vendor.id" data-bs-toggle="modal" data-bs-target="#deleteMaterialModal" data-id="1">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<!-- Delete Material Modal -->
<div class="modal fade" id="deleteMaterialModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-md modal-simple modal-delete-user">
    <div class="modal-content">
      <div class="modal-body">
        <h4 class="text-center mb-4">Are you sure you want to delete <span id="delete_material_name"></span>?</h4>
        <form method="POST" class="text-center">
          <input type="hidden" name="material_id" id="delete_material_id">
          <button type="submit" @click="deleteVendor" name="delete_material" class="btn btn-danger me-3">Yes, Delete</button>
          <button type="button" @click="toDelete = null" id="cancelModalButton" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Material Modal -->
<div class="modal fade" id="editMaterialModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content">
      <div class="modal-body p-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        <div class="text-center mb-6">
          <h4 class="mb-2">Edit Packaging Material</h4>
        </div>
        <form method="POST" class="row g-5">
          <input type="hidden" name="material_id" id="edit_material_id">
          <div class="col-12">
            <div class="form-floating form-floating-outline">
              <input type="text" :value="vendors.data?.filter(vendor => vendor.id == toEdit)[0]?.name ?? ''" name="vendor_name" id="edit_vendor_name" class="form-control" placeholder="Vendor Name" required />
              <label for="edit_vendor_name">Vendor Name</label>
            </div>
          </div>
          <div class="col-12 text-center">
            <button type="submit" @click="editVendor" name="update_material" id="updateMaterialButton" class="btn btn-primary me-3">Update</button>
            <button type="button" @click="toEdit = null" id="cancelMaterialButton" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

    <!-- Add Material Modal -->
    <div class="modal fade" id="addMaterialModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    <div class="mb-6 text-center">
                        <h4 class="mb-2">Add Packaging Material</h4>
                    </div>
                    <form method="POST" class="row g-5">
                        <div class="col-12">
                            <div class="form-floating form-floating-outline">
                                <input v-model="vendor_name" type="text" name="vendor_name" class="form-control" placeholder="Vendor Name" required />
                                <label for="vendor_name">Name</label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" name="add_material" @click="addVendor" class="btn btn-primary me-3">Submit</button>
                            <button type="button" id="closeCreateModal" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
