import globalAxios, { isAxiosError } from '@/libs/api-client'
import { Response, ApiError } from '@/types/api'
import { api } from '@/config/api'

export const login = async (email: string, password: string) => {
  try {
    await globalAxios.post(api.endpoints.auth.login, {
      email,
      password,
    })

    const result: Response = {
      code: 200,
    }
    return result
  } catch (error) {
    const result: Response = {
      code: 500,
      message: ['An error occurred while login.'],
    }
    if (isAxiosError(error)) {
      const axiosError = error as ApiError
      result.code = axiosError.response?.status ?? 500
      result.message = axiosError.response?.data.error.message
    }
    return result
  }
}
