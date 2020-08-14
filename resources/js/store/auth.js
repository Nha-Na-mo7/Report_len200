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
const getters = {
  loginCheck: state => !! state.user,
  username: state => state.user ? state.user.name : ''
}

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
    // const response = await axios.post('/api/logout');
    await axios.post('/api/logout');
    context.commit('setUser', null);
  },
  
  // --------------------
  // 現在のユーザー情報を返却
  // --------------------
  async currentUser (context) {
    const response = await axios.get('/api/user');
    const currentUser = response.data || null;
    context.commit('setUser', currentUser);
  }
}

// ================
// export default
// ================
export default {
  namespaced: true,
  state,
  getters,
  mutations,
  actions
}
