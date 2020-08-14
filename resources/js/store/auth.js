// ====================
// Store Auth(認証用)
// ====================


// ===============
// state
// ===============
const state = {
  //ログイン済みユーザーの保持
  user: null
}


// ===============
// getter
// ===============
const getter = {}


// ===============
// mutations
// ===============
const mutations = {
  setUser(state, userdata) {
    state.user = userdata
  }
}

// ===============
// actions
// ===============
const actions = {
  
  // -------------
  // 会員登録
  // -------------
  async register (context, data) {
    // 会員登録APIに入力フォームのデータを送り、レスポンスを受け取る
    const response = await axios.post('/api/register', data);
    // 受け取ったレスポンスを元に、userステートを更新
    context.commit('setUser', response.data);
  },
  
  // -------------
  // ログイン
  // -------------
  async login (context, data) {
    const response = await axios.post('/api/login', data);
    context.commit('setUser', response.data);
  },
  
  // -------------
  // ログアウト
  // -------------
  async logout (context) {
    const response = await axios.post('/api/logout');
    context.commit('setUser', null);
  }
}

// ================
// export default
// ================
export default {
  namespaced: true,
  state,
  getter,
  mutations,
  actions
}
