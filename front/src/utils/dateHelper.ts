/**
 * 日付操作系のヘルパーを定義する
 */

/**
 * ISO8601 形式の年月文字列を取得する
 * 引数dateが指定されていない場合は、現在の年月を返す
 * 区切り文字が渡された場合には、その文字で年月を区切る
 * toISOString().slice(0, 7)
 */
export const getYearMonthISOString = (date?: Date, separator = '-'): string => {
  const target = date ? new Date(date) : new Date()
  return target.toISOString().slice(0, 7)
}

/**
 * 引数で渡されたdateについて、引数で渡された月数(minus)遡った年月を取得する
 * minusはデフォルトで1ヶ月前を指定する
 */
export const getPrevYearMonth = (date: Date, minus = 1): Date => {
  const target = new Date(date)
  target.setMonth(target.getMonth() - minus)
  return target
}

/**
 * 引数で渡されたdateについて、引数で渡された月数(plus)加算した年月を取得する
 * plusはデフォルトで1ヶ月後を指定する
 */
export const getNextYearMonth = (date: Date, plus = 1): Date => {
  const target = new Date(date)
  target.setMonth(target.getMonth() + plus)
  return target
}

/**
 * 引数で渡されたdateについて、ISO8601形式の年月文字列を取得する
 */
export const formatISOString = (date: Date): string => {
  return date.toISOString().slice(0, 7)
}
