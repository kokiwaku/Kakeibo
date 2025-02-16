'use client'

import React, {
  createContext,
  ReactNode,
  useContext,
  useState,
  Dispatch,
  SetStateAction,
} from 'react'

export type ModalType = 'create' | 'update' | 'delete'

export type ModalContextType = {
  isOpenModal: boolean
  modalType: ModalType
  openModal: (type: ModalType) => void
  closeModal: () => void
}

// 明示的な型アノテーションを追加
export const ModalContext = createContext<ModalContextType>(
  {} as ModalContextType,
)

type ModalProviderProps = {
  children: ReactNode
}
export const ModalProvider: React.FC<ModalProviderProps> = ({ children }) => {
  const [isOpenModal, setIsOpenModal] = useState(false)
  const [modalType, setModalType] = useState<ModalType>('create')

  const openModal = (type: ModalType) => {
    setModalType(type)
    setIsOpenModal(true)
  }
  const closeModal = () => setIsOpenModal(false)
  return (
    <ModalContext.Provider
      value={{ isOpenModal, modalType, openModal, closeModal }}
    >
      {children}
    </ModalContext.Provider>
  )
}

export const useModalContext = () => {
  const context = useContext(ModalContext)
  if (context === undefined) {
    throw new Error('useModalContext must be used within a ModalProvider')
  }
  return context
}
