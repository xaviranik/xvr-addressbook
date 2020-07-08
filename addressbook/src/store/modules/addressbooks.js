import axios from "axios";

const state = {
    addressbooks: []
};

const getters = {
    allAddressbooks: (state) => state.addressbooks,
};

const actions = {
    async getAddressbooks({
        commit
    }) {
        const response = await axios.get('http://wp-firestarter.test/wp-json/ninja/v1/contacts');
        commit('setAddressbooks', response.data);
    },
    async createAddressbook({
        commit
    }, addressbook) {
        const response = await axios.post('http://wp-firestarter.test/wp-json/ninja/v1/contacts', addressbook);
        commit('newAddressbook', response.data);
    }
};

const mutations = {
    setAddressbooks: (state, addressbooks) => state.addressbooks = addressbooks,
    newAddressbook: (state, addressbook) => state.addressbooks.push(addressbook),
};

export default {
    state,
    getters,
    actions,
    mutations
}