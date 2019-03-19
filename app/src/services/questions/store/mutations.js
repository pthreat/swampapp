const FETCHING = (state, value) => {
  state.fetching = !!value;
}

const FETCH_SUCCESS = (state, value) => {
  state.success = !!value;
}

const FETCH_ERROR = (state, value) => {
  state.error = !!value;
}

const FETCH_COMMIT = (state, data) => {
  state.data = data;
}

export default {
  FETCHING,
  FETCH_COMMIT,
  FETCH_ERROR,
  FETCH_SUCCESS,
};
