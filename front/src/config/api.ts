/**
 * API設定
 */

// 環境変数からAPIの設定を取得
const isMockMode = process.env.NEXT_PUBLIC_API_MOCK_MODE === 'true'
const baseURL = isMockMode
  ? process.env.NEXT_PUBLIC_API_MOCK_URL
  : process.env.NEXT_PUBLIC_API_PRODUCTION_URL

export const api = {
  baseURL,
  endpoints: {
    auth: {
      register: '/auth/register',
      login: '/auth/login',
    },
    categories: {
      // list取得用
      getList: '/categories',
      // 追加用
      create: '/categories',
      // 更新用
      update: '/categories/:id',
      // 削除用
      delete: '/categories/:id',
    },
  },
}
