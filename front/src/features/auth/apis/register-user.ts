import globalAxios, {
  ResponseType,
  isAxiosError,
  IErrorResponse,
} from '@libs/api-client'

export const signUp = async (email: string, name: string, password: string) => {
  try {
    await globalAxios.post('/auth/register', {
      email,
      name,
      password,
    })

    const result: ResponseType = {
      code: 200,
    }
    return result
  } catch (error) {
    const result: ResponseType = {
      code: 500,
      message: [],
    }
    if (isAxiosError(error)) {
      const axiosError = error as IErrorResponse
      result.code = axiosError.response.status
      result.message = axiosError.response.data.error.message
    }
    return result
  }
}
