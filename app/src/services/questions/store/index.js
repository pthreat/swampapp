import actions from './actions'
import getters from './getters'
import mutations from './mutations'
import initialState from './state'

export default {
  namespaced: true,
  state: initialState.get(),
  actions,
  getters,
  mutations,
};
