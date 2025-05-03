import { NextRequest, NextResponse } from 'next/server'
import { Response } from '@/types/api'

export async function POST(request: NextRequest) {
  // 固定でtoken検証成功
  const result: Response = {
    code: 204,
  }
  const response = NextResponse.json(result)
  return response
}
