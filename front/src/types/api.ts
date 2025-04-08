import { AxiosError } from 'axios'

// 正常系の全レスポンス共通の型
export type Response<T = undefined> = {
  code: number
  data?: T
  message?: Array<string>
}

// エラー系の全レスポンス共通の型
export type ApiError = AxiosError<{
  error: {
    type: string
    message: Array<string>
  }
  status: number
}>
