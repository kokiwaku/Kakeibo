import { NextResponse } from 'next/server'
import { Response } from '@/types/api'
import { UserInfo } from '@/types/models/user'

export async function POST() {
  // 固定でtoken検証成功
  const result: Response<UserInfo> = {
    code: 200,
    data: {
      name: 'Test User Name',
    },
  }
  const response = NextResponse.json(result)
  return response
}
