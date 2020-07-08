import Vue from "vue";
import Vuex from "vuex";
import addressbook from "./modules/addressbooks";

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
    addressbook
  }
});
