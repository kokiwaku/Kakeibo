import { Category } from '@/types/models/category'

export const expenseCategories: Category[] = [
  {
    id: 1,
    name: '食費',
    subCategory: [
      { id: 101, name: '食料品' },
      { id: 102, name: '外食' },
      { id: 103, name: 'カフェ' },
      { id: 104, name: '朝食' },
      { id: 105, name: '昼食' },
      { id: 106, name: '夕食' },
      { id: 107, name: '夜食' },
      { id: 108, name: 'その他食費' },
    ],
  },
  {
    id: 2,
    name: '日用品',
    subCategory: [
      { id: 201, name: '衣服' },
      { id: 202, name: '靴' },
      { id: 203, name: 'アクセサリー' },
      { id: 204, name: '化粧品' },
      { id: 205, name: '生活用品' },
      { id: 206, name: 'その他日用品' },
    ],
  },
  {
    id: 3,
    name: '趣味・娯楽',
    subCategory: [
      { id: 301, name: 'アウトドア' },
      { id: 302, name: 'スポーツ' },
      { id: 303, name: 'ゲーム' },
      { id: 304, name: '映画・音楽' },
      { id: 305, name: '本' },
      { id: 306, name: '旅行' },
      { id: 307, name: 'その他趣味' },
    ],
  },
  {
    id: 4,
    name: '交通費',
    subCategory: [
      { id: 401, name: '電車' },
      { id: 402, name: 'バス' },
      { id: 403, name: 'タクシー' },
      { id: 404, name: '飛行機' },
      { id: 405, name: 'その他交通費' },
    ],
  },
  {
    id: 5,
    name: '健康・医療',
    subCategory: [
      { id: 501, name: '医療費' },
      { id: 502, name: '薬' },
      { id: 503, name: '歯科' },
      { id: 504, name: 'フィットネス' },
      { id: 505, name: 'ボディケア' },
      { id: 506, name: 'その他医療費' },
    ],
  },
  {
    id: 6,
    name: '自動車',
    subCategory: [
      { id: 601, name: 'ガソリン' },
      { id: 602, name: '駐車場' },
      { id: 603, name: '車検・整備' },
      { id: 604, name: '高速料金' },
      { id: 605, name: 'その他自動車費' },
    ],
  },
  {
    id: 7,
    name: '教育・教養',
    subCategory: [
      { id: 701, name: '書籍' },
      { id: 702, name: '新聞・雑誌' },
      { id: 703, name: '習い事' },
      { id: 704, name: 'セミナー' },
      { id: 705, name: '学費' },
      { id: 706, name: 'その他教育費' },
    ],
  },
  {
    id: 8,
    name: '特別な支出',
    subCategory: [
      { id: 801, name: '冠婚葬祭' },
      { id: 802, name: '誕生日' },
      { id: 803, name: '記念日' },
      { id: 804, name: 'プレゼント' },
      { id: 805, name: 'その他特別費' },
    ],
  },
  {
    id: 9,
    name: '現金・カード',
    subCategory: [
      { id: 901, name: 'ATM引き出し' },
      { id: 902, name: '電子マネーチャージ' },
      { id: 903, name: 'カード引き落とし' },
      { id: 904, name: 'その他現金・カード' },
    ],
  },
  {
    id: 10,
    name: '通信費',
    subCategory: [
      { id: 1001, name: '携帯電話' },
      { id: 1002, name: '固定電話' },
      { id: 1003, name: 'インターネット' },
      { id: 1004, name: '放送視聴料' },
      { id: 1005, name: 'その他通信費' },
    ],
  },
  {
    id: 11,
    name: '住宅',
    subCategory: [
      { id: 1101, name: '家賃' },
      { id: 1102, name: '地震・火災保険' },
      { id: 1103, name: '修繕・メンテナンス' },
      { id: 1104, name: 'その他住宅費' },
    ],
  },
  {
    id: 12,
    name: '水道・光熱費',
    subCategory: [
      { id: 1201, name: '電気代' },
      { id: 1202, name: 'ガス代' },
      { id: 1203, name: '水道代' },
      { id: 1204, name: 'その他水道・光熱費' },
    ],
  },
  {
    id: 13,
    name: '税金・保険',
    subCategory: [
      { id: 1301, name: '所得税' },
      { id: 1302, name: '住民税' },
      { id: 1303, name: '年金保険料' },
      { id: 1304, name: '健康保険' },
      { id: 1305, name: '生命保険' },
      { id: 1306, name: '自動車保険' },
      { id: 1307, name: 'その他税・保険' },
    ],
  },
  {
    id: 16,
    name: 'その他',
    subCategory: [
      { id: 1601, name: '仕送り' },
      { id: 1602, name: '寄付金' },
      { id: 1603, name: '雑費' },
      { id: 1604, name: 'その他' },
    ],
  },
  {
    id: 17,
    name: '未分類',
    subCategory: [],
  },
]
