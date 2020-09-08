// ====================
// Store Auth(認証用)
// ====================
import { OK, CREATED, UNPROCESSABLE_ENTITY } from '../util'




// ===============
// state
// ===============
const state = {
  //ログイン済みユーザーの保持
  user: null,
  //APIの呼び出しにエラーが起きていないか
  apiStatus: null,
  //エラーメッセージ
  loginErrorMessages: null,
  registerErrorMessages: null
}




// ===============
// getter
// ===============
const getters = {
  loginCheck: state => !! state.user,
  username: state => state.user ? state.user.name : '',
  user_id: state => state.user ? state.user.id : ''
}




// ===============
// mutations
// ===============
const mutations = {
  setUser(state, userdata) {
    state.user = userdata
  },
  setApiStatus(state, status) {
    state.apiStatus = status
  },
  setLoginErrorMessages(state, messages) {
    state.loginErrorMessages = messages
  },
  setRegisterErrorMessages(state, messages) {
    state.registerErrorMessages = messages
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
    // 始めにエラーコード欄を空にする
    context.commit('setApiStatus', null);
    // 会員登録APIに入力フォームのデータを送り、レスポンスを受け取る
    const response = await axios.post('/api/register', data);
    
    // 通信成功していた場合
    if(response.status === OK) {
      // 受け取ったレスポンスを元に、apiStatus,userステートを更新
      context.commit('setApiStatus', true);
      context.commit('setUser', response.data);
      return false;
    }
    
    // 通信失敗時、errorストアを更新
    context.commit('setApiStatus', false);
    // バリデーションエラーの時
    if(response.status === UNPROCESSABLE_ENTITY) {
      // 受け取ったレスポンスを元に、apiStatus,userステートを更新
      context.commit('setRegisterErrorMessages', response.data.errors);
    } else {
      context.commit('error/setErrorCode', response.status, {root: true})
    }
  },
  
  // -------------
  // ログイン
  // -------------
  async login (context, data) {
    // 始めにエラーコード欄を空にする
    context.commit('setApiStatus', null);
    // ログインAPIに入力フォームのデータを送り、レスポンスを受け取る
    const response = await axios.post('/api/login', data);
  
    // 通信成功していた場合
    if(response.status === OK) {
      // 受け取ったレスポンスを元に、apiStatus,userステートを更新
      context.commit('setApiStatus', true);
      context.commit('setUser', response.data);
      return false;
    }
  
    // 通信失敗時、errorストアを更新
    context.commit('setApiStatus', false);
    // バリデーションエラーの時
    if(response.status === UNPROCESSABLE_ENTITY) {
      // 受け取ったレスポンスを元に、apiStatus,userステートを更新
      context.commit('setLoginErrorMessages', response.data.errors);
    } else {
      context.commit('error/setErrorCode', response.status, {root: true})
    }
  },
  
  // -------------
  // ログアウト
  // -------------
  async logout (context) {
    context.commit('setApiStatus', null);
    const response = await axios.post('/api/logout');
    
    if(response.status === OK) {
      context.commit('setApiStatus', true);
      context.commit('setUser', null);
      return false;
    }
  
    // 通信失敗時、errorストアを更新
    context.commit('setApiStatus', false);
    context.commit('error/setErrorCode', response.status, {root: true})
  
  },
  
  // --------------------
  // 現在のユーザー情報を返却
  // --------------------
  async currentUser (context) {
    context.commit('setApiStatus', null);
    const response = await axios.get('/api/user');
    const currentUser = response.data || null;
  
    if(response.status === OK) {
      context.commit('setApiStatus', true);
      context.commit('setUser', currentUser);
      return false;
    }
  
    // 通信失敗時、errorストアを更新
    context.commit('setApiStatus', false);
    context.commit('error/setErrorCode', response.status, {root: true})
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
