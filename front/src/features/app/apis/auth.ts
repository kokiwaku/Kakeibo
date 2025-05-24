import globalAxios, { isAxiosError } from '@/libs/api-client'
import { Response, ApiError } from '@/types/api'
import { api } from '@/config/api'
import { UserInfo } from '@/types/models/user'
import { AxiosResponse } from 'axios'

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

export const getUserInfo = async (): Promise<Response<UserInfo>> => {
  try {
    const { data }: AxiosResponse<Response<UserInfo>> = await globalAxios.post(
      api.endpoints.auth.getUserInfo,
    )
    return {
      code: 200,
      data: {
        name: data.data?.name ?? '',
      },
    }
  } catch (error) {
    if (isAxiosError(error)) {
      const axiosError = error as ApiError
      return {
        code: axiosError.response?.status ?? 500,
        data: {
          name: '',
        },
        message: axiosError.response?.data.error.message,
      }
    }
    return {
      code: 500,
      data: {
        name: '',
      },
      message: ['An error occurred while get user info.'],
    }
  }
}
