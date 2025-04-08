export type TransactionType = 'incomes' | 'expenses'

export type TransactionItem = {
  id: number
  date: Date
  category: string
  amount: number
  memo: string
}
