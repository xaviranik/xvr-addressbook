<template>
  <div id="addressbooks">
    <div class="container-fluid">
      <div class="row my-4">
        <h3 class="mr-4">Addressbooks</h3>
        <button
          type="button"
          class="btn btn-primary"
          data-toggle="modal"
          data-target="#addressbook-modal"
          @click="openModal"
        >Add new</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) in allAddressbooks" :key="index">
                <td>{{ item['name'] }}</td>
                <td>{{ item['address'] }}</td>
                <td>{{ item['phone'] }}</td>
                <td>{{ item['date'] }}</td>
                <td>
                  <button
                    class="btn btn-outline-primary mr-2"
                    type="button"
                    data-toggle="modal"
                    data-target="#addressbook-modal"
                    @click="openModal"
                  >Edit</button>
                  <button
                    class="btn btn-outline-danger"
                    @click="deleteAddressbook(item['id'])"
                  >Delete</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Addressbooks",
  data() {
    return {
      showModal: false
    };
  },
  computed: mapGetters(["allAddressbooks"]),
  methods: {
    ...mapActions(["getAddressbooks", "deleteAddressbook"]),
    openModal() {
      this.showModal = true;
    }
  },
  created() {
    this.getAddressbooks();
  }
};
</script>