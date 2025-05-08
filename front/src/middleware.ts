import { NextRequest, NextResponse } from 'next/server'
import { routes } from './config/routes'

// 認証不要なパス
const unauthorozeAllowPath = [routes.auth.login, routes.auth.signup]

export default function middleware(req: NextRequest) {
  const { nextUrl } = req

  // 認証不要なパスはスルー
  if (unauthorozeAllowPath.includes(nextUrl.pathname)) {
    return NextResponse.next()
  }

  /**
   * 認証
   * ここではtokenの存在のみチェック
   * tokenの有用性チェックはpage側で実施
   */
  const token = req.cookies.get('auth_token')
  if (!token) {
    return NextResponse.redirect(new URL(routes.auth.login, nextUrl))
  }
  return NextResponse.next()
}

export const config = {
  matcher: [
    /*
     * Match all request paths except for the ones starting with:
     * - api (API routes)
     * - _next/static (static files)
     * - _next/image (image optimization files)
     * - favicon.ico, sitemap.xml, robots.txt (metadata files)
     */
    '/((?!api|_next/static|_next/image|favicon.ico|sitemap.xml|robots.txt).*)',
  ],
}
