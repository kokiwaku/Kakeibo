import { NextRequest, NextResponse } from 'next/server'
import { Response } from '@/types/api'

export async function POST(request: NextRequest) {
  // 固定でログイン成功
  const result: Response = {
    code: 200,
  }
  // jwt_tokenをCookieに設定
  const response = NextResponse.json(result)
  response.cookies.set({
    name: 'auth_token',
    value: 'dummy_jwt_token_for_mock', // 実際のアプリケーションでは適切なJWTトークンを生成
    httpOnly: true,
    secure: false,
    sameSite: 'lax',
    path: '/',
  })

  return response
}
