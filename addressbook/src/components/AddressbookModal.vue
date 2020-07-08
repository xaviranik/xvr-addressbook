<template>
  <div
    class="modal fade"
    id="addressbook-modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Addressbook</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form @submit.prevent="onSubmit">
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input
                type="text"
                class="form-control"
                id="name"
                placeholder="John Doe"
                v-model="addressbook.name"
              />
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input
                type="text"
                class="form-control"
                id="address"
                placeholder="221B Baker st, London"
                v-model="addressbook.address"
              />
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input
                type="text"
                class="form-control"
                id="phone"
                placeholder="+888 000 9999"
                v-model="addressbook.phone"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "AddressbookModal",
  data() {
    return {
      addressbook: {
        name: "",
        address: "",
        phone: ""
      }
    };
  },
  methods: {
    ...mapActions(["createAddressbook"]),
    onSubmit() {
      this.createAddressbook(this.addressbook);
    }
  }
};
</script>