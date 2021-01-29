// ====================
// error Store(エラー情報)
// ====================


// ===============
// state
// ===============
const state = {
  errorCode: null
}

// ===============
// mutations
// ===============
const mutations = {
  setErrorCode(state, code) {
    state.errorCode = code;
  }
}

// ================
// export default
// ================
export default {
  namespaced: true,
  state,
  mutations
}