export type TransactionType = 'income' | 'expense'

export type TransactionItem = {
  id: number
  date: Date
  category: string
  amount: number
  memo: string
}
