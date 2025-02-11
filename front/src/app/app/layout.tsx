import { Metadata } from 'next'
import React, { ReactNode } from 'react'
import SidePanel from '@/components/SidePanel'

export const metadata: Metadata = {
  title: 'Create Next App',
  description: 'Generated by create next app',
}

const AppLayout = ({ children }: { children: ReactNode }) => {
  return (
    <div className="flex h-screen gb-background">
      <SidePanel />
      <main>{children}</main>
    </div>
  )
}

export default AppLayout
