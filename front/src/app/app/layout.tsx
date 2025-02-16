import { Metadata } from 'next'
import React, { ReactNode } from 'react'
import SidePanel from '@/components/SidePanel'
import { ModalProvider } from '@/features/incomes/contexts/ModalContext'

export const metadata: Metadata = {
  title: 'Create Next App',
  description: 'Generated by create next app',
}

const AppLayout = ({ children }: { children: ReactNode }) => {
  return (
    <div className="flex h-screen gb-background">
      <SidePanel />
      <div className="flex flex-1 flex-col">{children}</div>
    </div>
  )
}

export default AppLayout
