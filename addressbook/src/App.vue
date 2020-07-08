<template>
  <div id="app">
    <AddressbookModal />
    <Addressbooks />
  </div>
</template>

<script>
import Addressbooks from "./components/Addressbooks.vue";
import AddressbookModal from "./components/AddressbookModal.vue";

export default {
  name: "App",
  components: {
    Addressbooks,
    AddressbookModal
  }
};
</script>
