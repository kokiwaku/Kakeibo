import { Category } from '@/types/models/category'

export const incomeCategories: Category[] = [
  {
    id: 1,
    name: '給与',
    subCategory: [
      { id: 101, name: '給与' },
      { id: 102, name: '賞与' },
    ],
  },
  {
    id: 2,
    name: 'その他',
    subCategory: [
      { id: 201, name: '配当金' },
      { id: 202, name: '不動産収入' },
      { id: 203, name: '臨時収入' },
      { id: 204, name: 'お小遣い' },
    ],
  },
]
