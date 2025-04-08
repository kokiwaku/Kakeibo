export type Category = {
  id: number
  name: string
  subCategory?: { id: number; name: string }[]
}

export type DisplayCategory = {
  category: Category[]
  position: {
    top: number
    left: number
  }
}

export type SubCategory = {
  id: number
  name: string
}

export type DisplaySubCategory = {
  category: SubCategory
  position: {
    top: number
    right: number
  }
}
