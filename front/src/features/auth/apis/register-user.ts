import globalAxios, { isAxiosError } from '@/libs/api-client'
import { Response, ApiError } from '@/types/api'
import { paths } from '@/config/paths'

export const signUp = async (email: string, name: string, password: string) => {
  try {
    await globalAxios.post(paths.api.auth.register, {
      email,
      name,
      password,
    })

    const result: Response = {
      code: 200,
    }
    return result
  } catch (error) {
    const result: Response = {
      code: 500,
      message: ['An error occurred while registering the user.'],
    }
    if (isAxiosError(error)) {
      const axiosError = error as ApiError
      result.code = axiosError.response?.status ?? 500
      result.message = axiosError.response?.data.error.message
    }
    return result
  }
}
