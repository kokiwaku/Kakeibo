export type TransactionType = 'incomes' | 'expenses'

export type TransactionItemType = {
  id: number
  date: Date
  category: string
  amount: number
  memo: string
}
