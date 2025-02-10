import type { Config } from 'tailwindcss'

/**
 * Tailwind CSS設定ファイル
 *
 * 主な設定項目:
 * 1. content: Tailwindのユーティリティクラスを探すファイルパスを指定
 * 2. darkMode: ダークモードの動作設定
 * 3. theme: デザインのカスタマイズ
 *    - screens: レスポンシブブレークポイント
 *    - colors: カラーパレット
 *    - spacing: マージン、パディング、幅、高さなどのサイズ
 *    - extend: 既存の設定を拡張
 */
const config: Config = {
  // Tailwindが適用されるファイルを指定
  content: ['./src/app/**/*.{js,ts,jsx,tsx,mdx}'],

  // テーマのカスタマイズ
  theme: {
    // ブレークポイントの設定
    // 例: md:text-lg -> 768px以上で適用
    screens: {
      sm: '640px', // スマートフォン(横向き)
      md: '768px', // タブレット
      lg: '1024px', // ノートPC
      xl: '1280px', // デスクトップ
      '2xl': '1536px', // 大画面
    },

    // 既存の設定を拡張
    extend: {
      // カラーパレット
      // 例: bg-primary-500, text-secondary-700
      colors: {
        primary: {
          50: '#f0f9ff',
          100: '#e0f2fe',
          200: '#bae6fd',
          300: '#7dd3fc',
          400: '#38bdf8',
          500: '#0ea5e9', // メインカラー
          600: '#0284c7',
          700: '#0369a1',
          800: '#075985',
          900: '#0c4a6e',
          950: '#082f49',
        },
        secondary: {
          500: '#64748b', // メインカラー
          600: '#475569',
          700: '#334155',
        },
      },
    },
  },
}

export default config
