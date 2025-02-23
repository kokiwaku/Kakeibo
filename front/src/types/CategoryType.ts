export type CategoryType = {
  id: number
  name: string
  subCategory?: { id: number; name: string }[]
}
export type DisplayCategoryType = {
  category: CategoryType[]
  position: {
    top: number
    left: number
  }
}
export type SubCategoryType = {
  id: number
  name: string
}
export type DisplaySubCategoryType = {
  category: CategoryType
  position: {
    top: number
    right: number
  }
}
