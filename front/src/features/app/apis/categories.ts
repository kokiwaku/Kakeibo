import globalAxios, { isAxiosError } from '@/libs/api-client'
import { Response, ApiError } from '@/types/api'
import { api } from '@/config/api'
import { TransactionType } from '@/types/models/transaction'
import { Category } from '@/types/models/category'
import { AxiosResponse } from 'axios'

export const fetchCategories = async (
  transactionType: TransactionType,
): Promise<Response<Category[]>> => {
  try {
    const { data }: AxiosResponse<Response<Category[]>> = await globalAxios.get(
      api.endpoints.categories.getList,
      {
        params: {
          transactionType,
        },
      },
    )
    return {
      code: 200,
      data: data.data,
    }
  } catch (error) {
    if (isAxiosError(error)) {
      const axiosError = error as ApiError
      return {
        code: axiosError.response?.status ?? 500,
        data: [],
        message: axiosError.response?.data.error.message,
      }
    }
    return {
      code: 500,
      data: [],
      message: ['An error occurred while login.'],
    }
  }
}

export const postParentCategory = async (
  transactionType: TransactionType,
  categoryName: string,
): Promise<Response<Category | null>> => {
  try {
    const { data }: AxiosResponse<Response<Category | null>> =
      await globalAxios.post(api.endpoints.categories.postParent, {
        transactionType,
        categoryName,
      })
    return {
      code: 200,
      data: data.data,
    }
  } catch (error) {
    if (isAxiosError(error)) {
      const axiosError = error as ApiError
      return {
        code: axiosError.response?.status ?? 500,
        data: null,
        message: axiosError.response?.data?.error?.message,
      }
    }
    return {
      code: 500,
      data: null,
      message: ['An error occurred while login.'],
    }
  }
}
