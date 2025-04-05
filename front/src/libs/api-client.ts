import axios, { AxiosError } from 'axios'
import { BACK_API_ENDPOINT } from '@/constants/server'

// axiosのインスタンスを作成
const globalAxios = axios.create({
  baseURL: BACK_API_ENDPOINT,
  headers: {
    'Content-type': 'application/json',
  },
  // クロスオリジンリクエストでクッキーを送信する
  withCredentials: true,
})

export default globalAxios

/**
 * axiosでエラーが発生しているか判定
 * 型ガード：return がtrueの時、errorの型をAxiosErrorと推論できるように
 * @param data
 * @returns
 */
export const isAxiosError = (error: any): error is AxiosError =>
  !!error.isAxiosError
