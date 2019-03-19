import api from '../api'

const fetch = ({ commit }) => {
  commit('FETCHING', true);

  return api.fetch()
  .then(response => {
    commit('FETCHING', false);
    commit('FETCH_SUCCESS', true);
    commit('FETCH_COMMIT', response.data);
    return response.data;
  })
  .catch(error => {
    commit('FETCHING', false);
    commit('FETCH_SUCCESS', false);
    commit('FETCH_ERROR', error);
    return error;
  });

}

export default {
  fetch
}
