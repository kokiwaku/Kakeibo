'use client'

import React, { ReactNode } from 'react'
import SidePanel from '@/components/SidePanel'
import {
  AuthProvider,
  useAuthContext,
} from '@/features/app/contexts/common/AuthContext'

const AppLayout = ({ children }: { children: ReactNode }) => {
  return (
    <AuthProvider>
      <RenderIfAuthenticated>
        <div className="flex bg-gray-100 min-h-screen">
          <SidePanel />
          <div className="flex flex-1 flex-col py-15 px-10 bg-gray-100">
            {children}
          </div>
        </div>
      </RenderIfAuthenticated>
    </AuthProvider>
  )
}

/**
 * 認証状態に応じて表示されるコンポーネントを切り替える
 * @param param0
 * @returns
 */
const RenderIfAuthenticated = ({ children }: { children: ReactNode }) => {
  const { isTokenValidated, userInfo } = useAuthContext()
  if (isTokenValidated && userInfo) {
    return <>{children}</>
  }
  return <div>Loading...</div>
}

export default AppLayout
