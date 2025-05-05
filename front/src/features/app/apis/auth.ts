import globalAxios, { isAxiosError } from '@/libs/api-client'
import { Response, ApiError } from '@/types/api'
import { api } from '@/config/api'

export const validateToken = async (): Promise<Response<null>> => {
  try {
    await globalAxios.post(api.endpoints.auth.validateToken)
    return {
      code: 204,
    }
  } catch (error) {
    if (isAxiosError(error)) {
      const axiosError = error as ApiError
      return {
        code: axiosError.response?.status ?? 500,
        data: null,
        message: axiosError.response?.data.error.message,
      }
    }
    return {
      code: 500,
      data: null,
      message: ['An error occurred while validate token.'],
    }
  }
}

export const logout = async (): Promise<Response<null>> => {
  try {
    await globalAxios.post(api.endpoints.auth.logout)
    return {
      code: 204,
    }
  } catch (error) {
    if (isAxiosError(error)) {
      const axiosError = error as ApiError
      return {
        code: axiosError.response?.status ?? 500,
        data: null,
        message: axiosError.response?.data.error.message,
      }
    }
    return {
      code: 500,
      data: null,
      message: ['An error occurred while logout.'],
    }
  }
}
